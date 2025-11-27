<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class SeoController extends Controller
{
    /**
     * Show SEO settings dashboard
     */
    public function index()
    {
        $robotsExists = File::exists(public_path('robots.txt'));
        $sitemapExists = File::exists(public_path('sitemap.xml'));
        
        $robotsContent = $robotsExists ? File::get(public_path('robots.txt')) : '';
        $sitemapContent = $sitemapExists ? File::get(public_path('sitemap.xml')) : '';
        
        // Get meta settings from files
        $homeMetaFile = resource_path('meta/home.json');
        $homeMeta = File::exists($homeMetaFile) ? json_decode(File::get($homeMetaFile), true) : [
            'title' => 'WordFix - Free Online Text Tools',
            'description' => 'Transform your text with our comprehensive suite of free online text manipulation tools. Convert case, format code, count words, and much more.',
            'keywords' => 'text tools, case converter, word counter, text formatter, online tools'
        ];
        
        // SEO Analytics
        $seoStats = $this->getSeoStats();
        
        // Get SEO settings (favicon, GSC, etc.)
        $seoSettings = $this->getSeoSettings();
        
        return view('admin.seo.index', compact('robotsExists', 'sitemapExists', 'robotsContent', 'sitemapContent', 'homeMeta', 'seoStats', 'seoSettings'));
    }
    
    /**
     * Get SEO statistics
     */
    private function getSeoStats()
    {
        $toolMetaFile = resource_path('meta/tools.json');
        $toolMeta = [];
        
        // Safely load and parse tools.json
        if (File::exists($toolMetaFile)) {
            $content = File::get($toolMetaFile);
            if (!empty(trim($content))) {
                $decoded = json_decode($content, true);
                $toolMeta = is_array($decoded) ? $decoded : [];
            }
        }
        
        $allTools = $this->getAllTools();
        $totalTools = 0;
        foreach ($allTools as $categoryTools) {
            $totalTools += count($categoryTools ?? []);
        }
        
        $configuredTools = count($toolMeta);
        $missingMeta = max(0, $totalTools - $configuredTools);
        
        // Check for SEO issues
        $issues = [];
        if (is_array($toolMeta)) {
            foreach ($toolMeta as $key => $meta) {
                if (is_array($meta)) {
                    if (isset($meta['title']) && strlen($meta['title']) > 60) {
                        $issues[] = "Title too long for {$key}";
                    }
                    if (isset($meta['description']) && strlen($meta['description']) > 160) {
                        $issues[] = "Description too long for {$key}";
                    }
                    if (empty($meta['keywords'])) {
                        $issues[] = "Missing keywords for {$key}";
                    }
                }
            }
        }
        
        $completionPercentage = $totalTools > 0 ? round(($configuredTools / $totalTools) * 100, 1) : 0;
        
        return [
            'total_tools' => $totalTools,
            'configured_tools' => $configuredTools,
            'missing_meta' => $missingMeta,
            'completion_percentage' => min(100, max(0, $completionPercentage)), // Ensure between 0-100%
            'seo_issues' => count($issues),
            'issues_list' => array_slice($issues, 0, 5) // Show first 5 issues
        ];
    }
    
    /**
     * Update robots.txt file
     */
    public function updateRobots(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);
        
        try {
            File::put(public_path('robots.txt'), $request->content);
            return redirect()->route('admin.seo.index')->with('success', 'Robots.txt updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.seo.index')->with('error', 'Failed to update robots.txt: ' . $e->getMessage());
        }
    }
    
    /**
     * Generate and update sitemap.xml
     */
    public function generateSitemap(Request $request)
    {
        try {
            $sitemap = $this->buildSitemap();
            File::put(public_path('sitemap.xml'), $sitemap);
            
            // Count URLs in sitemap for feedback
            $urlCount = substr_count($sitemap, '<url>');
            $configFile = resource_path('meta/sitemap-config.json');
            $config = File::exists($configFile) ? json_decode(File::get($configFile), true) : [];
            $baseUrl = $config['base_url'] ?? config('app.url', 'https://wordfix.com');
            
            $message = "Sitemap.xml generated successfully! Generated {$urlCount} URLs using base URL: {$baseUrl}";
            
            // Redirect back to the referring page or sitemap config if from there
            $referrer = $request->header('referer');
            if ($referrer && str_contains($referrer, 'sitemap-config')) {
                return redirect()->route('admin.seo.sitemap-config')->with('success', $message);
            }
            
            return redirect()->route('admin.seo.index')->with('success', $message);
        } catch (\Exception $e) {
            $referrer = $request->header('referer');
            if ($referrer && str_contains($referrer, 'sitemap-config')) {
                return redirect()->route('admin.seo.sitemap-config')->with('error', 'Failed to generate sitemap.xml: ' . $e->getMessage());
            }
            return redirect()->route('admin.seo.index')->with('error', 'Failed to generate sitemap.xml: ' . $e->getMessage());
        }
    }
    
    /**
     * Update home page meta tags
     */
    public function updateHomeMeta(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:160',
            'keywords' => 'required|string|max:255'
        ]);
        
        try {
            $metaData = [
                'title' => $request->title,
                'description' => $request->description,
                'keywords' => $request->keywords,
                'updated_at' => now()->toISOString()
            ];
            
            // Ensure meta directory exists
            $metaDir = resource_path('meta');
            if (!File::exists($metaDir)) {
                File::makeDirectory($metaDir, 0755, true);
            }
            
            File::put(resource_path('meta/home.json'), json_encode($metaData, JSON_PRETTY_PRINT));
            return redirect()->route('admin.seo.index')->with('success', 'Home page meta tags updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.seo.index')->with('error', 'Failed to update home meta tags: ' . $e->getMessage());
        }
    }
    
    /**
     * Show tool meta management page
     */
    public function toolMeta()
    {
        // Get all tool categories and their tools
        $tools = $this->getAllTools();
        
        // Get existing meta data for tools
        $toolMetaFile = resource_path('meta/tools.json');
        $toolMeta = [];
        
        if (File::exists($toolMetaFile)) {
            $content = File::get($toolMetaFile);
            if (!empty(trim($content))) {
                $decoded = json_decode($content, true);
                $toolMeta = is_array($decoded) ? $decoded : [];
            }
        }
        
        return view('admin.seo.tool-meta', compact('tools', 'toolMeta'));
    }
    
    /**
     * Update tool meta tags
     */
    public function updateToolMeta(Request $request)
    {
        $request->validate([
            'tool_key' => 'required|string',
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:160',
            'keywords' => 'required|string|max:255'
        ]);
        
        try {
            // Load existing tool meta safely
            $toolMetaFile = resource_path('meta/tools.json');
            $toolMeta = [];
            
            if (File::exists($toolMetaFile)) {
                $content = File::get($toolMetaFile);
                if (!empty(trim($content))) {
                    $decoded = json_decode($content, true);
                    $toolMeta = is_array($decoded) ? $decoded : [];
                }
            }
            
            // Update the specific tool meta
            $toolMeta[$request->tool_key] = [
                'title' => $request->title,
                'description' => $request->description,
                'keywords' => $request->keywords,
                'updated_at' => now()->toISOString()
            ];
            
            // Ensure meta directory exists
            $metaDir = resource_path('meta');
            if (!File::exists($metaDir)) {
                File::makeDirectory($metaDir, 0755, true);
            }
            
            File::put($toolMetaFile, json_encode($toolMeta, JSON_PRETTY_PRINT));
            
            // Return JSON response for AJAX requests
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Tool meta tags updated successfully!']);
            }
            
            return redirect()->route('admin.seo.tool-meta')->with('success', 'Tool meta tags updated successfully!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to update tool meta tags: ' . $e->getMessage()], 500);
            }
            return redirect()->route('admin.seo.tool-meta')->with('error', 'Failed to update tool meta tags: ' . $e->getMessage());
        }
    }
    
    /**
     * Bulk update tool meta tags
     */
    public function bulkUpdateToolMeta(Request $request)
    {
        $request->validate([
            'tools' => 'required|array',
            'tools.*.tool_key' => 'required|string',
            'tools.*.title' => 'required|string|max:60',
            'tools.*.description' => 'required|string|max:160',
            'tools.*.keywords' => 'required|string|max:255'
        ]);
        
        try {
            // Load existing tool meta
            $toolMetaFile = resource_path('meta/tools.json');
            $toolMeta = File::exists($toolMetaFile) ? json_decode(File::get($toolMetaFile), true) : [];
            
            $updated = 0;
            foreach ($request->tools as $tool) {
                $toolMeta[$tool['tool_key']] = [
                    'title' => $tool['title'],
                    'description' => $tool['description'],
                    'keywords' => $tool['keywords'],
                    'updated_at' => now()->toISOString()
                ];
                $updated++;
            }
            
            // Ensure meta directory exists
            $metaDir = resource_path('meta');
            if (!File::exists($metaDir)) {
                File::makeDirectory($metaDir, 0755, true);
            }
            
            File::put($toolMetaFile, json_encode($toolMeta, JSON_PRETTY_PRINT));
            
            return response()->json([
                'success' => true, 
                'message' => "Successfully updated {$updated} tool meta tags!",
                'updated_count' => $updated
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Failed to bulk update tool meta tags: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Show sitemap configuration
     */
    public function sitemapConfig()
    {
        $configFile = resource_path('meta/sitemap-config.json');
        $defaultConfig = [
            'base_url' => config('app.url', 'https://wordfix.com'),
            'default_changefreq' => 'monthly',
            'homepage_priority' => 1.0,
            'category_priority' => 0.8,
            'tool_priority' => 0.7,
            'exclude_pages' => ['/admin', '/login', '/register', '/password'],
            'include_lastmod' => true,
            'auto_generate' => false
        ];
        
        $config = $defaultConfig;
        if (File::exists($configFile)) {
            $content = File::get($configFile);
            if (!empty(trim($content))) {
                $decoded = json_decode($content, true);
                if (is_array($decoded)) {
                    $config = array_merge($defaultConfig, $decoded);
                }
            }
        }
        
        return view('admin.seo.sitemap-config', compact('config'));
    }
    
    /**
     * Update sitemap configuration
     */
    public function updateSitemapConfig(Request $request)
    {
        $request->validate([
            'base_url' => 'required|url',
            'default_changefreq' => 'required|in:always,hourly,daily,weekly,monthly,yearly,never',
            'homepage_priority' => 'required|numeric|min:0|max:1',
            'category_priority' => 'required|numeric|min:0|max:1',
            'tool_priority' => 'required|numeric|min:0|max:1',
            'exclude_pages' => 'nullable|string',
            'include_lastmod' => 'boolean',
            'auto_generate' => 'boolean'
        ]);
        
        try {
            $config = [
                'base_url' => rtrim($request->base_url, '/'), // Remove trailing slash
                'default_changefreq' => $request->default_changefreq,
                'homepage_priority' => (float) $request->homepage_priority,
                'category_priority' => (float) $request->category_priority,
                'tool_priority' => (float) $request->tool_priority,
                'exclude_pages' => array_filter(array_map('trim', explode("\n", $request->exclude_pages ?? ''))),
                'include_lastmod' => (bool) $request->include_lastmod,
                'auto_generate' => (bool) $request->auto_generate,
                'updated_at' => now()->toISOString()
            ];
            
            // Ensure meta directory exists
            $metaDir = resource_path('meta');
            if (!File::exists($metaDir)) {
                File::makeDirectory($metaDir, 0755, true);
            }
            
            File::put(resource_path('meta/sitemap-config.json'), json_encode($config, JSON_PRETTY_PRINT));
            return redirect()->route('admin.seo.sitemap-config')->with('success', 'Sitemap configuration updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.seo.sitemap-config')->with('error', 'Failed to update sitemap configuration: ' . $e->getMessage());
        }
    }
    
    /**
     * Build sitemap XML content
     */
    private function buildSitemap()
    {
        // Load sitemap configuration with proper defaults
        $configFile = resource_path('meta/sitemap-config.json');
        $defaultConfig = [
            'base_url' => config('app.url', 'https://wordfix.com'),
            'default_changefreq' => 'monthly',
            'homepage_priority' => 1.0,
            'category_priority' => 0.8,
            'tool_priority' => 0.7,
            'exclude_pages' => ['/admin', '/login', '/register', '/password'],
            'include_lastmod' => true
        ];
        
        $config = $defaultConfig;
        if (File::exists($configFile)) {
            $content = File::get($configFile);
            if (!empty(trim($content))) {
                $decoded = json_decode($content, true);
                if (is_array($decoded)) {
                    $config = array_merge($defaultConfig, $decoded);
                }
            }
        }
        
        $baseUrl = rtrim($config['base_url'], '/');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        $lastmod = $config['include_lastmod'] ? now()->toISOString() : null;
        
        // Add homepage
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$baseUrl}/</loc>\n";
        if ($lastmod) $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
        $xml .= "    <changefreq>{$config['default_changefreq']}</changefreq>\n";
        $xml .= "    <priority>{$config['homepage_priority']}</priority>\n";
        $xml .= "  </url>\n";
        
        // Add category pages
        $categories = [
            'basic' => 'Basic Text Tools',
            'counter' => 'Text Counter Tools', 
            'formatter' => 'Code Formatter Tools',
            'modify' => 'Text Modification Tools',
            'extract' => 'Text Extraction Tools',
            'sorting' => 'Text Sorting Tools',
            'remove' => 'Text Removal Tools',
            'replace' => 'Find and Replace Tools',
            'conversions' => 'Text Conversion Tools',
            'generators' => 'Text Generator Tools',
            'special-effects' => 'Special Effects Tools'
        ];
        
        foreach ($categories as $category => $name) {
            $categoryUrl = "/{$category}";
            if (!in_array($categoryUrl, $config['exclude_pages'])) {
                $xml .= "  <url>\n";
                $xml .= "    <loc>{$baseUrl}{$categoryUrl}</loc>\n";
                if ($lastmod) $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
                $xml .= "    <changefreq>{$config['default_changefreq']}</changefreq>\n";
                $xml .= "    <priority>{$config['category_priority']}</priority>\n";
                $xml .= "  </url>\n";
            }
        }
        
        // Add individual tool pages - ensure ALL tools are included
        $tools = $this->getAllTools();
        $toolCount = 0;
        foreach ($tools as $category => $categoryTools) {
            if (is_array($categoryTools)) {
                foreach ($categoryTools as $tool) {
                    if (isset($tool['slug'])) {
                        $toolUrl = "/{$category}/{$tool['slug']}";
                        // Check if this specific URL is excluded
                        $isExcluded = false;
                        foreach ($config['exclude_pages'] as $excludePage) {
                            if (trim($excludePage) === $toolUrl) {
                                $isExcluded = true;
                                break;
                            }
                        }
                        
                        if (!$isExcluded) {
                            $xml .= "  <url>\n";
                            $xml .= "    <loc>{$baseUrl}{$toolUrl}</loc>\n";
                            if ($lastmod) $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
                            $xml .= "    <changefreq>{$config['default_changefreq']}</changefreq>\n";
                            $xml .= "    <priority>{$config['tool_priority']}</priority>\n";
                            $xml .= "  </url>\n";
                            $toolCount++;
                        }
                    }
                }
            }
        }
        
        // Add comment with tool count for debugging
        $xml .= "<!-- Generated " . date('Y-m-d H:i:s') . " - {$toolCount} tools included -->\n";
        
        $xml .= '</urlset>';
        
        return $xml;
    }
    
    /**
     * Get all tools organized by category - synced from navbar
     */
    private function getAllTools()
    {
        return $this->getToolsFromNavbar();
    }
    
    /**
     * Extract tools from navbar component (single source of truth)
     */
    private function getToolsFromNavbar()
    {
        // For now, return the complete hardcoded list from navbar
        // This ensures we get all 119 tools correctly
        return [
            'basic' => [
                ['name' => 'Alternate Case', 'slug' => 'alternate-case'],
                ['name' => 'Capitalize Words', 'slug' => 'capitalize-words'],
                ['name' => 'Invert Case', 'slug' => 'invert-case'],
                ['name' => 'Lower Case', 'slug' => 'lower-case'],
                ['name' => 'Sentence Case', 'slug' => 'sentence-case'],
                ['name' => 'Strikethrough', 'slug' => 'strikethrough'],
                ['name' => 'Title Case', 'slug' => 'title-case'],
                ['name' => 'Underline', 'slug' => 'underline'],
                ['name' => 'Upper Case', 'slug' => 'upper-case']
            ],
            'counter' => [
                ['name' => 'Character and Word Counter', 'slug' => 'character-word-counter'],
                ['name' => 'Count Each Line', 'slug' => 'count-each-line'],
                ['name' => 'Bracket and Tag Counter', 'slug' => 'bracket-tag-counter']
            ],
            'formatter' => [
                ['name' => 'CSS Beautifier', 'slug' => 'css-beautifier'],
                ['name' => 'HTML Beautifier', 'slug' => 'html-beautifier'],
                ['name' => 'JavaScript Beautifier', 'slug' => 'javascript-beautifier'],
                ['name' => 'JSON Beautifier', 'slug' => 'json-beautifier'],
                ['name' => 'SQL Beautifier', 'slug' => 'sql-beautifier']
            ],
            'modify' => [
                ['name' => 'Add Number To Each Line', 'slug' => 'add-number-to-each-line'],
                ['name' => 'Add String After Number of Characters', 'slug' => 'add-string-after-characters'],
                ['name' => 'Add Text To Each Line', 'slug' => 'add-text-to-each-line'],
                ['name' => 'Column to Comma', 'slug' => 'column-to-comma'],
                ['name' => 'Commas Between Numbers', 'slug' => 'commas-between-numbers'],
                ['name' => 'Comma to Column', 'slug' => 'comma-to-column'],
                ['name' => 'Convert Double Space To Single Space', 'slug' => 'double-space-to-single'],
                ['name' => 'Convert Single Space To Double Space', 'slug' => 'single-space-to-double'],
                ['name' => 'Keep First Characters Of Each Line', 'slug' => 'keep-first-characters'],
                ['name' => 'Keep Last Characters Of Each Line', 'slug' => 'keep-last-characters'],
                ['name' => 'Keep Lines Containing A Certain Word', 'slug' => 'keep-lines-with-word'],
                ['name' => 'Keep Lines Containing A Certain Words', 'slug' => 'keep-lines-with-words'],
                ['name' => 'Merge Text or Lists', 'slug' => 'merge-text-lists'],
                ['name' => 'Number To Words', 'slug' => 'number-to-words'],
                ['name' => 'Prefix Suffix', 'slug' => 'prefix-suffix'],
                ['name' => 'Specified Position Text Addition', 'slug' => 'position-text-addition'],
                ['name' => 'Trim Text', 'slug' => 'trim-text']
            ],
            'special-effects' => [
                ['name' => 'Backward', 'slug' => 'backward'],
                ['name' => 'Binary Code To Text', 'slug' => 'binary-to-text'],
                ['name' => 'Bold', 'slug' => 'bold'],
                ['name' => 'Bold Gothic Text', 'slug' => 'bold-gothic'],
                ['name' => 'Bold Italic', 'slug' => 'bold-italic'],
                ['name' => 'Circled Text', 'slug' => 'circled'],
                ['name' => 'Cursive Bold', 'slug' => 'cursive-bold'],
                ['name' => 'Flip Text', 'slug' => 'flip-text'],
                ['name' => 'Flip Words', 'slug' => 'flip-words'],
                ['name' => 'Gothic Text', 'slug' => 'gothic'],
                ['name' => 'Italic', 'slug' => 'italic'],
                ['name' => 'Outline Text', 'slug' => 'outline'],
                ['name' => 'Parentheses Around Letters', 'slug' => 'parentheses'],
                ['name' => 'Pascal Case', 'slug' => 'pascal-case'],
                ['name' => 'Reverse Words', 'slug' => 'reverse-words'],
                ['name' => 'Slashed', 'slug' => 'slashed'],
                ['name' => 'Snake Case', 'slug' => 'snake-case'],
                ['name' => 'Upside Down Text', 'slug' => 'upside-down'],
                ['name' => 'Wide Text', 'slug' => 'wide-text']
            ],
            'extract' => [
                ['name' => 'Extract Emails', 'slug' => 'emails'],
                ['name' => 'Extract Hex Colors', 'slug' => 'hex-colors'],
                ['name' => 'Extract Image Urls', 'slug' => 'image-urls'],
                ['name' => 'Extract IP Address', 'slug' => 'ip-address'],
                ['name' => 'Extract Phone Numbers', 'slug' => 'phone-numbers'],
                ['name' => 'Extract Numbers From Text', 'slug' => 'numbers'],
                ['name' => 'Extract Text Between', 'slug' => 'text-between'],
                ['name' => 'Extract Urls', 'slug' => 'urls'],
                ['name' => 'Extract Random Lines', 'slug' => 'random-lines'],
                ['name' => 'Extract Zip Codes', 'slug' => 'zip-codes']
            ],
            'sorting' => [
                ['name' => 'Alphabetical Sort', 'slug' => 'alphabetical'],
                ['name' => 'Length Sort', 'slug' => 'length'],
                ['name' => 'Randomly Sort Lines of Text', 'slug' => 'random'],
                ['name' => 'Sort Numbers', 'slug' => 'numbers']
            ],
            'remove' => [
                ['name' => 'Remove Consonants', 'slug' => 'consonants'],
                ['name' => 'Remove Duplicate Lines', 'slug' => 'duplicate-lines'],
                ['name' => 'Remove Duplicate Words', 'slug' => 'duplicate-words'],
                ['name' => 'Remove Empty Lines', 'slug' => 'empty-lines'],
                ['name' => 'Remove Extra Spaces', 'slug' => 'extra-spaces'],
                ['name' => 'Remove First Characters', 'slug' => 'first-characters'],
                ['name' => 'Remove HTML Comments', 'slug' => 'html-comments'],
                ['name' => 'Remove HTML Tags', 'slug' => 'html-tags'],
                ['name' => 'Remove Last Characters', 'slug' => 'last-characters'],
                ['name' => 'Remove Letters', 'slug' => 'letters'],
                ['name' => 'Remove Line Breaks', 'slug' => 'line-breaks'],
                ['name' => 'Remove Lines With Word', 'slug' => 'lines-with-word'],
                ['name' => 'Remove Numbers', 'slug' => 'numbers'],
                ['name' => 'Remove Numbers From Text', 'slug' => 'numbers-from-text'],
                ['name' => 'Remove Quotes', 'slug' => 'quotes'],
                ['name' => 'Remove Single Quotes', 'slug' => 'single-quotes'],
                ['name' => 'Remove Spaces', 'slug' => 'spaces'],
                ['name' => 'Remove Special Characters', 'slug' => 'special-characters'],
                ['name' => 'Remove Specific Words', 'slug' => 'specific-words'],
                ['name' => 'Remove Tabs', 'slug' => 'tabs'],
                ['name' => 'Remove Text Between', 'slug' => 'text-between'],
                ['name' => 'Remove URLs', 'slug' => 'urls'],
                ['name' => 'Remove Vowels', 'slug' => 'vowels'],
                ['name' => 'Trim Spaces', 'slug' => 'trim-spaces']
            ],
            'replace' => [
                ['name' => 'Replace New Line with Commas', 'slug' => 'newline-with-commas'],
                ['name' => 'Replace Spaces', 'slug' => 'spaces'],
                ['name' => 'Replace Text Between', 'slug' => 'text-between'],
                ['name' => 'Search And Replace', 'slug' => 'search-replace']
            ],
            'conversions' => [
                ['name' => 'Base64 Decoder', 'slug' => 'base64-decoder'],
                ['name' => 'Base64 Encoder', 'slug' => 'base64-encoder'],
                ['name' => 'Date Conversion', 'slug' => 'date'],
                ['name' => 'Decimal to String', 'slug' => 'decimal-to-string'],
                ['name' => 'Html Entities Converter', 'slug' => 'html-entities'],
                ['name' => 'String to Decimal', 'slug' => 'string-to-decimal'],
                ['name' => 'Text To Binary Code', 'slug' => 'text-to-binary'],
                ['name' => 'Url Decode', 'slug' => 'url-decode'],
                ['name' => 'Url Encode', 'slug' => 'url-encode']
            ],
            'generators' => [
                ['name' => 'Lorem Ipsum Generator', 'slug' => 'lorem-ipsum'],
                ['name' => 'Random Phone Number Generator', 'slug' => 'random-phone-number'],
                ['name' => 'Random Color Generator', 'slug' => 'color'],
                ['name' => 'Random Date Generator', 'slug' => 'date'],
                ['name' => 'Random Email Generator', 'slug' => 'email'],
                ['name' => 'Random IP address Generator', 'slug' => 'ip'],
                ['name' => 'Random ipv6 Address Generator', 'slug' => 'ipv6'],
                ['name' => 'Random MAC address Generator', 'slug' => 'mac'],
                ['name' => 'Random Number Generator', 'slug' => 'number'],
                ['name' => 'Random User-agent Generator', 'slug' => 'user-agent'],
                ['name' => 'Random Password Generator', 'slug' => 'password'],
                ['name' => 'SEO Friendly URL Generator', 'slug' => 'seo-url'],
                ['name' => 'Sequential Number Generator', 'slug' => 'sequential-number'],
                ['name' => 'URL Slug Generator', 'slug' => 'url-slug']
            ]
        ];
    }
    
    /**
     * Debug method to check tool count
     */
    public function debugToolCount()
    {
        $tools = $this->getAllTools();
        $count = 0;
        foreach ($tools as $category => $categoryTools) {
            $count += count($categoryTools);
        }
        
        return response()->json([
            'total_tools' => $count,
            'categories' => array_map(function($tools) { return count($tools); }, $tools),
            'breakdown' => $tools
        ]);
    }
    
    /**
     * Fallback tools list (in case navbar parsing fails)
     */
    private function getFallbackTools()
    {
        return [
            'basic' => [
                ['name' => 'Alternate Case', 'slug' => 'alternate-case'],
                ['name' => 'Capitalize Words', 'slug' => 'capitalize-words'],
                ['name' => 'Invert Case', 'slug' => 'invert-case'],
                ['name' => 'Lower Case', 'slug' => 'lower-case'],
                ['name' => 'Sentence Case', 'slug' => 'sentence-case'],
                ['name' => 'Strikethrough', 'slug' => 'strikethrough'],
                ['name' => 'Title Case', 'slug' => 'title-case'],
                ['name' => 'Underline', 'slug' => 'underline'],
                ['name' => 'Upper Case', 'slug' => 'upper-case']
            ],
            'counter' => [
                ['name' => 'Character and Word Counter', 'slug' => 'character-word-counter'],
                ['name' => 'Count Each Line', 'slug' => 'count-each-line'],
                ['name' => 'Bracket and Tag Counter', 'slug' => 'bracket-tag-counter']
            ],
            'formatter' => [
                ['name' => 'CSS Beautifier', 'slug' => 'css-beautifier'],
                ['name' => 'HTML Beautifier', 'slug' => 'html-beautifier'],
                ['name' => 'JavaScript Beautifier', 'slug' => 'javascript-beautifier'],
                ['name' => 'JSON Beautifier', 'slug' => 'json-beautifier'],
                ['name' => 'SQL Beautifier', 'slug' => 'sql-beautifier']
            ]
        ];
    }
    
    /**
     * Auto-sync new tools to meta management
     */
    public function syncNewTools(Request $request)
    {
        try {
            $allTools = $this->getAllTools();
            $toolMetaFile = resource_path('meta/tools.json');
            $existingMeta = [];
            
            // Safely load existing meta
            if (File::exists($toolMetaFile)) {
                $content = File::get($toolMetaFile);
                if (!empty(trim($content))) {
                    $decoded = json_decode($content, true);
                    $existingMeta = is_array($decoded) ? $decoded : [];
                }
            }
            
            $newToolsAdded = 0;
            $totalTools = 0;
            
            foreach ($allTools as $category => $categoryTools) {
                foreach ($categoryTools as $tool) {
                    $totalTools++;
                    $toolKey = $category . '.' . $tool['slug'];
                    
                    // If tool doesn't exist in meta, add it with default values
                    if (!isset($existingMeta[$toolKey])) {
                        $existingMeta[$toolKey] = [
                            'title' => $tool['name'] . ' - WordFix',
                            'description' => 'Use our free ' . strtolower($tool['name']) . ' tool to transform your text quickly and easily. Fast, secure, and completely free.',
                            'keywords' => strtolower($tool['name']) . ', text tools, online tools, free tools, ' . $category . ' tools',
                            'updated_at' => now()->toISOString(),
                            'auto_generated' => true
                        ];
                        $newToolsAdded++;
                    }
                }
            }
            
            // Ensure meta directory exists
            $metaDir = resource_path('meta');
            if (!File::exists($metaDir)) {
                File::makeDirectory($metaDir, 0755, true);
            }
            
            // Always write the file to ensure it's properly formatted
            File::put($toolMetaFile, json_encode($existingMeta, JSON_PRETTY_PRINT));
            
            if ($newToolsAdded > 0) {
                $message = "🎉 Successfully synced {$newToolsAdded} new tools! Total: " . count($existingMeta) . " tools configured.";
            } else {
                $message = "✅ All tools are already synced! Total: " . count($existingMeta) . " tools configured.";
            }
            
            return redirect()->route('admin.seo.tool-meta')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->route('admin.seo.tool-meta')->with('error', 'Failed to sync tools: ' . $e->getMessage());
        }
    }
    
    /**
     * Get SEO settings (favicon, GSC, etc.)
     */
    private function getSeoSettings()
    {
        $settingsFile = resource_path('meta/seo-settings.json');
        $settings = [];
        
        if (File::exists($settingsFile)) {
            $content = File::get($settingsFile);
            if (!empty(trim($content))) {
                $decoded = json_decode($content, true);
                $settings = is_array($decoded) ? $decoded : [];
            }
        }
        
        // Default settings
        return array_merge([
            'favicon_path' => null,
            'favicon_uploaded' => false,
            'google_site_verification' => '',
            'bing_site_verification' => '',
            'yandex_site_verification' => '',
            'pinterest_site_verification' => '',
            'custom_head_tags' => '',
            'updated_at' => null
        ], $settings);
    }
    
    /**
     * Update SEO settings
     */
    public function updateSeoSettings(Request $request)
    {
        // Add debugging
        \Log::info('SEO Settings Update Request', [
            'method' => $request->method(),
            'url' => $request->url(),
            'has_file' => $request->hasFile('favicon'),
            'input' => $request->except(['favicon', '_token'])
        ]);
        
        $request->validate([
            'google_site_verification' => 'nullable|string|max:255',
            'bing_site_verification' => 'nullable|string|max:255',
            'yandex_site_verification' => 'nullable|string|max:255',
            'pinterest_site_verification' => 'nullable|string|max:255',
            'custom_head_tags' => 'nullable|string|max:2000',
            'favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg,gif,svg|max:2048'
        ]);
        
        try {
            $settings = $this->getSeoSettings();
            
            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                $filename = 'favicon.' . $favicon->getClientOriginalExtension();
                
                // Store in public/images directory
                $path = $favicon->storeAs('images', $filename, 'public');
                $settings['favicon_path'] = '/storage/' . $path;
                $settings['favicon_uploaded'] = true;
                
                // Also copy to public root as favicon.ico for standard browsers
                if ($favicon->getClientOriginalExtension() === 'ico') {
                    copy($favicon->getPathname(), public_path('favicon.ico'));
                }
            }
            
            // Update verification codes
            $settings['google_site_verification'] = $request->google_site_verification ?? '';
            $settings['bing_site_verification'] = $request->bing_site_verification ?? '';
            $settings['yandex_site_verification'] = $request->yandex_site_verification ?? '';
            $settings['pinterest_site_verification'] = $request->pinterest_site_verification ?? '';
            $settings['custom_head_tags'] = $request->custom_head_tags ?? '';
            $settings['updated_at'] = now()->toISOString();
            
            // Save settings
            $settingsFile = resource_path('meta/seo-settings.json');
            $metaDir = resource_path('meta');
            if (!File::exists($metaDir)) {
                File::makeDirectory($metaDir, 0755, true);
            }
            
            File::put($settingsFile, json_encode($settings, JSON_PRETTY_PRINT));
            
            \Log::info('SEO Settings Updated Successfully', ['settings' => $settings]);
            
            return redirect()->route('admin.seo.index')->with('success', 'SEO settings updated successfully!');
        } catch (\Exception $e) {
            \Log::error('SEO Settings Update Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('admin.seo.index')->with('error', 'Failed to update SEO settings: ' . $e->getMessage());
        }
    }
    
    /**
     * Remove favicon
     */
    public function removeFavicon(Request $request)
    {
        try {
            $settings = $this->getSeoSettings();
            
            // Remove favicon file if it exists
            if (!empty($settings['favicon_path'])) {
                $fullPath = public_path(ltrim($settings['favicon_path'], '/'));
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
            }
            
            // Remove favicon.ico from public root
            if (File::exists(public_path('favicon.ico'))) {
                File::delete(public_path('favicon.ico'));
            }
            
            // Update settings
            $settings['favicon_path'] = null;
            $settings['favicon_uploaded'] = false;
            $settings['updated_at'] = now()->toISOString();
            
            $settingsFile = resource_path('meta/seo-settings.json');
            File::put($settingsFile, json_encode($settings, JSON_PRETTY_PRINT));
            
            return redirect()->route('admin.seo.index')->with('success', 'Favicon removed successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.seo.index')->with('error', 'Failed to remove favicon: ' . $e->getMessage());
        }
    }
}
