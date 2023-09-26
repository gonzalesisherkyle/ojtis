@component('mail::message')
# <center>New User/s needs approval.</center>

@component('mail::button', ['url' => '/'] )
    Go to website
@endcomponent

@endcomponent