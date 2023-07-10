<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>ご予約フォーム</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/v4-shims.css">
	<link rel="stylesheet" href="{{ asset('/css/app.css?20221015') }}">
</head>
<body>
	<div id="ktyHeader">
		<div class="siteHeader">
			<div class="logo">
					<a href="/"><img src="/wp/wp-content/themes/shirakamidental/img/cmn/logo.svg" alt="白神歯科クリニック"></a>
			</div>
		</div>
	</div>
	<div id="app">
		<kty-container></kty-container>
	</div>
	<script src="{{asset('/js/app.js?20221015')}}"></script>
</body>
</html>
