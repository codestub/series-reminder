@component('mail::message')
# Hi {{ $name }}

Thanks for your interest in our app, please click the link below to complete the registration process!

@component('mail::button', ['url' => $url])
Complete registration
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
