<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '予約時間帯　一覧・編集')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>予約時間帯　一覧・編集</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item active">予約時間帯　一覧・編集</li>
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
 <form action="reserve_time" method="post" id="form_reserve_time">
  {{ csrf_field() }}
  <div class="card-header"> @if(isset($regist))
   <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p><i class="icon fa fa-info"></i> 更新しました。</p>
   </div>
   @endif
   @if(isset($patchStr))
   <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p><i class="icon fa fa-info"></i> {{$patchStr}}</p>
   </div>
   @endif
   <div class="patchbox">
    <select name="patch" class="form-control inline">
     <option value="">一括操作</option>
     <option value="del">削除</option>
    </select>
    <input type="hidden" name="_method" value="PATCH" disabled>
    <button type="submit" class="btn btn-primary" disabled>適用</button>
    <a href="#" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#modal-default">確認</a> </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
   <p class="text-notice">※ドラッグ＆ドロップで順番を入れ替えることができます。</p>
   <table class="table table-striped table-bordered table-centerall">
    <colgroup>
    <col style="width:4%;">
    <col style="width:95%;">
    </colgroup>
    <thead>
     <tr>
      <td><input type="checkbox" class="all_li"></td>
      <td>項目名</td>
     </tr>
     </thead>
    </table>
    <div id="errorBox"></div>
   <ul class="list_reserveTimes row form-horizontal">
    @foreach($items as $item)
    <li>
     <div class="checkbox col-sm-1">
      <label class="control-label check_line">
       <input type="hidden" name="id[]" value="{{$item->id}}">
       @unless($item->id === 1)
       <input type="checkbox" name="check_id[]" value="{{$item->id}}">
       @endunless
       </label>
      <input type="hidden" name="order[]" value="{{$item->order}}" class="order">
     </div>
     <div class="col-sm-11">
      <input type="text" name="name[]" class="form-control validItems" value="{{$item->name}}">
     </div>
    </li>
    @endforeach
   </ul>

  </div>
  <!-- /.card-body -->
 </form>
</div>
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
    <button type="button" class="btn btn-danger pull-left btn-del" data-form="form_reserve_time">削除する</button>
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
   <button class="btn btn-warning btn-lg btn-save" data-form="form_reserve_time">保存</button>
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
