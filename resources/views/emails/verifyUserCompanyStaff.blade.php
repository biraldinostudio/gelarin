@extends('emails.layouts.master')
@section('title', trans('mail.Please verify your email address', ['appName' => config('app.name')]))

<?php
use App\Helpers\BahasaPlanet;
?>
@section('content')
<table class="body-wrap" bgcolor="#f6f6f6" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 20px;">
<tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
    <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
    <td class="container" bgcolor="#FFFFFF" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 800px !important; Margin: 0 auto; padding: 20px; border: 1px solid #f0f0f0;">
    <!-- content -->
    <div class="content" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 800px; margin: 0 auto; padding: 0;">
    <table style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
        <tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
            <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
                <h3 style="font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; font-size: 20px; line-height: 1.2em; color: #111111; font-weight: bold; margin: 0 0 10px; padding: 0;">@lang('auth.Welcome to the site') {{$user['name']}}</h3>
		        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0; display: inline-block; max-width: 100%; word-wrap: break-word;">@lang('mail.Your login account information'):</p><br>
		        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0; display: inline-block; max-width: 100%; word-wrap: break-word;">@lang('mail.Email'): {{$user['email']}}</p><br>		
		        <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0; display: inline-block; max-width: 100%; word-wrap: break-word;">@lang('mail.Password'): {{HelpBahasaPlanet::encrypt_decrypt('decrypt', $user['password'])}}</p><br>
                <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0; display: inline-block; max-width: 100%; word-wrap: break-word;">@lang('mail.Click the button below to verify your email address.')</p>
                <!-- button -->
                <table class="btn-primary" cellpadding="0" cellspacing="0" border="0" style="background:#2867b2; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: auto !important; margin: 20px 0 20px; padding: 0;">
                    <tr style="background:#2867b2; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
                        <td style="font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; font-size: 14px; line-height: 1.6em; border-radius: 25px; text-align: center; vertical-align: top; background:#2867b2; margin: 0; padding: 0;" align="center" bgcolor="#2867b2" valign="top"><a href="{{route('company.staff.verify', $user->verifyUser->token)}}" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 2; color: #ffffff; border-radius: 25px; display: inline-block; cursor: pointer; font-weight: bold; text-decoration: none; background: #2867b2; margin: 0; padding: 0; border-color: #2867b2; border-style: solid; border-width: 10px 20px;">@lang('mail.Verify email address')</a></td>
					</tr>
                </table>
                <!-- /button -->
				<br>
                <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0; display: inline-block; max-width: 100%; word-wrap: break-word;">@lang('mail.Button does not work? Paste the following link into your browser:', ['verificationLink' => route('company.staff.verify', $user->verifyUser->token)])
                @lang('mail.You are receiving this email because you have just registered for membership recruitment at gelarin.com. If this is not you, please ignore this email.')
                @lang('mail.Thank you. Gelarin.com Team')</p>
            </td>
        </tr>
    </table>
    </div>
    <!-- /content -->
    </td>
    <td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
</tr>
</table>
@endsection