<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '定休日（月）編集')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1><span>【{{$clinical_item->name}}】</span>定休日（月）編集</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item"><a href="{{ asset('admin/clinical_item') }}">診療項目　一覧・編集</a></li>
  <li class="breadcrumb-item">定休日（月）編集</li>
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
 <form action="edit_holiday" method="post" id="form_holiday">
    {{ csrf_field() }}
		<div class="card-header">
			<h3 class="card-title">診療の定休日（月）編集</h3>
   <input type="hidden" name="clinical_item_id" value="{{$clinical_item->id}}">
		</div>
  <div class="card-body">
   <div class="add_reserveTimes addedline">
    @foreach($regular_holidays as $regular_holiday)
   <div class="form-group">
    <div class="form-control inline text">毎月</div>
    <input type="hidden" name="regular_holiday_id[]" value="{{$regular_holiday->id}}">
    <select name="day[]" data-selected="{{$regular_holiday->day}}" class="form-control inline day">
     <option value="0">なし</option>
    @for($i=1; $i<=31; $i++)
    <option value="{{$i}}">{{$i}}日</option>
    @endfor
     </select>
    <div class="checkbox inline">
                      <label class="text-red">
                        <input type="checkbox" name="del[]" class="del_check" value="{{$regular_holiday->id}}"> 削除
                      </label>
                    </div>
    </div>
    @endforeach
   <div class="form-group dummy_clone">
    <div class="form-control inline text">毎月</div>
    <select name="day[]" data-selected="0" class="form-control inline day">
    @for($i=1; $i<=31; $i++)
    <option value="{{$i}}">{{$i}}日</option>
    @endfor
     </select>
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
					<li><button class="btn btn-warning btn-lg btn-save" data-form="form_holiday">保存</button></li>
				</ul>
			</div>

@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')

@stop

<!-- 読み込ませるJSを入力 -->
@section('js')

@stop
