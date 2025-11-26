<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WordFix')</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.4;
            color: #1f2937;
            margin: 0;
            padding: 8px;
            background-color: #f8fafc;
        }
        .email-container {
            max-width: 100%;
            width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
            border: 2px solid #e2e8f0;
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            color: white;
            padding: 16px 12px;
            text-align: center;
            border-bottom: 3px solid #1e40af;
        }
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
        }
        .logo {
            width: 32px;
            height: 32px;
            margin-right: 8px;
            filter: brightness(0) invert(1);
        }
        .email-header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }
        .email-header .subtitle {
            margin: 4px 0 0 0;
            font-size: 12px;
            opacity: 0.9;
        }
        .email-body {
            padding: 16px 12px;
        }
        .email-footer {
            background-color: #f1f5f9;
            padding: 12px;
            text-align: center;
            border-top: 2px solid #e2e8f0;
        }
        .button {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            font-weight: 600;
            margin: 8px 0;
            font-size: 14px;
            border: 2px solid #3b82f6;
        }
        .button:hover {
            background-color: #2563eb;
        }
        .info-box {
            background-color: #dbeafe;
            border: 2px solid #93c5fd;
            padding: 12px;
            margin: 12px 0;
        }
        .success-box {
            background-color: #dcfce7;
            border: 2px solid #86efac;
            padding: 12px;
            margin: 12px 0;
        }
        .warning-box {
            background-color: #fef3c7;
            border: 2px solid #fcd34d;
            padding: 12px;
            margin: 12px 0;
        }
        .error-box {
            background-color: #fee2e2;
            border: 2px solid #fca5a5;
            padding: 12px;
            margin: 12px 0;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
            font-size: 14px;
        }
        .details-table th,
        .details-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .details-table th {
            background-color: #f1f5f9;
            font-weight: 600;
            color: #1f2937;
            font-size: 12px;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            border: 1px solid;
        }
        .status-new {
            background-color: #dbeafe;
            color: #1e40af;
            border-color: #3b82f6;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
            border-color: #f59e0b;
        }
        .status-approved {
            background-color: #dcfce7;
            color: #065f46;
            border-color: #10b981;
        }
        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
            border-color: #ef4444;
        }
        .status-resolved {
            background-color: #dcfce7;
            color: #065f46;
            border-color: #10b981;
        }
        .status-in_progress {
            background-color: #e0e7ff;
            color: #3730a3;
            border-color: #6366f1;
        }
        .status-under_review {
            background-color: #fef3c7;
            color: #92400e;
            border-color: #f59e0b;
        }
        .footer-links {
            margin: 8px 0;
            font-size: 12px;
        }
        .footer-links a {
            color: #64748b;
            text-decoration: none;
            margin: 0 4px;
        }
        .footer-links a:hover {
            color: #1f2937;
        }
        .icon {
            width: 16px;
            height: 16px;
            display: inline-block;
            vertical-align: middle;
            margin-right: 4px;
        }
        .compact-text {
            font-size: 14px;
            line-height: 1.3;
            margin: 8px 0;
        }
        .admin-reply {
            background-color: #f8fafc;
            border: 2px solid #cbd5e1;
            padding: 12px;
            margin: 12px 0;
        }
        .admin-reply-header {
            font-weight: 600;
            color: #1e40af;
            font-size: 14px;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <div class="logo-container">
                <svg class="logo" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
                <h1>@yield('header-title', 'WordFix')</h1>
            </div>
            <p class="subtitle">@yield('header-subtitle', 'Text Tools')</p>
        </div>
        
        <div class="email-body">
            @yield('content')
        </div>
        
        <div class="email-footer">
            <p style="margin: 0 0 8px 0; color: #64748b; font-size: 12px;">
                WordFix - Text Manipulation Tools
            </p>
            <div class="footer-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/page/privacy-policy') }}">Privacy</a>
                <a href="{{ url('/page/terms-of-service') }}">Terms</a>
            </div>
            <p style="margin: 8px 0 0 0; font-size: 10px; color: #94a3b8;">
                © {{ date('Y') }} WordFix. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
