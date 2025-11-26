<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WordFix')</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #374151;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 32px 24px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .email-header .subtitle {
            margin: 8px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .email-body {
            padding: 32px 24px;
        }
        .email-footer {
            background-color: #f3f4f6;
            padding: 24px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .button {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 16px 0;
        }
        .button:hover {
            background-color: #1d4ed8;
        }
        .info-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 16px;
            margin: 16px 0;
        }
        .success-box {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 6px;
            padding: 16px;
            margin: 16px 0;
        }
        .warning-box {
            background-color: #fffbeb;
            border: 1px solid #fed7aa;
            border-radius: 6px;
            padding: 16px;
            margin: 16px 0;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 16px 0;
        }
        .details-table th,
        .details-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .details-table th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .status-resolved {
            background-color: #d1fae5;
            color: #065f46;
        }
        .footer-links {
            margin: 16px 0;
        }
        .footer-links a {
            color: #6b7280;
            text-decoration: none;
            margin: 0 8px;
        }
        .footer-links a:hover {
            color: #374151;
        }
    </style>
</head>
<body>
    <div style="padding: 24px;">
        <div class="email-container">
            <div class="email-header">
                <h1>@yield('header-title', 'WordFix')</h1>
                <p class="subtitle">@yield('header-subtitle', 'Free Online Text Manipulation Tools')</p>
            </div>
            
            <div class="email-body">
                @yield('content')
            </div>
            
            <div class="email-footer">
                <p style="margin: 0 0 16px 0; color: #6b7280;">
                    This email was sent by WordFix - Your complete text manipulation toolkit
                </p>
                <div class="footer-links">
                    <a href="{{ url('/') }}">Visit WordFix</a>
                    <a href="{{ url('/page/privacy-policy') }}">Privacy Policy</a>
                    <a href="{{ url('/page/terms-of-service') }}">Terms of Service</a>
                </div>
                <p style="margin: 16px 0 0 0; font-size: 12px; color: #9ca3af;">
                    © {{ date('Y') }} WordFix. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
