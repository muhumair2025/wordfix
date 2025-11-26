<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Page;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update Privacy Policy to HTML format
        Page::where('slug', 'privacy-policy')->update([
            'content' => '<h1>Privacy Policy</h1>

<p><strong>Effective Date:</strong> November 26, 2025<br>
<strong>Last Updated:</strong> November 26, 2025</p>

<p>WordFix ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and use our text manipulation tools and services.</p>

<h2>1. Information We Collect</h2>

<h3>1.1 Personal Information You Provide</h3>
<p>When you interact with our services, we may collect the following personal information:</p>

<ul>
<li><strong>Account Information:</strong> When you create an account, we collect your name, email address, and password</li>
<li><strong>Communication Data:</strong> Information you provide when you contact us, submit feedback, or suggest new tools</li>
<li><strong>Profile Information:</strong> Any additional information you choose to add to your profile</li>
<li><strong>User-Generated Content:</strong> Tool suggestions, feedback, and any other content you submit through our platform</li>
</ul>

<h3>1.2 Information Collected Automatically</h3>
<p>When you use our services, we automatically collect certain information:</p>

<ul>
<li><strong>Usage Data:</strong> Information about how you use our tools, including which tools you access, frequency of use, and session duration</li>
<li><strong>Device Information:</strong> Information about your device, including device type, operating system, browser type and version, and screen resolution</li>
<li><strong>Log Data:</strong> Server logs that include your IP address, access times, pages viewed, and referring website addresses</li>
<li><strong>Cookies and Similar Technologies:</strong> We use cookies, web beacons, and similar tracking technologies to enhance your experience</li>
</ul>

<h3>1.3 Text Processing Data</h3>
<p><strong>Important:</strong> The text content you process through our tools is handled with utmost privacy:</p>
<ul>
<li>Most text processing occurs entirely in your browser (client-side)</li>
<li>We do not store, log, or have access to the actual text content you process</li>
<li>Text data is not transmitted to our servers unless specifically required for certain advanced features</li>
<li>Any temporary processing data is immediately deleted after processing</li>
</ul>

<h2>2. How We Use Your Information</h2>

<p>We use the collected information for the following purposes:</p>

<h3>2.1 Service Provision</h3>
<ul>
<li>Provide, operate, and maintain our text manipulation tools</li>
<li>Process your requests and provide customer support</li>
<li>Enable account creation and user authentication</li>
<li>Facilitate communication regarding your suggestions and feedback</li>
</ul>

<h3>2.2 Service Improvement</h3>
<ul>
<li>Analyze usage patterns to improve our tools and user experience</li>
<li>Develop new features and tools based on user needs</li>
<li>Conduct research and analytics to enhance our services</li>
<li>Monitor and analyze trends and usage statistics</li>
</ul>

<h2>3. Information Sharing and Disclosure</h2>

<p>We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:</p>

<h3>3.1 Service Providers</h3>
<p>We may share information with trusted third-party service providers who assist us in website hosting, analytics, email delivery, and customer support. These providers are contractually obligated to protect your information.</p>

<h3>3.2 Legal Requirements</h3>
<p>We may disclose your information when required by law or to protect our rights, property, or safety, or that of our users.</p>

<h2>4. Data Security</h2>

<p>We implement comprehensive security measures including encryption, access controls, regular audits, and secure infrastructure to protect your personal information. However, no method of transmission over the internet is 100% secure.</p>

<h2>5. Your Privacy Rights</h2>

<p>You have rights regarding your personal information including access, correction, deletion, and restriction of processing. To exercise these rights, please contact us through our feedback system.</p>

<h2>6. Contact Us</h2>

<p>If you have questions about this Privacy Policy, please contact us through our website feedback form. We aim to respond to all privacy-related inquiries within 30 days.</p>'
        ]);

        // Update Terms of Service to HTML format
        Page::where('slug', 'terms-of-service')->update([
            'content' => '<h1>Terms of Service</h1>

<p><strong>Effective Date:</strong> November 26, 2025<br>
<strong>Last Updated:</strong> November 26, 2025</p>

<p>These Terms of Service ("Terms") govern your use of the WordFix website and services ("Service") operated by WordFix ("us", "we", or "our"). By accessing or using our Service, you agree to be bound by these Terms.</p>

<h2>1. Acceptance of Terms</h2>

<p>By accessing and using WordFix, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service and our Privacy Policy. If you do not agree to these terms, please do not use our services.</p>

<h3>1.1 Eligibility</h3>
<ul>
<li>You must be at least 13 years old to use our services</li>
<li>If you are under 18, you must have parental or guardian consent</li>
<li>You must provide accurate and complete information when creating an account</li>
<li>You are responsible for maintaining the confidentiality of your account credentials</li>
</ul>

<h2>2. Description of Service</h2>

<p>WordFix provides a comprehensive suite of text manipulation tools including:</p>

<ul>
<li><strong>Text Transformation:</strong> Case conversion, formatting, and styling tools</li>
<li><strong>Analysis Tools:</strong> Word counting, character analysis, and text statistics</li>
<li><strong>Code Formatting:</strong> Beautification tools for various programming languages</li>
<li><strong>Data Processing:</strong> Text extraction, sorting, and conversion utilities</li>
<li><strong>Generators:</strong> Random data generation and placeholder content creation</li>
<li><strong>Utility Tools:</strong> Find and replace, text comparison, and specialized processing</li>
</ul>

<h2>3. User Accounts and Responsibilities</h2>

<h3>3.1 Account Creation</h3>
<p>To access certain features, you may need to create an account by providing a valid email address, secure password, and basic profile information.</p>

<h3>3.2 Account Security</h3>
<p>You are responsible for maintaining the confidentiality of your login credentials and all activities that occur under your account.</p>

<h2>4. Acceptable Use Policy</h2>

<h3>4.1 Permitted Uses</h3>
<p>You may use WordFix for personal text processing, commercial and business needs, educational purposes, content creation, and software development assistance.</p>

<h3>4.2 Prohibited Uses</h3>
<p>You may NOT use WordFix to:</p>
<ul>
<li>Process content that violates laws or regulations</li>
<li>Create or distribute harmful, threatening, or offensive content</li>
<li>Attempt to breach our security measures</li>
<li>Overload our systems with excessive requests</li>
<li>Resell or redistribute our services without permission</li>
</ul>

<h2>5. Intellectual Property Rights</h2>

<h3>5.1 Our Intellectual Property</h3>
<p>WordFix and all related materials are protected by intellectual property laws. You may not copy, modify, or distribute our content without permission.</p>

<h3>5.2 Your Content Rights</h3>
<p>You retain full ownership of any text or content you process through our tools. We do not claim ownership rights to your content and do not store your processed content.</p>

<h2>6. Privacy and Data Protection</h2>

<p>Your privacy is important to us. We collect minimal personal information, process text locally in your browser when possible, and do not store the content you process. For detailed information, please review our Privacy Policy.</p>

<h2>7. Service Limitations and Disclaimers</h2>

<p>WordFix is provided "as is" without warranties of any kind. We do not guarantee accuracy of results, uninterrupted service, or freedom from errors.</p>

<h2>8. Limitation of Liability</h2>

<p>To the maximum extent permitted by law, WordFix shall not be liable for any indirect, incidental, or consequential damages. Our total liability shall not exceed $100 USD or the amount you paid us in the preceding 12 months.</p>

<h2>9. Contact Information</h2>

<p>For questions about these Terms of Service, please contact us through our website feedback system. We aim to respond to all inquiries within 5 business days.</p>

<p>By using WordFix, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.</p>'
        ]);

        // Update About page to HTML format
        Page::where('slug', 'about')->update([
            'content' => '<h1>About WordFix</h1>

<h2>Your Complete Text Manipulation Toolkit</h2>

<p>WordFix is a comprehensive web-based platform designed to simplify and enhance your text processing tasks. Whether you are a developer, writer, content creator, or anyone who works with text regularly, WordFix provides you with powerful, easy-to-use tools to transform, analyze, and manipulate text efficiently.</p>

<h2>What We Offer</h2>

<h3>Text Transformation Tools</h3>
<ul>
<li><strong>Case Converters:</strong> Transform text between uppercase, lowercase, title case, sentence case, and more</li>
<li><strong>Text Formatters:</strong> Beautiful code formatting for CSS, HTML, JavaScript, JSON, and SQL</li>
<li><strong>Special Effects:</strong> Add strikethrough, underline, and other text styling effects</li>
</ul>

<h3>Analysis & Counting Tools</h3>
<ul>
<li><strong>Word Counter:</strong> Get detailed statistics about your text including word count, character count, and reading time</li>
<li><strong>Line Counter:</strong> Count lines, paragraphs, and sentences in your content</li>
<li><strong>Bracket & Tag Counter:</strong> Analyze code structure and nested elements</li>
</ul>

<h3>Data Processing</h3>
<ul>
<li><strong>Text Extractors:</strong> Pull specific data from your text content</li>
<li><strong>Sorting Tools:</strong> Organize and arrange text in various orders</li>
<li><strong>Find & Replace:</strong> Advanced text replacement with pattern matching</li>
<li><strong>Converters:</strong> Transform data between different formats</li>
</ul>

<h3>Generators & Utilities</h3>
<ul>
<li><strong>Random Generators:</strong> Create test data, passwords, and placeholder content</li>
<li><strong>SEO Tools:</strong> Generate SEO-friendly URLs and optimize content</li>
<li><strong>Development Utilities:</strong> Tools specifically designed for developers</li>
</ul>

<h2>Why Choose WordFix?</h2>

<ul>
<li><strong>Free to Use:</strong> All tools are completely free with no hidden costs</li>
<li><strong>Privacy First:</strong> Most processing happens in your browser - your text stays private</li>
<li><strong>No Registration Required:</strong> Use tools instantly without creating an account</li>
<li><strong>Mobile Friendly:</strong> Works perfectly on desktop, tablet, and mobile devices</li>
<li><strong>Fast & Reliable:</strong> Optimized for speed and performance</li>
<li><strong>Regular Updates:</strong> New tools and features added regularly based on user feedback</li>
</ul>

<h2>Our Mission</h2>

<p>We believe that powerful text manipulation tools should be accessible to everyone. WordFix eliminates the need for complex software installations or expensive subscriptions by providing professional-grade text processing capabilities directly in your web browser.</p>

<h2>Community Driven</h2>

<p>WordFix grows with the help of our user community. We actively listen to feedback and implement new features based on real user needs. Have an idea for a new tool? We would love to hear from you!</p>

<h2>Get Started</h2>

<p>Ready to supercharge your text processing workflow? Browse our tool categories above or use the search function to find exactly what you need. No downloads, no setup - just powerful text tools at your fingertips.</p>'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this migration
    }
};