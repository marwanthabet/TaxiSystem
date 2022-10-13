@component('mail::message')
# Taxi System

Welcome in Taxi System, enjoy our services.

@component('mail::panel')
To login to your CMS click on the below button.
@endcomponent

@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/admin'])
Admin Panel
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
