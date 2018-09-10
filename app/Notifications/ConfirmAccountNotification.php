<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmAccountNotification extends Notification
{
    use Queueable;

    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('notifications.account_confirm.subject'))
            ->greeting(sprintf(trans('notifications.account_confirm.greeting'), $this->user->name))
            ->line(trans('notifications.account_confirm.header'))
            ->action(trans('notifications.account_confirm.action'), route('account.confirm', $this->user->confirmation_token))
            ->line(trans('notifications.account_confirm.footer'));
    }

    /**
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
