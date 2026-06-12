@php
    $rows = [
        ['Name', $data['name']],
        ['Email', $data['email']],
        ['Phone', $data['phone'] ?: '—'],
        ['Service interest', $data['service'] ?: '—'],
    ];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New contact enquiry</title>
</head>
<body style="margin:0; padding:0; background-color:#f7f4ec; font-family:-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif; color:#2c3b47;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f7f4ec; padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px; background-color:#ffffff; border-radius:18px; overflow:hidden; box-shadow:0 12px 40px -18px rgba(12,22,29,0.25);">

                    {{-- Header --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#14887f,#16242e); padding:28px 32px;">
                            <p style="margin:0; font-size:13px; letter-spacing:0.14em; text-transform:uppercase; color:#aeece1;">Danks &amp; Strydom Physiotherapy</p>
                            <h1 style="margin:6px 0 0; font-size:21px; font-weight:600; color:#ffffff;">New contact enquiry</h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:28px 32px 8px;">
                            <p style="margin:0 0 20px; font-size:15px; line-height:1.6; color:#4d6b7e;">
                                You've received a new enquiry through the website contact form.
                            </p>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                @foreach ($rows as [$label, $value])
                                    <tr>
                                        <td style="padding:10px 0; border-bottom:1px solid #e1e9ee; font-size:12px; text-transform:uppercase; letter-spacing:0.08em; color:#6c8a9d; width:38%; vertical-align:top;">{{ $label }}</td>
                                        <td style="padding:10px 0; border-bottom:1px solid #e1e9ee; font-size:15px; color:#16242e; font-weight:500;">
                                            @if ($label === 'Email')
                                                <a href="mailto:{{ $value }}" style="color:#14887f; text-decoration:none;">{{ $value }}</a>
                                            @elseif ($label === 'Phone' && $value !== '—')
                                                <a href="tel:{{ $value }}" style="color:#14887f; text-decoration:none;">{{ $value }}</a>
                                            @else
                                                {{ $value }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            {{-- Message --}}
                            <p style="margin:24px 0 8px; font-size:12px; text-transform:uppercase; letter-spacing:0.08em; color:#6c8a9d;">Message</p>
                            <div style="padding:16px 18px; background-color:#f3f6f8; border-radius:12px; font-size:15px; line-height:1.65; color:#324553; white-space:pre-wrap;">{{ $data['message'] }}</div>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:20px 32px 28px;">
                            <p style="margin:0; font-size:13px; color:#9bb2c0;">
                                Submitted {{ $submittedAt->format('l, j F Y \a\t H:i') }}.
                                Reply directly to this email to respond to {{ $data['name'] }}.
                            </p>
                        </td>
                    </tr>
                </table>

                <p style="margin:18px 0 0; font-size:12px; color:#9bb2c0;">
                    This message was sent from the {{ config('app.name') }} website.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
