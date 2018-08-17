<?php

namespace CleaniqueCoders\LaravelHelper\Services;

use CleaniqueCoders\LaravelHelper\Notifications\Notification;

class NotificationService
{
    public $user;
    public $subject;
    public $content;
    public $link;
    public $link_label;
    public $data;
    public $template = 'laravel-helper::mail.notification';
    public $cc;
    public $bcc;
    public $attachments;

    public function __construct($identifier, $column = 'id')
    {
        $this->user = config('helper.models.user')::where($column, $identifier)->firstOrFail();
    }

    public static function make($identifier)
    {
        return new self($identifier);
    }

    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function message($content)
    {
        $this->content = $content;

        return $this;
    }

    public function link($link)
    {
        $this->link = $link;

        return $this;
    }

    public function link_label($link_label)
    {
        $this->link_label = $link_label;

        return $this;
    }

    public function data($data)
    {
        $this->data = $data;

        return $this;
    }

    public function template($template)
    {
        $this->template = $template;

        return $this;
    }

    public function attachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    public function cc(array $cc)
    {
        $this->cc = $cc;

        return $this;
    }

    public function bcc(array $bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    public function send()
    {
        if ($this->user) {
            $this->user->notify(new Notification(
                $this->subject,
                $this->content,
                $this->link,
                $this->link_label,
                $this->data,
                $this->attachments,
                $this->cc,
                $this->bcc,
                $this->template
            ));
        } else {
            throw new \CleaniqueCoders\LaravelHelper\Exceptions\NoUserSpecifiedException('No User Specified.', 1);
        }
    }
}
