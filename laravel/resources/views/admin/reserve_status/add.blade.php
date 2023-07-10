<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '予約ステータス　新規作成')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>予約ステータス　新規作成</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item"><a href="{{ asset('admin/reserve_status') }}">予約ステータス　一覧・編集</a></li>
  <li class="breadcrumb-item active">新規作成</li>
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
<form action="add" method="post" id="form_reserveStatus_add">
  {{ csrf_field() }}
	<div class="card box-primary">
		<div class="card-header">
			<h3 class="card-title">予約ステータス名</h3>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
				<input type="text" name="name" class="form-control half validItems" value="{{old('name')}}">
			</div>
			<div id="errorBox"></div>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card box-primary">
		<div class="card-header">
			<h3 class="card-title">予約の可否</h3>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
     <select name="allow" data-selected="1" class="form-control inline">
      <option value="1">可</option>
      <option value="0">不可</option>
     </select>
   </div>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card box-primary">
		<div class="card-header">
			<h3 class="card-title">表示アイコン</h3>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
      <select name="reserve_icon_id" data-selected="1" class="form-control inline">
       @foreach($icons as $icon)
       <option value="{{$icon->id}}">{{$icon->icon}}</option>
       @endforeach
       </select>
   </div>
		</div>
		<!-- /.card-body -->
	</div>
 <input type="hidden" name="status" value="1">
</form>
<!-- /.box -->
<div class="box-fixed-btn">
	<ul>
		<li>
			<button class="btn btn-warning btn-lg btn-save" data-form="form_reserveStatus_add">作成</button>
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
