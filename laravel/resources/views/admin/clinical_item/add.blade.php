<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '診療項目　新規作成')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>診療項目　新規作成</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item"><a href="{{ asset('admin/clinical_item') }}">診療項目　一覧・編集</a></li>
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
<div class="card box-primary">
		<div class="card-header">
			<h3 class="card-title">診療項目名</h3>
		</div>
 <!-- form start -->
 <form action="add" method="post" id="form_clinicalItem_add">
  <div class="card-body">

    {{ csrf_field() }}
   <div class="form-group">
    <input type="text" name="name" class="form-control half validItems" value="{{old('name')}}">
   </div>
<input type="hidden" name="status" value="1">
   <input type="hidden" name="reserve_timing" value="2">
   <input type="hidden" name="reserve_include_holiday" value="0">
   <input type="hidden" name="calendar_length" value="3">
	 <div id="errorBox"></div>
  </div>
  <!-- /.card-body -->
 </form>

</div>
<!-- /.box -->
<div class="box-fixed-btn">
	<ul>
		<li>
			<button class="btn btn-warning btn-lg btn-save" data-form="form_clinicalItem_add">作成</button>
		</li>
	</ul>
</div>

@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')

@stop

<!-- 読み込ませるJSを入力 -->
@section('js')

@stop
