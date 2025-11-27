<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class MetaHelper
{
    /**
     * Get home page meta data
     */
    public static function getHomeMeta()
    {
        $homeMetaFile = resource_path('meta/home.json');
        
        if (File::exists($homeMetaFile)) {
            return json_decode(File::get($homeMetaFile), true);
        }
        
        // Default meta data
        return [
            'title' => 'WordFix - Free Online Text Tools',
            'description' => 'Transform your text with our comprehensive suite of free online text manipulation tools. Convert case, format code, count words, and much more.',
            'keywords' => 'text tools, case converter, word counter, text formatter, online tools'
        ];
    }
    
    /**
     * Get tool meta data
     */
    public static function getToolMeta($category, $toolSlug)
    {
        $toolMetaFile = resource_path('meta/tools.json');
        $toolKey = $category . '.' . $toolSlug;
        
        if (File::exists($toolMetaFile)) {
            $toolMeta = json_decode(File::get($toolMetaFile), true);
            
            if (isset($toolMeta[$toolKey])) {
                return $toolMeta[$toolKey];
            }
        }
        
        // Generate default meta based on tool name
        $toolName = ucwords(str_replace('-', ' ', $toolSlug));
        
        return [
            'title' => $toolName . ' - WordFix',
            'description' => 'Use our free ' . strtolower($toolName) . ' tool to transform your text quickly and easily. Fast, secure, and completely free.',
            'keywords' => strtolower($toolName) . ', text tools, online tools, free tools, ' . $category . ' tools'
        ];
    }
    
    /**
     * Get current route meta data
     */
    public static function getCurrentMeta()
    {
        $route = request()->route();
        
        if (!$route) {
            return self::getHomeMeta();
        }
        
        $uri = $route->uri();
        
        // Home page
        if ($uri === '/') {
            return self::getHomeMeta();
        }
        
        // Tool pages
        if (preg_match('/^([^\/]+)\/([^\/]+)$/', $uri, $matches)) {
            $category = $matches[1];
            $toolSlug = $matches[2];
            return self::getToolMeta($category, $toolSlug);
        }
        
        // Category pages
        if (preg_match('/^([^\/]+)$/', $uri, $matches)) {
            $category = $matches[1];
            $categoryName = ucwords(str_replace('-', ' ', $category));
            
            return [
                'title' => $categoryName . ' Tools - WordFix',
                'description' => 'Explore our collection of ' . strtolower($categoryName) . ' tools. Transform your text with our free online utilities.',
                'keywords' => $category . ' tools, text tools, online tools, free tools'
            ];
        }
        
        // Default fallback
        return self::getHomeMeta();
    }
    
    /**
     * Get SEO settings (favicon, verification codes, etc.)
     */
    public static function getSeoSettings()
    {
        $settingsFile = resource_path('meta/seo-settings.json');
        
        if (File::exists($settingsFile)) {
            $content = File::get($settingsFile);
            if (!empty(trim($content))) {
                $decoded = json_decode($content, true);
                if (is_array($decoded)) {
                    return $decoded;
                }
            }
        }
        
        // Default settings
        return [
            'favicon_path' => null,
            'favicon_uploaded' => false,
            'google_site_verification' => '',
            'bing_site_verification' => '',
            'yandex_site_verification' => '',
            'pinterest_site_verification' => '',
            'custom_head_tags' => '',
        ];
    }
}
