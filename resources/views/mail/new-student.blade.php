@component('mail::message')
# <center>Password: {{ $data }}</center>

@component('mail::button', ['url' => '/'] )
    Go to website
@endcomponent

@endcomponent