<?php

namespace CleaniqueCoders\LaravelHelper\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification as BaseNotification;

class Notification extends BaseNotification
{
    use Queueable;

    public $subject;
    public $content;
    public $link;
    public $link_label;
    public $data;
    public $template;
    public $cc;
    public $bcc;
    public $attachments;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        $subject, $content,
        $link = null, $link_label = null,
        $data = null, $attachments = null,
        $cc = null, $bcc = null,
        $template = 'mail.notification'
    ) {
        $this->subject     = $subject;
        $this->content     = $content;
        $this->link        = $link;
        $this->link_label  = $link_label;
        $this->data        = $data;
        $this->template    = $template;
        $this->cc          = $cc;
        $this->bcc         = $bcc;
        $this->attachments = $attachments;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = (new MailMessage())
            ->subject($this->subject)
            ->markdown($this->template, [
                'subject'    => $this->subject,
                'content'    => $this->content,
                'link'       => $this->link,
                'link_label' => $this->link_label,
                'data'       => $this->data,
            ]);

        if ($this->cc) {
            $mail->cc($this->cc);
        }

        if ($this->bcc) {
            $mail->bcc($this->bcc);
        }

        if ($this->attachments) {
            if (is_array($this->attachments)) {
                foreach ($this->attachments as $attachment) {
                    $mail->attach($attachment);
                }
            } else {
                $mail->attach($this->attachments);
            }
        }

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'subject'     => $this->subject,
            'content'     => $this->content,
            'link'        => $this->link,
            'link_label'  => $this->link_label,
            'data'        => $this->data,
            'template'    => $this->template,
            'cc'          => $this->cc,
            'bcc'         => $this->bcc,
            'attachments' => $this->attachments,
        ];
    }
}
