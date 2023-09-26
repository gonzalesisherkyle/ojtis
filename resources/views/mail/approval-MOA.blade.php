@component('mail::message')
# <center>Request: {{ $data->last_name }}, {{ $data->first_name }} {{ $data->middle_name }} {{ $data->suffix }}.</center>
# <center>MOA needs approval.</center>

@component('mail::button', ['url' => '/'] )
    Go to website
@endcomponent

@endcomponent