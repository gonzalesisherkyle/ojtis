<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('assets/images/pup-logo.png') }}" height="96"><br>
<img src="{{ asset('assets/images/ojtis-logo.png') }}" height="128">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
