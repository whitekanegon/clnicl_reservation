<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', '診療カレンダー')

<!-- ページの見出しを入力 -->
@section('content_header')
<h1>診療カレンダー</h1>
<div class="changeClinicalItem">
<select name="changeClinicalItem" class="form-control inline changeClinicalItem" data-selected="{{$clinical_item->id}}">
	@foreach($clinical_items_select as $clinical_item_select)
	@if($clinical_item_select->status > 0)
	<option value="{{$clinical_item_select->id}}">{{$clinical_item_select->name}}</option>
	@endif
	@endforeach
	</select>
</div>
@stop

<!-- ページの内容を入力 -->
@section('content')


<?php
$regular_weeks_count = count($regular_weeks);
?>
@if($regular_weeks_count == 0)
<p>予約時間帯が設定されていません。</p>
<p><a href="clinical_item/add_week?id={{$clinical_item->id}}">こちらから設定してください。</a></p>
@else
<section class="set_clinical_item">
	<h2 class="title">診療項目設定はこちら</h2>
<ul class="anchors link">
	<li><a href="clinical_item/edit_holiday?id={{$clinical_item->id}}">定休日（月）</a></li>
	<li><a href="clinical_item/edit_week?id={{$clinical_item->id}}">定休日（週）、予約時間帯</a></li>
	<li><a href="clinical_item/edit_week?id={{$clinical_item->id}}#timing">予約タイミング</a></li>
	<li><a href="clinical_item/edit_week?id={{$clinical_item->id}}#range">カレンダー表示範囲</a></li>
</ul>
</section>
<div id='calendar'></div>
@endif
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
   <div class="modal-header">
     <h3 class="modal-title"><span></span>の予約状態</h3>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">×</span></button>
    <input type="hidden" name="date" class="date" value="">
    <input type="hidden" name="clinical_item_id" class="clinical_item_id" value="{{$clinical_item->id}}">
    <input type="hidden" name="reserve_calendar_id" class="reserve_calendar_id" value="">
   </div>
			<div class="modal-body"> {{ csrf_field() }}
    <div class="card box-primary">
				<div class="card-header with-border">
					<h4 class="card-title">予約ステータス</h4>
				</div>
     <div class="card-body">
				<ul class="list_reserveTimesSet">
					@foreach($reserve_statuses as $reserve_status)
					<li>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" name="reserve_status_id" class="reserve_status form-check-input" value="{{$reserve_status->id}}" data-allow="{{$reserve_status->allow}}">
								<span>{{$reserve_status->reserveIcons->icon}}（{{$reserve_status->name}}）</span> </label>
						</div>
					</li>
					@endforeach
				</ul>
      </div>
     </div>
    <div class="card box-primary">
				<div class="card-header with-border">
					<h4 class="card-title">予約時間帯</h4>
				</div>
     <div class="card-body">
				<div>
					<select name="reserve_times_set_id" class="form-control inline reserve_times_set" data-selected="">

      @foreach($reserve_times_sets as $reserve_times_set)

						<option value="{{$reserve_times_set->id}}">{{$reserve_times_set->name}}</option>

      @endforeach

						<option value="0">予約不可</option>
					</select>
				</div>
				<div class="reserve_times_preview_box"> @foreach($reserve_times_sets as $reserve_times_set)
					<div class="reserve_times_preview">
						<ul class="list_reserveTimesSet noform">
							@foreach(unserialize($reserve_times_set->times) as $time)
							@if($reserve_times->where('id',$time)->first() != null)
							<li>{{$reserve_times->where('id',$time)->first()->name}}</li>
							@endif
							@endforeach
						</ul>
					</div>
					@endforeach </div>
      </div>
     </div>
    <div class="card box-primary" style="display:none;">
				<div class="card-header with-border">
					<h4 class="card-title">予約可能タイミング</h4>
				</div>
				<div class="form-group card-body">
					<select name="reserve_timing" class="form-control inline reserve_timing">
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
     </div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
				<input type="button" class="btn btn-primary" id="reserve_save" value="更新する">
			</div>
		</div>
	</div>
</div>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/fullcalendar/css/fullcalendar.min.css')}} ">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
<script src="{{ asset('vendor/moment/moment.js')}}"></script>
<script src="{{ asset('vendor/moment/locale/ja.js')}}"></script>
<script src="{{ asset('vendor/fullcalendar/js/fullcalendar.min.js')}}"></script>
<script src="{{ asset('vendor/fullcalendar/js/locale/ja.js')}}"></script>
<script src="{{ asset('vendor/fullcalendar/js/gcal.min.js')}}"></script>
<script>
$(document).ready(function () {
 var date_now = new Date();
 var date_start = new Date(date_now.getFullYear(), date_now.getMonth(), 1);
 //var date_end = new Date(date_now.getFullYear(), date_now.getMonth(), 1);
 //date_end.setMonth(date_end.getMonth() + 13);
 var calendar = $('#calendar').fullCalendar({
  validRange: {
   start: date_start,
   //end: date_end
  },
  height: 600,
	 eventSources : [
    {
      googleCalendarApiKey: '',
      googleCalendarId: 'japanese__ja@holiday.calendar.google.com',
      rendering: 'background',
      color:"#FEEAE9",
			id:'google_holiday',
			success:function(e) {
				reserveEventRender();
			}
    }
  ],
  viewRender: function (view, element) {
   $('.content').prepend('<div class="loading"><i class="fas fa-sync-alt fa-spin fa-5x fa-fw"></i></div>');
  },
  eventClick: function (event, jsEvent, view) {
   $('#editModal .modal-title span').text(moment(event.id).format("YYYY年MM月DD日")+'-weekid:'+event.week_id);
   $('#editModal input.date').val(event.id);
   $('#editModal input.reserve_calendar_id').val(event.reserve_calendar_id);
   $('#editModal input.reserve_status').val([event.reserve_status_id]);
   $('#editModal select.reserve_times_set').val(event.reserve_times_set_id);
   $('#editModal select.reserve_timing').val(event.reserve_timing);
   var index = $('#editModal select.reserve_times_set').prop('selectedIndex');
   $('#editModal select.reserve_times_set').parent().next().children().hide().eq(index).show();
   $('#editModal').modal();
   //$('#calendar').fullCalendar('updateEvent', event);
  },
 });

 function reserveEventRender() {
  var viewNowDate = $('#calendar').fullCalendar('getDate');
  var list_start = moment(viewNowDate).startOf('month').format('YYYY-MM-DD');
  var list_end = moment(viewNowDate).endOf('month').format('YYYY-MM-DD');
  var list_month_date = list_all_date(list_start, list_end);
  $.ajaxSetup({
   headers: {
    'X-CSRF-TOKEN': $('#editModal').find('input[name="_token"]').val()
   }
  });
  $.ajax({
   url: "reserve_calendar/getCalendarData",
   type: "post",
   cache: false,
   data: {
    id: <?php echo $clinical_item->id ?>,
   },
   dataType: 'json',
   success: function (dataResult) {
	 var googleHolidayEvents = $('#calendar').fullCalendar('clientEvents');
	 console.log('reserveEventRender:');
	 console.log(googleHolidayEvents);
   var regular_holidays = dataResult.regular_holidays;
   var regular_weeks = dataResult.regular_weeks;
    var reserve_timing = dataResult.reserve_timing;
    var reserve_calendars = dataResult.reserve_calendars;
    var reserve_times = dataResult.reserve_times;
    var reserve_times_sets = dataResult.reserve_times_sets;
    var reserve_icons = dataResult.reserve_icons;
    var reserve_statuses = dataResult.reserve_statuses;
	   var reserve_status_id;
	   var reserve_times_set_id;
    var dayCount = list_month_date.length;
	   //console.log('start');
	   //console.log('dayCount:'+dayCount);

  $.each(list_month_date, function (index, value) {
	  var reserve_calendar_id = 0;
   var week_id = moment(value).day();
			$.each(googleHolidayEvents,function(index, event){
				var holiday = event.start._i;
				if(holiday == value){
					week_id = 7;
					return false;
				}
			})
	 $.each(reserve_calendars,function(rcIndex, rcValue){
		 if(rcValue.date == value){
			 reserve_calendar_id = rcValue.id;
			 reserve_status_id = rcValue.reserve_status_id;
			 reserve_times_set_id = rcValue.reserve_times_set_id;
			 reserve_timing = rcValue.reserve_timing;
			 return false;
		 }
	 });
	  if(!reserve_calendar_id){

		  var regular_week_current = regular_weeks.filter(function(object){
			  return object.week_id == week_id
		  })
		  reserve_times_set_id = regular_week_current[0]['reserve_times_set_id'];
		  reserve_status_id = regular_week_current[0]['reserve_status_id'];

	  }

	 var reserve_times_set_current = '';
	  $.each(reserve_times_sets,function(key, val){
		  if(val.id == reserve_times_set_id){
			  reserve_times_set_current = val.name;
			  return false;
		  }
	  });
     var reserve_status_current = reserve_statuses.filter(function(object){
      return object.id == reserve_status_id
     })
     var reserve_icon_id = reserve_status_current[0]['reserve_icon_id'];
     var reserve_icon_current = reserve_icons.filter(function(object){
      return object.id == reserve_icon_id
     })
					var reserve_icon = reserve_icon_current[0].icon;
					if(!reserve_calendar_id){
			$.each(regular_holidays,function(rhIndex, rhValue){
				if(rhValue.day == moment(value).date()){
					//console.log('hit');
					reserve_status_id = 0;
					reserve_times_set_id = 0;
					reserve_times_set_current = '';
					reserve_icon = '休';
				}
			})
					}
  $('#calendar').fullCalendar('renderEvent', {
    id: value,
		week_id: week_id,
    title: reserve_icon+"\n"+reserve_times_set_current,
    reserve_status_id: reserve_status_id,
    reserve_times_set_id: reserve_times_set_id,
    reserve_timing: reserve_timing,
	reserve_calendar_id: reserve_calendar_id,
    start: value,
    allDay: true
   });
   //console.log('index:'+index);
   if(index == dayCount - 1){
    $('.content .loading').remove();
   }
  })
   },
   error: function (dataResult) {
    //console.log('Error:', dataResult);
   }
  });
 }

 function list_all_date(params_start, params_end) {
  var start = moment(params_start);
  var end = moment(params_end);
  var list = [];
  while (start.diff(end) <= 0) {
   list.push(start.format('YYYY-MM-DD'));
   start.add(1, 'days');
  }
  return list;
 }

 $("#reserve_save").click(function (e) {
  ////console.log($('#editModal').find('input[name="_token"]').val());
  $.ajaxSetup({
   headers: {
    'X-CSRF-TOKEN': $('#editModal').find('input[name="_token"]').val()
   }
  });
  e.preventDefault();
  var formData = {
   date: $('#editModal input.date').val(),
   clinical_item_id: $('#editModal input.clinical_item_id').val(),
   reserve_times_set_id: $('#editModal select.reserve_times_set').val(),
   reserve_status_id: $('#editModal input.reserve_status:checked').val(),
   reserve_timing: $('#editModal select.reserve_timing').val(),
   reserve_calendar_id: $('#editModal input.reserve_calendar_id').val(),
  };
	 var url;
	 if($('#editModal input.reserve_calendar_id').val() > 0){
		 url = "reserve_calendar/update";
	 }else{
		 url = "reserve_calendar/add";
	 }
		//console.log($('#editModal input.reserve_calendar_id').val());
		//console.log(url);
  $.ajax({
   type: 'post',
   url: url,
   data: formData,
   dataType: 'json',
   success: function (result) {
		 if(url == 'reserve_calendar/add'){
			formData.reserve_calendar_id = result.addedID;
		 }

				updateClientEvent(formData);
				$('#editModal').modal('hide')
				toastr.success(moment(formData.date).format("YYYY年MM月DD日")+'の予約を更新しました。','',{
			"closeButton" : true,
			"positionClass": "toast-top-right",
		})
   },
   error: function (data) {
    //console.log('Error:', data);
   }
  });



 });

	function updateClientEvent(eventData) {
		$.ajax({
			url: "reserve_calendar/getConstantData",
			type: "post",
			cache: false,
			dataType: 'json',
			success: function (dataResult) {
				var reserve_times = dataResult.reserve_times;
				var reserve_times_sets = dataResult.reserve_times_sets;
				var reserve_icons = dataResult.reserve_icons;
				var reserve_statuses = dataResult.reserve_statuses;
				var eventID = eventData.date;
				var clientEvents = $('#calendar').fullCalendar('clientEvents');
				$.each(clientEvents, function (index, event) {
					if (event.start._i == eventID) {
						//console.log('match!:' + eventID);
						//console.log(event);
						var reserve_times_set_current = '';
						$.each(reserve_times_sets,function(key, val){
							if(val.id == eventData.reserve_times_set_id){
								reserve_times_set_current = val.name;
								return false;
							}
						});
     var reserve_status_current = reserve_statuses.filter(function(object){
      return object.id == eventData.reserve_status_id;
     })
     var reserve_icon_id = reserve_status_current[0]['reserve_icon_id'];
     var reserve_icon_current = reserve_icons.filter(function(object){
      return object.id == reserve_icon_id
     })
						event.title = reserve_icon_current[0].icon+"\n"+reserve_times_set_current;
						event.reserve_status_id = eventData.reserve_status_id;
						event.reserve_times_set_id = eventData.reserve_times_set_id;
						event.reserve_timing = eventData.reserve_timing;
						event.reserve_calendar_id = eventData.reserve_calendar_id;
						event.reserve_status_id = eventData.reserve_status_id;
						$('#calendar').fullCalendar('updateEvent', event);
					}
				})
			},
			error: function (dataResult) {
				//console.log('Error:', dataResult);
			}
		});
	}

	var clinicalID = getParam('id');
	$('select.changeClinicalItem').on('change',function(){
		var id = $(this).val();
		location.href = '?id='+id;
	})


	function getParam(name, url) {
 if (!url) url = window.location.href;
 name = name.replace(/[\[\]]/g, "\\$&");
 var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
  results = regex.exec(url);
 if (!results) return null;
 if (!results[2]) return '';
 return decodeURIComponent(results[2].replace(/\+/g, " "));
}
})

</script>
@stop
