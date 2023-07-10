<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '診療項目　一覧・編集')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>診療項目　一覧・編集</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item active">診療項目　一覧・編集</li>
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
  <form action="clinical_item" method="post" id="form_clinical_item">
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
    <col style="width:30%;">
    <col style="width:15%;">
    <col style="width:15%;">
    <col style="width:15%;">
    <col style="width:15%;">
    </colgroup>
    <thead>
     <tr>
      <th><input type="checkbox" class="all"></th>
      <th>表示順</th>
      <th>項目名</th>
      <th>状態</th>
      <th>定休日（月）<br>設定</th>
      <th>定休日（週）<br>予約時間帯<br>設定</th>
      <th>カレンダー</th>
     </tr>
    </thead>
    <tbody class="table-sortable">
    @foreach($items as $item)
    <tr>
     <td class="id check_line">
      @unless($item->id === 1)
      <input type="checkbox" name="check_id[]" value="{{$item->id}}">
      @endunless
      <input type="hidden" name="id[]" value="{{$item->id}}">
     </td>
     <td class="orders"><span>{{$item->order}}</span>
      <input type="hidden" name="order[]" value="{{$item->order}}">
      </td>
     <td><input type="text" name="name[]" value="{{$item->name}}" class="form-control validItems">

   </td>
     <td>
      @if($item->id == 1)
      有効
      <input type="hidden" name="status[]" value="{{$item->status}}">
      @else
      <select name="status[]" data-selected="{{$item->status}}" class="form-control status">
       <option value="1">有効</option>
       <option value="0">無効</option>
       </select>
      @endif
     </td>
     <td>
     @if($item->regular_holidays->count() > 0)
      <a href="clinical_item/edit_holiday?id={{$item->id}}" class="btn btn-default">編集</a>
     @else
      <a href="clinical_item/add_holiday?id={{$item->id}}" class="btn btn-danger">要設定</a>
      @endif
     </td>
     <td>
     @if($item->regular_weeks->count() > 0)
      <a href="clinical_item/edit_week?id={{$item->id}}" class="btn btn-default">編集</a>
     @else
      <a href="clinical_item/add_week?id={{$item->id}}" class="btn btn-danger">要設定</a>
      @endif
     </td>
     <td>
						@if($item->regular_weeks->count() > 0)
     <a href="reserve_calendar?id={{$item->id}}" class="btn btn-default">編集</a>
     @else
						予約時間帯<br>要設定
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
<!-- /.card -->
<div class="modal fade" id="modal-default">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">チェックした項目を削除してよろしいですか？<br>
この作業は元にもどせません。</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-danger pull-left btn-del" data-form="form_clinical_item">削除する</button>
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
					<li><button class="btn btn-warning btn-lg btn-save" data-form="form_clinical_item">保存</button></li>
				</ul>
			</div>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')

@stop

<!-- 読み込ませるJSを入力 -->
@section('js')

@stop
