<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '予約時間帯　セット新規作成')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>予約時間帯　セット新規作成</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item"><a href="{{ asset('admin/reserve_times_set') }}">予約時間帯　セット一覧</a></li>
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
<form action="add" method="post" id="form_reserve_times_set_add">
  {{ csrf_field() }}
	<div class="card box-primary">
		<div class="card-header">
			<h3 class="card-title">セット名</h3>
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
			<h3 class="card-title">セット内容</h3>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
				<ul class="list_reserveTimesSet">
					@foreach($times as $time)
					<li>
					<div class="form-check">
					<label class="form-check-label">
								<input type="checkbox" name="time_id[]" class="form-check-input" value="{{$time->id}}">
								<span>{{$time->name}}</span> </label>
						</div>
					</li>
					@endforeach
				</ul>
				<div id="errorBox_check"></div>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
</form>
<!-- /.box -->
<div class="box-fixed-btn">
	<ul>
		<li>
			<button class="btn btn-warning btn-lg btn-save" data-form="form_reserve_times_set_add">作成</button>
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
