<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '受診者入力項目　新規作成')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>受診者入力項目　新規作成</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item"><a href="{{ asset('admin/input_item') }}">受診者入力項目　一覧・編集</a></li>
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
<form action="add" method="post" id="form_inputItem_add">
  {{ csrf_field() }}
	<div class="card box-primary">
		<div class="card-header">
			<h3 class="card-title">項目名</h3>
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
			<h3 class="card-title">タイプ</h3>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
     <select name="input_type_id" data-selected="1" class="form-control inline input_type">
      @foreach($input_types as $input_type)
      @if($input_type->id < 6)
      <option value="{{$input_type->input_type_id}}">{{$input_type->name}}</option>
      @endif
      @endforeach
     </select>
   </div>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card box-primary input_selections">
		<div class="card-header">
			<h3 class="card-title">選択項目</h3>
		</div>
		<!-- form start -->
		<div class="card-body">
   <p>セレクトボックス、ラジオボタン、チェックボックスは、選択項目を設定してください。<br>
「行を追加」で項目を追加できます。</p>
   <div class="addedline">
   <div class="form-group">
   <input type="text" name="input_selections[]" class="form-control inline validSelections">
    <button type="button" class="btn btn-default btn-delline">行を削除</button>
    </div>
    </div>
   <div class="line-addbtn"><span></span><button type="button" class="btn btn-primary btn-addline">行を追加</button></div>
	 <div id="errorBox_selections"></div>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card box-primary input_required">
		<div class="card-header">
			<h3 class="card-title">必須の有無</h3>
		</div>
		<!-- form start -->
		<div class="card-body">
			<div class="form-group">
      <div class="form-check">
        <label class="form-check-label"><input type="checkbox" name="required" class="form-check-input" value="1">必須</label>
      </div>
   </div>
		</div>
		<!-- /.card-body -->
	</div>
		<div class="card box-primary">
		<div class="card-header">
			<h3 class="card-title">入力例等の説明</h3>
		</div>
		<!-- form start -->
		<div class="card-body">
   <p>入力例等が必要な場合は設定してください。</p>
			<div class="form-group">
				<input type="text" name="explain" class="form-control half" value="{{old('explain')}}">
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
			<button class="btn btn-warning btn-lg btn-save" data-form="form_inputItem_add">作成</button>
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
