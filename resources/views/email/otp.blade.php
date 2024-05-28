@component('mail::message')
# Your OTP Code

Your OTP code is: {{ $otp }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
