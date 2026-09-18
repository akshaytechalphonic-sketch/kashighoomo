<?php

namespace App\Mail;

use App\Models\Enquiry;
use App\Models\Package;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PackageEnquiryConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Enquiry $enquiry;
    public Package $package;

    public function __construct(Enquiry $enquiry, Package $package)
    {
        $this->enquiry = $enquiry;
        $this->package = $package;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Enquiry Received — ' . $this->package->title . ' | Visit Kashi',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.package-enquiry-confirmation',
        );
    }
}
