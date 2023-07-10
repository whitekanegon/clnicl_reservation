<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '予約時間帯　編集')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>予約時間帯　編集</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item"><a href="{{ asset('admin/reserve_time') }}">予約時間帯　一覧・編集</a></li>
  <li class="breadcrumb-item active">編集</li>
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
 <!-- form start -->
 <form action="edit" method="post" id="form_reserveTime_add">
  <div class="card-body">
    {{ csrf_field() }}
   <label>予約時間帯</label>
   <div class="add_reserveTimes addedline">
   <div class="form-group">
   <input type="text" name="name[]" class="form-control inline">
    <button type="button" class="btn btn-default btn-delline">行を削除</button>
    </div>
    </div>
   <div class="line-addbtn"><span></span><button type="button" class="btn btn-primary btn-addline">行を追加</button></div>
  </div>
  <!-- /.card-body -->
 </form>
</div>
<!-- /.box -->
<div class="box-fixed-btn">
				<ul>
					<li><button class="btn btn-warning btn-lg btn-save" data-form="form_reserveTime_add">作成</button></li>
				</ul>
			</div>

@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')

@stop

<!-- 読み込ませるJSを入力 -->
@section('js')

@stop
