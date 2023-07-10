<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'メール設定')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>メール設定</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item active">メール設定</li>
</ol>
@stop
<!-- ページの内容を入力 -->
@section('content')
		@if(count($errors) > 0)
 <div class="card box-danger">
		<div class="card-body">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
  </div>
		@endif
		<ul class="anchors">
	<li><a href="#admin"><i class="fas fa-caret-down"></i>管理者宛設定</a></li>
	<li><a href="#user"><i class="fas fa-caret-down"></i>受診者宛設定</a></li>
	<li><a href="#privacy"><i class="fas fa-caret-down"></i>プライバシーポリシー</a></li>
	<li><a href="#thanks"><i class="fas fa-caret-down"></i>送信後画面文言</a></li>
</ul>
<form action="mail_setting" method="post" id="form_reserveStatus_add">
  {{ csrf_field() }}
	<div class="card box-primary" id="admin">
		<div class="card-header">
			<h3 class="card-title">管理者宛設定</h3>
			<div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
    <label>管理者宛メールアドレス</label>
    <input type="text" name="admin_email" class="form-control half validItems" value="{{$mail_item['admin_email']}}" placeholder="(例：yoyaku@clinicl.com)">
  </div>
			<div class="form-group">
    <label>管理者宛に送信されるメールの件名</label>
    <input type="text" name="admin_subject" class="form-control half required" value="{{$mail_item['admin_subject']}}" placeholder="(例：久利二来クリニック　仮予約)">
  </div>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card box-primary" id="user">
		<div class="card-header">
			<h3 class="card-title">受診者宛設定</h3>
			<div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
    <label>受診者宛に送信されるメールの件名</label>
    <input type="text" name="user_subject" class="form-control half required" value="{{$mail_item['user_subject']}}">
   </div>
	 <!--
	<div class="form-group">
    <label>受診者宛の送信者欄に表示される名前</label>
    <input type="text" name="user_title" class="form-control half" value="{{$mail_item['user_title']}}" placeholder="(例：久利二来クリニック)">
  </div>
	-->
			<div class="form-group">
    <label>受診者宛に送信されるメールの冒頭文（ヘッダー）</label>
    <textarea name="user_header" class="form-control qat3 required" rows="6">{{$mail_item['user_header']}}</textarea>
  </div>
			<div class="form-group">
    <label>受診者宛に送信されるメールの署名（フッター）</label>
    <textarea name="user_footer" class="form-control qat3 required" rows="10">{{$mail_item['user_footer']}}</textarea>
  </div>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card box-primary" id="privacy">
		<div class="card-header">
			<h3 class="card-title">プライバシーポリシー</h3>
			<div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
			<label>送信前に同意いただく、個人情報の取扱いについての文章</label>
    <textarea name="privacy_policy" class="form-control qat3 required" rows="10">{{$mail_item['privacy_policy']}}</textarea>
  </div>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card box-primary" id="thanks">
		<div class="card-header">
			<h3 class="card-title">送信後画面文言</h3>
			<div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
			<label>文章</label>
    <textarea name="thanks_text" class="form-control qat3 required" rows="10">{{$mail_item['thanks_text']}}</textarea>
  		</div>
			<div class="form-group">
			<label>注意事項（特に強調したい文章等）</label>
    <textarea name="thanks_notice" class="form-control qat3" rows="10">{{$mail_item['thanks_notice']}}</textarea>
  		</div>
		</div>
		<!-- /.card-body -->
	</div>
</form>
<!-- /.box -->
<div class="box-fixed-btn">
	<ul>
		<li>
			<button class="btn btn-warning btn-lg btn-save" data-form="form_reserveStatus_add">保存</button>
		</li>
	</ul>
</div>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

@stop
