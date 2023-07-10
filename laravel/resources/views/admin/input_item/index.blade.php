<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '受診者入力項目　一覧・編集')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>受診者入力項目　一覧・編集</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item active">受診者入力項目　一覧・編集</li>
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
  <form action="input_item" method="post" id="form_input_item">
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
    <col style="width:23%;">
    <col style="width:11%;">
    <col style="width:11%;">
    <col style="width:10%;">
    </colgroup>
    <thead>
     <tr>
      <th><input type="checkbox" class="all"></th>
      <th>表示順</th>
      <th>項目名</th>
      <th>タイプ</th>
      <th>必須</th>
      <th>状態</th>
      <th>編集</th>
     </tr>
    </thead>
    <tbody class="table-sortable">
    @foreach($items as $item)
    <tr>
     <td class="id check_line">
      @if($item->id > 4)
      <input type="checkbox" name="check_id[]" value="{{$item->id}}">
      @endif
      <input type="hidden" name="id[]" value="{{$item->id}}">
     </td>
     <td class="orders"><span>{{$item->order}}</span>
      <input type="hidden" name="order[]" value="{{$item->order}}">
      </td>
     <td class="txt-left">{{$item->name}}</td>
     <td>{{$item->input_types->name}}</td>
     <td>
     @if($item->id > 2)
     <select name="required[{{$loop->index}}]" data-selected="{{$item->required}}" class="form-control status hissu">
       <option value="0">任意</option>
       <option value="1">必須</option>
       </select>

     @else
     必須
     <input type="hidden" name="required[{{$loop->index}}]" value="1">
      @endif
     </td>
     <td>
      @if($item->id > 2)
      <select name="status[]" data-selected="{{$item->status}}" class="form-control status">
       <option value="1">有効</option>
       <option value="0">無効</option>
       </select>
      @else
      有効
      <input type="hidden" name="status[]" value="{{$item->status}}">
      @endif
     </td>
     <td>
     @if($item->name != '生年月日')
     <a href="input_item/edit?id={{$item->id}}" class="btn btn-default">編集</a>
     @endif
      </td>
    </tr>
    @endforeach
   </tbody>
   </table>
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
							<button type="button" class="btn btn-danger pull-left btn-del" data-form="form_input_item">削除する</button>
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
					<li><button class="btn btn-warning btn-lg btn-save" data-form="form_input_item">保存</button></li>
				</ul>
			</div>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')

@stop

<!-- 読み込ませるJSを入力 -->
@section('js')

@stop
