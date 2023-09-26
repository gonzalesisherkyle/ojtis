@component('mail::message')
# <center>Your application has been approved.</center>

@component('mail::button', ['url' => '/'] )
    Go to website
@endcomponent

@endcomponent