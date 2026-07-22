<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Package Enquiry</title>
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
        .section-title:first-child {
            margin-top: 0;
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
            font-weight: normal;
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
        .message-box {
            background-color: #f9f9f9;
            border-left: 3px solid #F57C00;
            padding: 12px 15px;
            font-size: 14px;
            color: #555555;
            line-height: 1.5;
            margin-bottom: 25px;
            font-style: italic;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            background-color: #F57C00;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 25px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 4px;
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
        <h1>📩 New Booking Enquiry</h1>
        <p>A new package enquiry has been received via Visit Kashi.</p>
    </div>
    <div class="body">
        <div class="section-title">Tour Package</div>
        <div class="pkg-highlight">
            <div class="pkg-name">{{ $package->title }}</div>
            <div class="pkg-meta">
                @if($package->destination) Destination: {{ $package->destination->name }} &nbsp;•&nbsp; @endif
                @if($package->duration) Duration: {{ $package->duration }} &nbsp;•&nbsp; @endif
                @if($package->price) Price: Starting ₹{{ number_format($package->price) }} @endif
            </div>
        </div>

        <div class="section-title">Customer Details</div>
        <table class="info-table">
            <tr>
                <td class="label">Full Name</td>
                <td class="value">{{ $enquiry->name }}</td>
            </tr>
            <tr>
                <td class="label">Phone Number</td>
                <td class="value"><a href="tel:{{ $enquiry->phone }}" style="color: #F57C00; text-decoration: none;">{{ $enquiry->phone }}</a></td>
            </tr>
            <tr>
                <td class="label">Email Address</td>
                <td class="value"><a href="mailto:{{ $enquiry->email }}" style="color: #F57C00; text-decoration: none;">{{ $enquiry->email }}</a></td>
            </tr>
            <tr>
                <td class="label">Travel Date</td>
                <td class="value">{{ $enquiry->travel_date ? \Carbon\Carbon::parse($enquiry->travel_date)->format('d M Y') : '—' }}</td>
            </tr>
            <tr>
                <td class="label">Total Travellers</td>
                <td class="value">
                    {{ $enquiry->adults }} Adult(s)
                    @if($enquiry->children > 0), {{ $enquiry->children }} Child(ren)@endif
                </td>
            </tr>
        </table>

        @if(!empty($enquiry->message) && $enquiry->message !== 'No message provided.')
            <div class="section-title">Message / Special Requirements</div>
            <div class="message-box">"{{ $enquiry->message }}"</div>
        @endif

        <div class="btn-container">
            <a href="mailto:{{ $enquiry->email }}" class="btn">Reply to Customer</a>
        </div>
    </div>
    <div class="footer">
        <p>Submitted on {{ now()->format('d M Y, h:i A') }}<br>
        <strong>Visit Kashi</strong> — Varanasi Tour Packages</p>
    </div>
</div>
</body>
</html>
