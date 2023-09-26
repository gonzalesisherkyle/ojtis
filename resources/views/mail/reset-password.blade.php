@component('mail::message')
# <center> We've received a request to reset the password.<br> You can reset your password by clicking the button below:</center>

@component('mail::button', ['url' => '/forgot-password/'.$user['token']] )
    Reset Password
@endcomponent

@endcomponent