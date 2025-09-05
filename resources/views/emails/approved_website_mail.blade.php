<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Website Approved</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background:#f6f8fb;">
<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <td align="center" style="padding:40px 0;">
            <!-- Card -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="background:#fff; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.05); overflow:hidden;">
                <!-- Header -->
                <tr>
                    <td align="center" style="background:#4F46E5; padding:20px;">
                        <img src="{{ env('APP_URL') . \App\Models\Helper::logoImagePath()}}" alt="Logo" style="max-height:50px;">
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:30px; color:#333; font-size:16px; line-height:1.6;">
                        <h2 style="margin-top:0; color:#111;">Good news!</h2>
                        <p>Your website <strong>{{ $website->name }}</strong> has been <span style="color:#16a34a;">approved</span>.</p>
                        <p>Please check the details by clicking the button below.</p>

                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:30px auto;">
                            <tr>
                                <td align="center" bgcolor="#4F46E5" style="border-radius:8px;">
                                    <a href="{{ route('user.website') }}" target="_blank"
                                       style="display:inline-block; padding:12px 24px; font-size:16px; color:#ffffff;
                                                  text-decoration:none; border-radius:8px; font-weight:bold;">
                                        Check Now
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td align="center" style="background:#f3f4f6; padding:15px; font-size:13px; color:#6b7280;">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
