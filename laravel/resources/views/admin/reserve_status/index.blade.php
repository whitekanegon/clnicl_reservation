<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '予約ステータス　一覧・編集')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>予約ステータス　一覧・編集</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item active">予約ステータス　一覧・編集</li>
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
  <form action="reserve_status" method="post" id="form_reserve_status">
   {{ csrf_field() }}
 <div class="card-header">
    @if(isset($regist))
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
  <option value="enabled">有効</option>
  <option value="disabled">無効</option>
  <option value="del">削除</option>
 </select>
    <input type="hidden" name="_method" value="PATCH" disabled>
    <button type="submit" class="btn btn-primary" disabled>適用</button>
    <a href="#" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#modal-default">確認</a>
    </div>
 </div>
  <!-- /.card-header -->
 <div class="card-body table-responsive">
  <p class="text-notice">※ドラッグ＆ドロップで順番を入れ替えることができます。</p>
   <table class="table table-striped table-bordered table-centerall">
    <colgroup>
    <col style="width:5%;">
    <col style="width:10%;">
    <col style="width:40%;">
    <col style="width:15%;">
    <col style="width:15%;">
    <col style="width:15%;">
    </colgroup>
    <thead>
     <tr>
      <th><input type="checkbox" class="all"></th>
      <th>表示順</th>
      <th>項目名</th>
      <th>予約</th>
      <th>アイコン</th>
      <th>状態</th>
     </tr>
    </thead>
    <tbody class="table-sortable">
    @foreach($items as $item)
    <tr>
     <td class="id check_line">
      @if($item->id > 2)
      <input type="checkbox" name="check_id[]" value="{{$item->id}}">
      @endif
      <input type="hidden" name="id[]" value="{{$item->id}}">
     </td>
     <td class="orders"><span>{{$item->order}}</span>
      <input type="hidden" name="order[]" value="{{$item->order}}">
      </td>
     <td><input type="text" name="name[]" value="{{$item->name}}" class="form-control validItems"></td>
     <td>
      @if($item->id > 2)
      <select name="allow[]" data-selected="{{$item->allow}}" class="form-control allow">
       <option value="1">可</option>
       <option value="0">不可</option>
       </select>
      @else
      @if($item->allow > 0)
      可
      @else
      不可
      @endif
      <input type="hidden" name="allow[]" value="{{$item->allow}}">
      @endif
     </td>
     <td>
      <select name="reserve_icon_id[]" data-selected="{{$item->reserveIcons->id}}" class="form-control">
       @foreach($icons as $icon)
       <option value="{{$icon->id}}">{{$icon->icon}}</option>
       @endforeach
       </select>
      </td>
     <td>
      @if($item->id > 2)
      <select name="status[]" data-selected="{{$item->status}}" class="form-control status">
       <option value="1">有効</option>
       <option value="0">無効</option>
       </select>
      @else
      @if($item->status > 0)
      有効
      @else
      無効
      @endif
      <input type="hidden" name="status[]" value="{{$item->status}}">
      @endif
     </td>
    </tr>
    @endforeach
   </tbody>
   </table>
   <div id="errorBox"></div>
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
							<button type="button" class="btn btn-danger pull-left btn-del" data-form="form_reserve_status">削除する</button>
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
					<li><button class="btn btn-warning btn-lg btn-save" data-form="form_reserve_status">保存</button></li>
				</ul>
			</div>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')

@stop

<!-- 読み込ませるJSを入力 -->
@section('js')

@stop
