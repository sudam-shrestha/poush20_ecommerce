<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Account Approved</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacOSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: #4f46e5;
            color: white;
            padding: 30px 40px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 40px;
        }

        .credentials-box {
            background: #f8f9fa;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 24px;
            margin: 24px 0;
        }

        .credentials-box dt {
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 4px;
        }

        .credentials-box dd {
            margin: 0 0 16px 0;
            font-family: 'Courier New', Courier, monospace;
            background: #fff;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
        }

        .button {
            display: inline-block;
            background: #4f46e5;
            color: white;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin: 20px 0;
        }

        .footer {
            background: #f8f9fa;
            padding: 24px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }

        .important {
            color: #dc2626;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Your Seller Account is Approved!</h1>
        </div>

        <div class="content">
            <p>Dear <strong>{{ $seller->name }}</strong>,</p>

            <p>Congratulations! Your seller account <strong>{{ $seller->shop_name }}</strong> has been successfully
                approved.</p>

            <p>You can now start listing your products and managing your shop on our platform.</p>

            <div class="credentials-box">
                <h3 style="margin-top: 0; color: #4f46e5;">Your Login Credentials</h3>

                <dl>
                    <dt>Email / Username:</dt>
                    <dd>{{ $seller->email }}</dd>

                    <dt>Password:</dt>
                    <dd>{{ $password }}</dd>
                </dl>

                <p class="important" style="margin-top: 20px; font-size: 0.95em;">
                    → Please change your password immediately after your first login for security reasons.
                </p>
            </div>

            <p style="text-align: center;">
                <a href="{{ url('/seller/login') }}" style="color: white;" class="button">
                    Login to Your Seller Dashboard
                </a>
            </p>

            <p>If the button above doesn't work, copy and paste this link into your browser:</p>
            <p style="word-break: break-all; font-size: 0.95em;">
                {{ url('/seller/login') }}
            </p>

            <p>Best regards,<br>
                <strong>The {{ config('app.name') }} Team</strong>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you did not register as a seller, please ignore this email.</p>
        </div>
    </div>

</body>

</html>
