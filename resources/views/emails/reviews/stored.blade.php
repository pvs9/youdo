@component('mail::message')
    # Introduction

    Thanks for reviewing the resume. Please verify the email to publish it.

    @component('mail::button', ['url' => $url])
        Verify
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
