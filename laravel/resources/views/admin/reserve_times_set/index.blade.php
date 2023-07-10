<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '予約時間帯　セット一覧')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>予約時間帯　セット一覧</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item active">予約時間帯　セット一覧</li>
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
 <form action="reserve_times_set" method="post" id="form_reserve_times_set">
<div class="card box-primary">
  {{ csrf_field() }}
  <div class="card-header">
   <div class="patchbox">
    <select name="patch" class="form-control inline">
     <option value="">一括操作</option>
     <option value="del">削除</option>
    </select>
    <input type="hidden" name="_method" value="PATCH" disabled>
    <button type="submit" class="btn btn-primary" disabled>適用</button>
    <a href="#" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#modal-default">確認</a> </div>

  </div>
  <div class="card-body"><p class="text-notice">※ドラッグ＆ドロップで順番を入れ替えることができます。</p></div>
  </div>
  <!-- /.card-header -->
	<div class="reserve_times_set_box">
  @foreach($items as $item)
  <div class="card">
  <div class="card-header with-border">
   <div class="checkbox">
    <label class="card-title">
     @if($item->id > 1)
   <input type="checkbox" name="check_id[]" value="{{$item->id}}">
     @endif
     <span>「{{$item->name}}」</span>
					<input type="hidden" name="id[]" class="id" value="{{$item->id}}">
					<input type="hidden" name="order[]" class="order" value="{{$item->order}}">
     </label>
    </div>
   <a href="reserve_times_set/edit?id={{$item->id}}" class="btn btn-default card-tools">編集</a>
   </div>
  <div class="card-body">
<ul class="list_reserveTimesSet noform">
    @foreach(unserialize($item->times) as $time)
	@if($relationtimes->where('id',$time)->first() != null)
				<li>{{$relationtimes->where('id',$time)->first()->name}}</li>
	@endif
@endforeach
			</ul>
  </div>
  </div>
  @endforeach
		</div>
  <!-- /.card-body -->
 </form>
<!-- /.box -->
<div class="modal fade" id="modal-default">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">チェックした項目を削除してよろしいですか？<br>
     この作業は元にもどせません。</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
   </div>
   <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-danger pull-left btn-del" data-form="form_reserve_times_set">削除する</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
   </div>
  </div>
  <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="box-fixed-btn">
 <ul>
  <li>
   <button class="btn btn-warning btn-lg btn-save" data-form="form_reserve_times_set">保存</button>
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
