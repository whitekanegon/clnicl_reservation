<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'ダッシュボード')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>ダッシュボード</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
			 @if($regular_weeks_zero_flag || $mail_item['admin_email'] == '' || count($times_sets) == 0)
<div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
								設定アラート
                </h3>
								<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
							<ul class="alert-list">
								@if($mail_item['admin_email'] == '')
								<li class="alert alert-warning alert-dismissible"><a href="admin/mail_setting"><i class="icon fas fa-exclamation-triangle"></i>管理者宛メールアドレスを設定してください。</a></li>
								@endif
								@if(count($times_sets) == 0)
								<li class="alert alert-warning alert-dismissible"><a href="admin/reserve_times_set/add"><i class="icon fas fa-exclamation-triangle"></i>予約時間帯セットを１つ以上作成してください。</a></li>
								@endif
								@if($regular_weeks_zero_flag)
								@foreach($regular_weeks as $key => $regular_week)
								@if(count($regular_week) == 0 && $clinical_items[$key]->status > 0)
								<li class="alert alert-warning alert-dismissible"><a href="admin/clinical_item/add_week?id={{$clinical_items[$key]->id}}"><i class="icon fas fa-exclamation-triangle"></i>「{{$clinical_items[$key]->name}}」の予約時間帯を設定してください。</a></li>
								@endif
								@endforeach
								@endif
							</ul>
              </div>
              <!-- /.card-body -->
						</div>
						@endif
<div class="card box-primary box-solid db-shortcut no-border">
	<div class="card-header">
		<h2 class="card-title">メニュー</h2>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-4">
				<div class="card box-primary">
					<div class="card-header">
						<h3 class="card-title">診療カレンダー</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body no-padding">
						<ul>
			 @foreach($clinical_items as $clinical_item)
			 @if($clinical_item->status > 0)
			 <li><a href="admin/reserve_calendar?id={{$clinical_item->id}}">{{$clinical_item->name}}</a></li>
			 @endif
       @endforeach
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card box-primary">
					<div class="card-header">
						<h3 class="card-title">診療項目</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body no-padding">
						<ul>
							<li><a href="admin/clinical_item">一覧・編集</a></li>
							<li><a href="admin/clinical_item/add">新規作成</a></li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card box-primary">
					<div class="card-header">
						<h3 class="card-title">予約ステータス</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body no-padding">
						<ul>
							<li><a href="admin/reserve_status">一覧・編集</a></li>
							<li><a href="admin/reserve_status/add">新規作成</a></li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="card box-primary">
					<div class="card-header">
						<h3 class="card-title">予約時間帯</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body no-padding">
						<ul>
							<li><a href="admin/reserve_time">一覧・編集</a></li>
							<li><a href="admin/reserve_time/add">新規作成</a></li>
							<li><a href="admin/reserve_times_set">セット一覧</a></li>
							<li><a href="admin/reserve_times_set/add">セット新規作成</a></li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card box-primary">
					<div class="card-header">
						<h3 class="card-title">受診者入力項目</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body no-padding">
						<ul>
							<li><a href="admin/input_item">一覧・編集</a></li>
							<li><a href="admin/input_item/add">新規作成</a></li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card box-primary">
					<div class="card-header">
						<h3 class="card-title">管理者メール</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body no-padding">
						<ul>
							<li><a href="admin/mail_setting">一覧・編集</a></li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
		</div>
	</div>
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
