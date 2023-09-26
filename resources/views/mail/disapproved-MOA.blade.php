@component('mail::message')
# <center>Your MOA has been denied by {{ $data->last_name }}, {{ $data->first_name }} {{ $data->middle_name }} {{ $data->suffix }}.</center>
# <center>{{ $remark }}</center>

@component('mail::button', ['url' => '/'] )
    Go to website
@endcomponent

@endcomponent