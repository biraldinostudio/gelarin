<?php

namespace App\Notifications;
use Route;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
//use App\Mail\ResetPassword as Mailable;
class ResetPassword extends Notification
{
    use Queueable;
public $token;
    public static $toMailCallback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
public function __construct($token)
{
$this->token = $token;
}

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }
		if(Route::is('company.password.email')){
			return (new MailMessage)
				->from('noreply@gelarin.com', 'Noreply Gelarin')
				->subject(trans('mail.Password Reset Request'))				
				->line(trans('mail.You are receiving this email because we received a password reset request for your account.'))
				->line(trans('mail.To get started please click the following button:'))			
				->action(trans('mail.Reset Password'), url(config('app.url').route('company.password.reset', $this->token, false)))
				->line(trans('mail.If you did not request a password reset, no further action is required.'));
		}
		else{
			return (new MailMessage)
				->from('noreply@gelarin.com', 'Noreply Gelarin')
				->subject(trans('mail.Password Reset Request'))				
				->line(trans('mail.You are receiving this email because we received a password reset request for your account.'))
				->line(trans('mail.To get started please click the following button:'))			
				->action(trans('mail.Reset Password'), url(config('app.url').route('password.reset', $this->token, false)))
				->line(trans('mail.If you did not request a password reset, no further action is required.'));
			}		
		
   }
	


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
