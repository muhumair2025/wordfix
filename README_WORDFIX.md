# WordFix - PhraseFix Clone

A comprehensive text manipulation tool suite built with Laravel and Tailwind CSS.

## Project Structure

```
wordfix/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php          # Main layout template
│   │   ├── components/
│   │   │   ├── navbar.blade.php       # Navigation with all tool menus
│   │   │   └── footer.blade.php       # Footer with all tool links
│   │   └── home.blade.php             # Homepage
│   └── css/
│       └── app.css                     # Tailwind CSS
├── public/
│   └── images/
│       └── logo.png                    # WordFix logo
└── routes/
    └── web.php                         # Application routes
```

## Features

### Current Implementation
- ✅ Responsive navbar with dropdown menus
- ✅ Full-width layout
- ✅ Mobile-responsive with hamburger menu
- ✅ Comprehensive footer with all tool categories
- ✅ Collapsible search tools component
- ✅ Reusable tool page layout
- ✅ Complete folder structure for all tool categories
- ✅ 11 main tool categories with 100+ tools planned
- ✅ Sample tool page (Upper Case) with full functionality

### Tool Categories
1. **Basic Tools** - Case conversions (9 tools)
2. **Counter Tools** - Text statistics (3 tools)
3. **Formatter Tools** - Code beautifiers (5 tools)
4. **Modify Tools** - Text manipulation (18 tools)
5. **Special Effects Tools** - Text styling (19 tools)
6. **Extract Tools** - Data extraction (10 tools)
7. **Sorting Tools** - Text sorting (4 tools)
8. **Remove Tools** - Content removal (21 tools)
9. **Replace Tools** - Find and replace (4 tools)
10. **Conversion Tools** - Format conversions (9 tools)
11. **Generator Tools** - Random generators (13 tools)

## Color Scheme

Following PhraseFix design:
- Primary: Blue (#2563EB / blue-600)
- Hover: Darker Blue (#1D4ED8 / blue-700)
- Background: Light Gray (#F9FAFB / gray-50)
- Text: Dark Gray (#111827 / gray-900)
- Border: Light Gray (#E5E7EB / gray-200)

## Technology Stack

- **Backend**: Laravel 11
- **Frontend**: Tailwind CSS 4
- **JavaScript**: Alpine.js for interactive components
- **Icons**: Heroicons (SVG)

## Folder Structure for Tools

Each main category will have its own folder with individual tool files:

```
resources/views/
├── basic/
│   ├── alternate-case.blade.php
│   ├── capitalize-words.blade.php
│   └── ...
├── counter/
│   ├── character-word-counter.blade.php
│   └── ...
├── formatter/
│   ├── css-beautifier.blade.php
│   └── ...
└── [other categories...]
```

## Development Setup

1. Install dependencies:
```bash
composer install
npm install
```

2. Build assets:
```bash
npm run dev
```

3. Start server:
```bash
php artisan serve
```

## Next Steps

1. Create folder structure for each tool category
2. Build individual tool pages
3. Implement tool functionality with JavaScript
4. Add search functionality
5. Add tool feedback system
6. Create static pages (Contact, Privacy Policy, Terms)

## Notes

- Navbar uses Alpine.js for dropdown interactions
- Mobile menu uses collapse animation
- All menus are defined in the navbar component using x-data
- Footer shows all tools for SEO purposes
- Design matches PhraseFix with blue accent colors

