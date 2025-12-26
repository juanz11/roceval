<?php

namespace App\Mail;

use App\Models\Cotizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CotizacionGeneradaMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var array<int, Attachment> */
    private array $mailAttachments = [];

    public function __construct(public Cotizacion $cotizacion)
    {
    }

    public function attachCotizacionPdf(string $filename, string $binary): self
    {
        $this->mailAttachments[] = Attachment::fromData(fn () => $binary, $filename)
            ->withMime('application/pdf');

        return $this;
    }

    public function attachCotizacionHtml(string $filename, string $html): self
    {
        $this->mailAttachments[] = Attachment::fromData(fn () => $html, $filename)
            ->withMime('text/html');

        return $this;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu solicitud fue aceptada - Aquí está tu cotización'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.cotizacion_generada'
        );
    }

    public function attachments(): array
    {
        return $this->mailAttachments;
    }
}
