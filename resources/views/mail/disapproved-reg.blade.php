@component('mail::message')
# <center>Your application has been denied.</center>


@component('mail::button', ['url' => '/'] )
    Go to website
@endcomponent

@endcomponent