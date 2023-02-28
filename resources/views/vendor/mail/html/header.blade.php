<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'UNOCRM')
<img src="https://unocrm.mx/wp-content/uploads/2021/11/unocrm_logo-1.png" alt="unocrm" style="height: 24px;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
 