
仮予約のメールが届きました。
入力された内容は、以下の通りです。

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

@foreach($params as $key => $val)
@if($key == 'emailtoUser' || $key == 'nameofUser')
@continue
@endif
{{$val}}
@endforeach

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

送信日時：{{date("Y/m/d (D) H:i:s")}}

-------------------------------------------------

HTTP_USER_AGENT：{{$_SERVER['HTTP_USER_AGENT']}}
REMOTE_ADDR：{{$_SERVER['REMOTE_ADDR']}}
HTTP_HOST：{{$_SERVER['HTTP_HOST']}}
