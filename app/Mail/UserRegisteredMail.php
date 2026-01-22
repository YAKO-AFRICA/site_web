<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class UserRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $emailSubject;
    public $emailType;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData, $emailSubject, $emailType = 'password-reset')
    {
        $this->mailData = $mailData;
        $this->emailSubject = $emailSubject;
        $this->emailType = $emailType;
    }

    /**
     * Get the message envelope.
     */

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // return new Envelope(
        //     subject: $this->emailSubject,
        // );
        return new Envelope(
            from: new Address(
                config('mail.from.address'),
                config('mail.from.name')
            ),
            replyTo: [
                new Address(config('mail.from.address'), config('mail.from.name')),
            ],
            subject: $this->emailSubject,
            tags: [$this->emailType, 'client', 'yako-africassur'],
            metadata: [
                'customer_email' => $this->mailData['destinatorEmail'] ?? '',
                'email_type' => $this->emailType,
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'users.espace_client.auth.mailSend',
            with: [
                'mailData' => $this->mailData,
                'preheaderText' => $this->getPreheaderText(),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    private function getPreheaderText(): string
    {
        if ($this->emailType === 'password-reset') {
            return 'Réinitialisation de votre mot de passe - Yako Africa Assurances Vie';
        } else if ($this->emailType === 'account-update') {
            return 'Votre compte Yako Africa Assurances Vie a été mis à jour avec succès';
        } else if ($this->emailType === 'account-request') {
            return 'Votre demande de création de compte a été enregistrée - Yako Africa Assurances Vie';
        } else if ($this->emailType === 'contract-added') {
            return 'Le contrat a bien été ajouté à votre compte';
        } else if ($this->emailType === 'account-register' || $this->emailType === 'account-register-end') {
            return 'Votre compte Ynov - Yako Africa Assurances Vie a bien été crée';
        }
        
        return 'Message de Yako Africa Assurances Vie';
    }
}
