@component('mail::message')
# <center>New password: {{ $data }}</center>

@component('mail::button', ['url' => '/'] )
    Go to website
@endcomponent

@endcomponent
