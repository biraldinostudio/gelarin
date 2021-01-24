@component('mail::message')
# Hello!<br>

@lang('mail.You are receiving this email because we received a password reset request for your account.')<br>
@lang('mail.To get started please click the following button:')<br>
@component('mail::button', ['url' => 'url'])
@lang('mail.Reset Password')
@endcomponent<br>


@lang('mail.If you did not request a password reset, no further action is required.')<br>

@lang('mail.Regards'),<br>
{{ config('app.name') }}
@endcomponent
