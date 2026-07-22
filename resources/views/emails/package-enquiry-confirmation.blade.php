<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Enquiry Received</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-top: 4px solid #F57C00;
        }
        .header {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #eeeeee;
        }
        .header h1 {
            font-size: 22px;
            color: #222222;
            margin: 0 0 5px 0;
        }
        .header p {
            font-size: 14px;
            color: #666666;
            margin: 0;
        }
        .body {
            padding: 30px 25px;
            font-size: 14px;
            line-height: 1.6;
            color: #333333;
        }
        .greeting {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #111111;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #F57C00;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            margin-top: 25px;
        }
        .pkg-highlight {
            background-color: #fff9f2;
            border: 1px solid #ffe6cc;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .pkg-name {
            font-size: 16px;
            font-weight: bold;
            color: #222222;
        }
        .pkg-meta {
            font-size: 13px;
            color: #666666;
            margin-top: 5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 10px;
            border-bottom: 1px solid #f2f2f2;
            vertical-align: top;
        }
        .label {
            font-size: 12px;
            color: #888888;
            font-weight: bold;
            width: 35%;
        }
        .value {
            font-size: 14px;
            color: #222222;
        }
        .steps {
            background-color: #fafafa;
            padding: 15px 20px;
            border-radius: 6px;
            border: 1px solid #eeeeee;
            margin-bottom: 25px;
        }
        .step {
            margin-bottom: 10px;
        }
        .step:last-child {
            margin-bottom: 0;
        }
        .contact-box {
            background-color: #0b1a29;
            border-radius: 6px;
            padding: 15px 20px;
            color: #ffffff;
            margin-top: 25px;
        }
        .contact-box a {
            color: #F57C00;
            text-decoration: none;
            font-weight: bold;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🙏 Enquiry Received</h1>
        <p>Thank you for choosing Visit Kashi.</p>
    </div>
    <div class="body">
        <p class="greeting">Namaste {{ $enquiry->name }},</p>
        <p>We have received your enquiry for the <strong>{{ $package->title }}</strong> package. Our tour expert will review your request and get in touch with you shortly to discuss your custom itinerary.</p>

        <div class="section-title">Enquired Package</div>
        <div class="pkg-highlight">
            <div class="pkg-name">{{ $package->title }}</div>
            <div class="pkg-meta">
                @if($package->destination) Destination: {{ $package->destination->name }} &nbsp;•&nbsp; @endif
                @if($package->duration) Duration: {{ $package->duration }} &nbsp;•&nbsp; @endif
                @if($package->price) Price: Starting ₹{{ number_format($package->price) }} @endif
            </div>
        </div>

        <div class="section-title">Summary Details</div>
        <table class="info-table">
            <tr>
                <td class="label">Travel Date</td>
                <td class="value">{{ $enquiry->travel_date ? \Carbon\Carbon::parse($enquiry->travel_date)->format('d M Y') : '—' }}</td>
            </tr>
            <tr>
                <td class="label">Travellers</td>
                <td class="value">
                    {{ $enquiry->adults }} Adult(s)
                    @if($enquiry->children > 0), {{ $enquiry->children }} Child(ren)@endif
                </td>
            </tr>
            <tr>
                <td class="label">Your Contact</td>
                <td class="value">{{ $enquiry->phone }} / {{ $enquiry->email }}</td>
            </tr>
        </table>

        <div class="section-title">What Happens Next?</div>
        <div class="steps">
            <div class="step"><strong>1. Expert Review</strong>: We review your preferences.</div>
            <div class="step"><strong>2. Personal Consultation</strong>: We call or WhatsApp you to customize the plan.</div>
            <div class="step"><strong>3. Final Quote</strong>: You receive a customized itinerary and package price.</div>
        </div>

        <div class="contact-box">
            @php $settings = \App\Models\Setting::first(); @endphp
            <strong>Need help right away?</strong><br>
            📞 Call/WhatsApp: <a href="tel:{{ str_replace(' ', '', $settings?->contact_phone ?? '+917080109917') }}">{{ $settings?->contact_phone ?? '+91 70801 09917' }}</a><br>
            ✉️ Email: <a href="mailto:{{ $settings?->contact_email ?? 'info.visitkashi@gmail.com' }}">{{ $settings?->contact_email ?? 'info.visitkashi@gmail.com' }}</a>
        </div>
    </div>
    <div class="footer">
        <p>© {{ date('Y') }} <strong>Visit Kashi</strong> — Most Trusted Varanasi Yatra Travel Partner.<br>
        <span style="color:#bbb;">This is an automatic confirmation email. Please do not reply directly.</span></p>
    </div>
</div>
</body>
</html>
