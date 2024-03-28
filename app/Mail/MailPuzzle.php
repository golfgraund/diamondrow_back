<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailPuzzle extends Mailable
{
    use Queueable, SerializesModels;

    public array $params;

    protected $object, $emails;

    /** Create a new message instance.
     * @param array $subjectEmail
     * @param array $params
     * @param $object
     */
    public function __construct(array $subjectEmail, array $params, $object)
    {
        $this->params = $params;
        $this->object = $object;
        $this->emails = $subjectEmail;
    }

    /** Build the message.
     * @return $this
     */
    public function build(): static
    {
        $mail = $this
            ->to($this->emails)
            ->subject('Инструкция для вашей мозаики')
            ->attachFromStorage($this->object->localPdfPath());

        return $mail->view('mail.puzzle');
    }
}
