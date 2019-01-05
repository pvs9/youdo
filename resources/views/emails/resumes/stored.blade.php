@component('mail::message')
# Introduction

Thanks for sending us your resume. It now has an id: {{ $id }}. Please pay the bill to publish it.

@component('mail::button', ['url' => ''])
Pay
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
