@extends('layouts.app')

@section('title', $page->meta_title ?? 'Contact Us | Visit Kashi')
@section('meta_description', $page->meta_description ?? 'Get in touch with Visit Kashi. Plan your Varanasi holiday,
    local cabs, boat rides, and yatra packages.')
@section('meta_keywords', $page->meta_keywords ?? 'contact visit kashi, varanasi tour planner')

@push('styles')
    <style>
        /* ======= PAGE HEADER ======= */
        .contact-page-header {
            background: linear-gradient(135deg, #0b1a29 0%, #1a2e42 100%);
            padding: 38px 0 32px;
            margin-top: 82px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .contact-page-header::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 180px;
            height: 180px;
            background: rgba(245, 124, 0, 0.08);
            border-radius: 50%;
        }

        .contact-page-header::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -30px;
            /* width: 220px; height: 220px; */
            background: rgba(245, 124, 0, 0.05);
            border-radius: 50%;
        }

        .contact-page-header h1 {
            font-size: 1.9rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            margin-bottom: 6px;
            position: relative;
            z-index: 1;
        }

        .contact-page-header p {
            color: rgba(255, 255, 255, 0.55) !important;
            font-size: 0.88rem !important;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        /* ======= MAIN SECTION ======= */
        .contact-section {
            background: #f5f0ea;
            padding: 50px 0 60px;
        }

        .contact-section .container {
            max-width: 1060px !important;
        }

        /* ======= INFO CARD (LEFT) ======= */
        .contact-info-card {
            background: linear-gradient(160deg, #0f2035 0%, #0b1a29 60%, #0d2238 100%);
            border-radius: 18px;
            padding: 36px 30px 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(11, 26, 41, 0.25);
        }

        .contact-info-card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 160px;
            height: 160px;
            background: rgba(245, 124, 0, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .contact-info-card::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: -40px;
            width: 120px;
            height: 120px;
            background: rgba(245, 124, 0, 0.05);
            border-radius: 50%;
            pointer-events: none;
        }

        .contact-info-card h2 {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            margin-bottom: 5px;
        }

        .contact-info-card .card-subtitle {
            color: rgba(255, 255, 255, 0.45) !important;
            font-size: 0.78rem !important;
            margin-bottom: 28px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 22px;
            position: relative;
            z-index: 1;
        }

        .info-item .icon-box {
            width: 38px;
            height: 38px;
            min-width: 38px;
            background: rgba(245, 124, 0, 0.12);
            border: 1px solid rgba(245, 124, 0, 0.2);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 13px;
            margin-top: 1px;
        }

        .info-item .icon-box i {
            color: #F57C00;
            font-size: 15px;
        }

        .info-item .info-label {
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #F57C00;
            margin-bottom: 3px;
        }

        .info-item .info-text {
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.5;
        }

        .info-item .info-text a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: color 0.2s;
        }

        .info-item .info-text a:hover {
            color: #F57C00;
        }

        /* Socials */
        .info-socials {
            margin-top: auto;
            padding-top: 18px;
            position: relative;
            z-index: 1;
        }

        .info-socials .s-label {
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255, 255, 255, 0.3);
            margin-bottom: 10px;
        }

        .social-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .s-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.25s;
        }

        .s-btn:hover {
            background: #F57C00;
            border-color: #F57C00;
            color: #fff;
            transform: translateY(-2px);
        }

        /* ======= FORM CARD (RIGHT) ======= */
        .contact-form-card {
            background: #ffffff;
            border: 1px solid #ebebeb;
            border-radius: 18px;
            padding: 34px 30px 30px;
            height: 100%;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
        }

        .contact-form-card h2 {
            font-size: 1.2rem !important;
            font-weight: 700 !important;
            color: #1a1a1a !important;
            margin-bottom: 4px;
        }

        .contact-form-card .card-subtitle {
            color: #888 !important;
            font-size: 0.77rem !important;
            margin-bottom: 22px;
        }

        .contact-form-card .form-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
            text-transform: capitalize;
            letter-spacing: 0.2px;
        }

        .contact-form-card .form-control,
        .contact-form-card .form-select {
            border: 1.5px solid #e5e5e5;
            border-radius: 9px;
            padding: 8px 12px;
            font-size: 0.82rem;
            color: #333;
            background: #fafafa;
            transition: all 0.2s;
            height: 38px;
        }

        .contact-form-card textarea.form-control {
            height: auto;
            resize: none;
        }

        .contact-form-card .form-control:focus,
        .contact-form-card .form-select:focus {
            border-color: #F57C00;
            box-shadow: 0 0 0 3px rgba(245, 124, 0, 0.06);
            background: #fff;
            outline: none;
        }

        .contact-form-card .form-control::placeholder {
            color: #aaa;
            font-size: 0.8rem;
        }

        /* Guest Counter */
        .guest-counter-wrap label.form-label {
            display: block;
        }

        .guest-counter {
            display: flex;
            align-items: center;
            border: 1.5px solid #e5e5e5;
            border-radius: 9px;
            overflow: hidden;
            height: 38px;
            background: #fafafa;
        }

        .guest-counter .c-btn {
            width: 32px;
            height: 38px;
            background: #f5f5f5;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #444;
            font-size: 16px;
            font-weight: bold;
            transition: 0.2s;
            cursor: pointer;
            flex-shrink: 0;
        }

        .guest-counter .c-btn:hover {
            background: #ffe8d0;
            color: #F57C00;
        }

        .guest-counter .c-val {
            flex: 1;
            border: none;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 700;
            color: #333;
            background: transparent;
            min-width: 28px;
            outline: none;
            -moz-appearance: textfield;
        }

        .guest-counter .c-val::-webkit-outer-spin-button,
        .guest-counter .c-val::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .guest-label-small {
            font-size: 0.65rem;
            color: #999;
            font-weight: 400;
        }

        /* WhatsApp Submit */
        .btn-wa-submit {
            background: #25D366;
            color: #fff !important;
            font-size: 0.88rem;
            font-weight: 700;
            padding: 11px 20px;
            border-radius: 9px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            width: 100%;
            margin-top: 6px;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(37, 211, 102, 0.2);
        }

        .btn-wa-submit:hover {
            background: #1fb858;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(37, 211, 102, 0.3);
        }

        .btn-wa-submit i {
            font-size: 17px;
        }

        .wa-caption {
            font-size: 0.68rem;
            color: #999;
            text-align: center;
            margin-top: 8px;
            line-height: 1.4;
        }

        /* ======= MAP CARD ======= */
        .contact-map-wrap {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e5e5e5;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.04);
            margin-top: 32px;
        }

        .contact-map-wrap iframe {
            width: 100%;
            height: 320px;
            border: none;
            display: block;
        }

        /* ======= RESPONSIVE ======= */
        @media (max-width: 991px) {
            .contact-page-header {
                margin-top: 76px;
                padding: 30px 0 24px;
            }

            .contact-info-card {
                padding: 28px 22px;
                margin-bottom: 0;
            }

            .contact-form-card {
                padding: 28px 22px;
            }
        }

        @media (max-width: 767px) {
            .contact-page-header {
                margin-top: 72px;
            }

            .contact-page-header h1 {
                font-size: 1.5rem !important;
            }

            .contact-section {
                padding: 30px 0 40px;
            }

            .contact-info-card,
            .contact-form-card {
                border-radius: 14px;
                padding: 24px 18px;
            }

            .contact-map-wrap iframe {
                height: 260px;
            }
        }

        /* @media (max-width: 575px) {
        .contact-page-header h1 { font-size: 1.3rem !important; }
        .contact-form-card .row.g-3 { --bs-gutter-y: 0.6rem; }
    } */

        .call-btn {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            padding: 14px 26px 14px 18px;
            background: linear-gradient(180deg, #66db74, #52c767);
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .18);
            transition: .3s ease;
        }

        .call-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 22px rgba(0, 0, 0, .25);
        }

        .call-icon {
            width: 42px;
            height: 42px;
            border: 2px solid rgba(255, 255, 255, .7);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 18px;
            animation: ring 1.5s infinite;
        }

        .call-content {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .call-number {
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .call-text {
            color: #eaffea;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 4px;
        }

        @keyframes ring {
            0% {
                transform: rotate(0deg);
            }

            10% {
                transform: rotate(15deg);
            }

            20% {
                transform: rotate(-15deg);
            }

            30% {
                transform: rotate(12deg);
            }

            40% {
                transform: rotate(-12deg);
            }

            50% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        /* Mobile */
        @media(max-width:576px) {
            .call-btn {
                padding: 12px 20px;
            }

            .call-number {
                font-size: 11px;
            }

            .call-text {
                font-size: 10px;
            }

            .call-icon {
                width: 38px;
                height: 38px;
                font-size: 16px;
            }
        }
    </style>
@endpush

@section('content')

    @php
        $contactBanner = $sections->get('contect_banner');
        $contactTitle = $contactBanner->title ?? 'Contact Us';
        $contactDesc =
            $contactBanner->description ?? "We're here to make your Varanasi journey perfect — reach out anytime.";

        $contactBg = !empty($contactBanner?->image) ? asset('storage/' . $contactBanner->image) : null;
    @endphp

    <div class="page-title"
        @if ($contactBg) style="background: linear-gradient(rgba(6,22,36,0.25), rgba(6,22,36,0.35)), url('{{ $contactBg }}') center center/cover no-repeat !important;" @endif>
        <div class="container">
            <h1 class="text-center title wow animate__animated animate__fadeInUp">
                {{ $contactTitle }}
            </h1>

            <div class="breadcrumb-content wow animate__animated animate__fadeInUp">
                <div class="d-flex justify-content-center text-white opacity-75">
                    {!! $contactDesc !!}
                </div>
            </div>
        </div>
    </div>
    {{-- ===== MAIN CONTACT SECTION ===== --}}
    <div class="contact-section">
        <div class="container">
            <div class="row g-4 align-items-stretch">

                {{-- LEFT: Get in Touch Info Card --}}
                <div class="col-lg-5 col-md-12">
                    <div class="contact-info-card">
                        <div>
                            <h2>Get in Touch</h2>
                            <p class="card-subtitle">We're here to make your Varanasi journey perfect.</p>

                            {{-- Address --}}
                            <div class="info-item">
                                <div class="icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                                <div>
                                    <div class="info-label">Address</div>
                                    <div class="info-text">
                                        {{ $settings->address ?? 'B-21/19, Rathyatra Kamachha Rd, Bhelupur, Varanasi - 221010, Uttar Pradesh, India.' }}
                                    </div>
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="info-item">
                                <div class="icon-box"><i class="bi bi-telephone-fill"></i></div>
                                <div>
                                    <div class="info-label">Phone / WhatsApp</div>
                                    <div class="info-text">
                                        @if ($settings->contact_phone)
                                            <a
                                                href="tel:{{ str_replace(' ', '', $settings->contact_phone) }}">{{ $settings->contact_phone }}</a>
                                        @else
                                            <a href="tel:917080109917">+91 70801 09917</a>
                                        @endif
                                        @if (!empty($settings->phone_two))
                                            <br><a
                                                href="tel:{{ str_replace(' ', '', $settings->phone_two) }}">{{ $settings->phone_two }}</a>
                                        @endif
                                        @if ($settings->whatsapp_number)
                                            <br><a
                                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}"
                                                target="_blank">{{ $settings->whatsapp_number }} (WhatsApp)</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="info-item">
                                <div class="icon-box"><i class="bi bi-envelope-fill"></i></div>
                                <div>
                                    <div class="info-label">Email</div>
                                    <div class="info-text">
                                        <a
                                            href="mailto:{{ $settings->contact_email ?? 'info.visitkashi@gmail.com' }}">{{ $settings->contact_email ?? 'info.visitkashi@gmail.com' }}</a>
                                    </div>
                                </div>
                            </div>

                            {{-- Hours --}}
                            <div class="info-item">
                                <div class="icon-box"><i class="bi bi-clock-fill"></i></div>
                                <div>
                                    <div class="info-label">Working Hours</div>
                                    <div class="info-text">Mon – Sun: 7:00 AM – 10:00 PM<br>WhatsApp available 24×7</div>
                                </div>
                            </div>
                        </div>

                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" class="call-btn">
                            <div class="call-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>

                            <div class="call-content">
                                <span class="call-number">CALL - {{ $settings->whatsapp_number }}</span>
                                <span class="call-text">CALL NOW & TALK TO OUR EXPERT</span>
                            </div>
                        </a>


                        {{-- Social Buttons --}}
                        <div class="info-socials">
                            <div class="s-label">Follow Us</div>
                            <div class="social-row">
                                @if ($settings->facebook_url)
                                    <a href="{{ $settings->facebook_url }}" target="_blank" class="s-btn"
                                        aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if ($settings->instagram_url)
                                    <a href="{{ $settings->instagram_url }}" target="_blank" class="s-btn"
                                        aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if ($settings->twitter_url)
                                    <a href="{{ $settings->twitter_url }}" target="_blank" class="s-btn"
                                        aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                                @endif
                                @if ($settings->whatsapp_number)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}"
                                        target="_blank" class="s-btn" aria-label="WhatsApp"><i
                                            class="bi bi-whatsapp"></i></a>
                                @else
                                    <a href="https://wa.me/917080109917" target="_blank" class="s-btn"
                                        aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: WhatsApp Enquiry Form --}}
                <div class="col-lg-7 col-md-12">
                    <div class="contact-form-card">
                        <h2>Send Enquiry on WhatsApp</h2>
                        <p class="card-subtitle">Fill in your details and we'll connect you instantly via WhatsApp.</p>

                        <form id="waEnquiryForm" novalidate>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="wsName">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="wsName" class="form-control"
                                        placeholder="e.g. Rahul Sharma" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="wsPhone">Contact Number <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" id="wsPhone" class="form-control" placeholder="+91 XXXXX XXXXX"
                                        required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="wsDate">Travel Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" id="wsDate" class="form-control" required
                                        min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="wsService">Service Required <span
                                            class="text-danger">*</span></label>
                                    <select id="wsService" class="form-select" required>
                                        <option value="" disabled selected>-- Select Service --</option>
                                        <option>Tour Packages</option>
                                        <option>Cab Booking</option>
                                        <option>Boat Ride Booking</option>
                                        <option>Hotel Booking</option>
                                        <option>Other</option>
                                    </select>
                                </div>

                                {{-- Guest Counters --}}
                                <div class="col-4">
                                    <label class="form-label">Adults <span class="text-danger">*</span></label>
                                    <div class="guest-counter">
                                        <button type="button" class="c-btn" onclick="cAdj('wsAdults',-1)">−</button>
                                        <input type="number" id="wsAdults" class="c-val" min="1"
                                            value="2" readonly>
                                        <button type="button" class="c-btn" onclick="cAdj('wsAdults',1)">+</button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Children <span class="guest-label-small">(5-17
                                            yrs)</span></label>
                                    <div class="guest-counter">
                                        <button type="button" class="c-btn" onclick="cAdj('wsChildren',-1)">−</button>
                                        <input type="number" id="wsChildren" class="c-val" min="0"
                                            value="0" readonly>
                                        <button type="button" class="c-btn" onclick="cAdj('wsChildren',1)">+</button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Infants <span class="guest-label-small">(0-4
                                            yrs)</span></label>
                                    <div class="guest-counter">
                                        <button type="button" class="c-btn" onclick="cAdj('wsInfants',-1)">−</button>
                                        <input type="number" id="wsInfants" class="c-val" min="0"
                                            value="0" readonly>
                                        <button type="button" class="c-btn" onclick="cAdj('wsInfants',1)">+</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="wsMessage">Message / Special Requirements</label>
                                    <textarea id="wsMessage" class="form-control" rows="3"
                                        placeholder="Tell us about your trip — pickup point, hotel preference, special requests..."></textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn-wa-submit">
                                        <i class="bi bi-whatsapp"></i> Send on WhatsApp
                                    </button>
                                    <p class="wa-caption">Your details will open WhatsApp with a pre-filled message. No app
                                        download needed on desktop.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Google Map --}}
            @if ($settings->google_map_link)
                <div class="contact-map-wrap wow animate__animated animate__fadeInUp">
                    <iframe src="{{ $settings->google_map_link }}" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Visit Kashi Location Map">
                    </iframe>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function cAdj(id, offset) {
            const el = document.getElementById(id);
            const min = parseInt(el.getAttribute('min')) || 0;
            let v = (parseInt(el.value) || 0) + offset;
            if (v >= min) el.value = v;
        }

        document.getElementById('waEnquiryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('wsName').value.trim();
            const phone = document.getElementById('wsPhone').value.trim();
            const date = document.getElementById('wsDate').value;
            const service = document.getElementById('wsService').value;
            const adults = document.getElementById('wsAdults').value;
            const children = document.getElementById('wsChildren').value;
            const infants = document.getElementById('wsInfants').value;
            const msg = document.getElementById('wsMessage').value.trim();

            if (!name || !phone || !date || !service) {
                alert('Please fill in all required fields.');
                return;
            }

            let waMsg = `Hello Kashi Khoomo 🙏\n\nI would like to make an enquiry:\n`;
            waMsg += `• *Name:* ${name}\n`;
            waMsg += `• *Contact:* ${phone}\n`;
            waMsg += `• *Travel Date:* ${date}\n`;
            waMsg += `• *Service:* ${service}\n`;
            waMsg += `• *Travellers:* ${adults} Adults, ${children} Children, ${infants} Infants\n`;
            if (msg) waMsg += `• *Message:* ${msg}\n`;

            // Store lead in DB
            fetch('{{ route('contact.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    name,
                    phone,
                    email: 'wa.lead@visitkashi.com',
                    subject: 'WhatsApp Lead: ' + service,
                    message: `Service: ${service} | Travellers: ${adults}A/${children}C/${infants}I | ${msg}`
                })
            }).catch(() => {});

            const target = "{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '917080109917') }}";
            window.open(`https://wa.me/${target}?text=${encodeURIComponent(waMsg)}`, '_blank');
        });
    </script>
@endpush
