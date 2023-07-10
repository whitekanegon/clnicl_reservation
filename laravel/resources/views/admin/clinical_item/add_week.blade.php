<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '定休日（週）、予約時間帯設定')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1><span>【{{$clinical_item->name}}】</span> 定休日（週）、予約時間帯設定</h1>
@stop
@section('breadcrumb')
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{ asset('admin') }}">トップ</a></li>
  <li class="breadcrumb-item"><a href="{{ asset('admin/clinical_item') }}">診療項目　一覧・編集</a></li>
  <li class="breadcrumb-item">定休日（週）、予約時間帯設定</li>
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
<?php
$times_sets_count = count($times_sets);
?>
@if($times_sets_count == 0)
<p>予約時間帯セットが見つかりませんでした。</p>
<p><a href="../reserve_times_set/add">こちらから一つ以上作成してください。</a></p>
@else
<ul class="anchors">
	<li><a href="#times"><i class="fas fa-caret-down"></i> 定休日（週）、予約時間帯設定</a></li>
	<li><a href="#timing"><i class="fas fa-caret-down"></i> 予約タイミング</a></li>
	<li><a href="#range"><i class="fas fa-caret-down"></i> カレンダー表示範囲</a></li>
</ul>
<form action="add_week" method="post" id="form_week" class="add_week">
	<div class="card box-primary" id="times">
		<!-- form start -->
		{{ csrf_field() }}
		<div class="card-header">
			<h3 class="card-title">定休日（週）、予約時間帯設定</h3>
			<input type="hidden" name="clinical_item_id" value="{{$clinical_item->id}}">
			<div class="card-tools">
  	  <button type="button" class="btn btn-tool" data-card-widget="collapse">
  	    <i class="fas fa-minus"></i>
  	  </button>
  	</div>
		</div>
 <div class="card-body table-responsive">
   <table class="table table-striped table-bordered table-centerall">
    <colgroup>
    <col style="width:10%;">
    <col style="width:25%;">
    <col style="width:20%;">
    <col style="width:45%;">
    </colgroup>
    <thead>
     <tr>
      <th>曜日</th>
      <th>ステータス<br>アイコン</th>
      <th>予約時間帯<br>セット名</th>
      <th>予約時間帯<br>内容</th>
     </tr>
    </thead>
    <tbody>

   @foreach($weeks as $week)
			<tr>
				<td>{{$week->name}}</td>
    <td>
					<select name="reserve_status_id[]" class="form-control inline reserve_status" data-selected="1">

      @foreach($reserve_statuses as $reserve_status)

						<option value="{{$reserve_status->id}}" data-allow="{{$reserve_status->allow}}">{{$reserve_status->reserveIcons->icon}}（{{$reserve_status->name}}）</option>

      @endforeach

					</select>
     </td>
				<td>
					<input type="hidden" name="week_id[]" value="{{$week->week_id}}">
					<select name="reserve_times_set_id[]" class="form-control inline reserve_times_set" data-selected="1">

      @foreach($times_sets as $times_set)

						<option value="{{$times_set->id}}">{{$times_set->name}}</option>

      @endforeach

						<option value="0">予約不可</option>
					</select>
				</td>
				<td> @foreach($times_sets as $times_set)
					<div class="reserve_times_preview">
						<ul class="list_reserveTimesSet noform">
							@foreach(unserialize($times_set->times) as $time)
							@if($reseve_times->where('id',$time)->first() != null)
							<li>{{$reseve_times->where('id',$time)->first()->name}}</li>
							@endif
							@endforeach
						</ul>
					</div>
					@endforeach
					<div class="reserve_times_0"></div>
				</td>
			</tr>
			@endforeach
   </tbody>
   </table>
    </div>
		<!-- /.card-body -->
	</div>
	<!-- /.box -->
	<div class="card box-primary" id="timing">
		<div class="card-header">
			<h3 class="card-title">予約タイミング</h3>
		</div>
		<div class="card-body">
			<div class="form-group">
				<select name="reserve_timing" data-selected="2" class="form-control inline">
					<option value="0">当日</option>
					<option value="1">1日前</option>
					<option value="2">2日前</option>
					<option value="3">3日前</option>
					<option value="4">4日前</option>
					<option value="5">5日前</option>
					<option value="6">6日前</option>
					<option value="7">7日前</option>
				</select>
				までOK </div>
			<div class="form-group">日をさかのぼる際、休診日を
				<div class="radio inline">
					<label>
						<input type="radio" name="reserve_include_holiday" value="0" checked>
						<span>数えない</span></label>
					<label>
						<input type="radio" name="reserve_include_holiday" value="1">
						<span>数える</span></label>
				</div>
			</div>
		</div>
	</div>
	<div class="card box-primary" id="range">
		<div class="card-header">
			<h3 class="card-title">カレンダー表示範囲</h3>
		</div>
		<div class="card-body">
			<div class="form-group">
				<select name="calendar_length" data-selected="3" class="form-control inline">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				カ月表示 </div>
				<p>※表示範囲を大きくするほど、読込時間が長くなります。</p>
		</div>
	</div>
</form>
<div class="box-fixed-btn">
	<ul>
		<li>
			<button class="btn btn-warning btn-lg btn-save" data-form="form_week">設定</button>
		</li>
	</ul>
</div>
@endif
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

@stop
