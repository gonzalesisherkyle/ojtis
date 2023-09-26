@component('mail::message')
# <center>Request: {{ $data->last_name }}, {{ $data->first_name }} {{ $data->middle_name }} {{ $data->suffix }}.</center>
# <center>Recommendation Letter needs approval.</center>

@component('mail::button', ['url' => '/'] )
    Go to website
@endcomponent

@endcomponent