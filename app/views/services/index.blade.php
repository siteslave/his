@extends('layouts.default')

@section('title')
<title>HIS : การให้บริการ</title>
@stop

@section('content')

<ol class="breadcrumb">
  <li><a href="/">หน้าหลัก</a></li>
  <li class="active">การให้บริการ</li>
</ol>

<div class="form-horizontal well-bar well-sm">
  <div class="row">
      <div class="col-sm-2">
          <div class="form-group">
              <label class="col-sm-3 control-label" for="txt_start_date">ตั้งแต่ </label>
              <div data-type="date-picker" class="input-group date col-sm-9">
                  <input type="text" placeholder="วว/ดด/ปปปป" class="form-control"
                         value="{{ Helpers::getCurrentDate() }}" id="txtStartDate">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
          </div>
      </div>
      <div class="col-sm-2">
          <div class="form-group">
              <label class="col-sm-2 control-label" for="txt_end_date"> ถึง </label>
              <div data-type="date-picker" class="input-group date col-sm-9">
                  <input type="text" placeholder="วว/ดด/ปปปป"
                         value="{{ Helpers::getCurrentDate() }}" class="form-control" id="txtEndDate">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
          </div>
      </div>
      <div class="col-sm-4">
        <select class="form-control" id="slClinic">
            <option value="0">ทุกคลินิค</option>
            @foreach($clinics as $c)
            <option value="{{ $c->id }}">[{{ $c->export_code }}] {{ $c->name }}</option>
            @endforeach
        </select>
      </div>
      <div class="col-sm-2">
          <div class="btn-group">
              <button class="btn btn-primary" id="btnVisitFilter"
                      rel="tooltip" title="search">
                  <i class="fa fa-search"></i> แสดง
              </button>
          </div>
      </div>
      <div class="col-sm-2 visible-lg">
          <div class="btn-group pull-right">
            <!-- <a href="{{ url('services/register') }}" id="btnNew" class="btn btn-success"> -->
            <a href="{{URL::action('ServicesController@getRegister')}}" class="btn btn-success">
              <i class="fa fa-plus-circle"></i> ส่งตรวจ
          </a>
          <a href="javascript:void(0);" id="btnSearchVisit" class="btn btn-primary">
              <i class="fa fa-search"></i> ค้นหา
          </a>
          </div>
      </div>
  </div>
</div>
<table class="table table-bordered" id="tblVisitList">
	<thead>
		<tr>
			<th>วันที่</th>
			<th>เลขบัตรประชาชน</th>
			<th>ชื่อ - สกลุ</th>
			<th class="visible-lg">อายุ (ป-ด-ว)</th>
			<th class="visible-lg">สิทธิ์การรักษา</th>
			<th>อาการแรกรับ (CC)</th>
			<th>การวินิจฉัย</th>
			<th>แพทย์ผู้ตรวจ</th>
			<th>#</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

@stop

@section('modal')

<div class="modal fade" id="modalSearch">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-search"></i> ค้นหาผู้รับบริการ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-2">
                        คำค้นหา
                    </div>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="txtQuery" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnSelectedPerson">
                    <i class="fa fa-check-circle-o"></i> เลือกรายการ
                </button>
                <button class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-power-off"></i> ปิด
                </button>
            </div>
        </div>
    </div>
</div>

@stop

@section('urls')
<script>
    var serviceUrls = [
        "{{ action('ServiceAncController@postScreen') }}" //0
    ];
</script>
@stop

@section('scripts')
{{ HTML::script('/assets/app/js/services/index.js'); }}
@stop
