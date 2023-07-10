
@foreach($mailsettings as $key => $val)
@if($key == 'user_header')
{{$val}}
@endif
@endforeach

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

@foreach($params as $key => $val)
@if($key == 'emailtoUser' || $key == 'nameofUser')
@continue
@endif
{{$val}}
@endforeach

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

@foreach($mailsettings as $key => $val)
@if($key == 'user_footer')
{{$val}}
@endif
@endforeach
