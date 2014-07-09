@extends('layouts.default')

@section('content')

<ol class="breadcrumb">
    <li><a href="/">หน้าหลัก</a></li>
    <li><a href="{{ URL::action('ServicesController@getIndex') }}">ระบบ One Stop Service</a></li>
    <li class="active">ลงทะเบียนส่งตรวจ</li>
</ol>

<div class="navbar navbar-default">
    <form class="navbar-form" role="search">
        <p class="navbar-text">ค้นหา</p>
        <input type="hidden" id="txtPersonId">
        <input type="text" id="txtQuery" style="width: 400px;"
               class="form-control" disabled="disabled" placeholder="ชื่อ-สกุล/เลขบัตรประชาชน">
        <button type="button" class="btn btn-primary navbar-btn" id="btnSearchPerson">
            <i class="fa fa-search"></i> ค้นหา...
        </button>

        <div class="btn-group pull-right">
            <a href="javascript:void(0);" class="btn btn-success navbar-btn" id="btnSaveService">
                <i class="fa fa-save"></i> บันทึก
            </a>
            <a href="{{ URL::action('ServicesController@getIndex') }}" class="btn btn-default navbar-btn" id="btnCancelService">
                <i class="fa fa-sign-out"></i> ยกเลิก
            </a>
        </div>
    </form>
</div>

<form class="form-horizontal" role="form">
    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-edit"></i> ข้อมูลการรับบริการ</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="control-label">วันที่รับบริการ</label>
                                    <div class="input-group date" data-type="date-picker">
                                        <input type="text" id="txtServiceDate" value="{{Helpers::getCurrentDate()}}" class="form-control" placeholder="dd/mm/yyyy"/>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label">เวลา</label>
                                    <input type="text" id="txtServiceTime" class="form-control" data-type="time" value="{{ Helpers::getCurrentTime() }}" />
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label">ประเภทบริการ</label>
                                    <select class="form-control" id="slServicePlace">
                                        <option value="1">ในสถานบริการ</option>
                                        <option value="2">นอกสถานบริการ</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label">ประเภทที่อยู่</label>
                                    <select class="form-control" id="slServiceLocation">
                                        <option value="1">ในเขตบริการ</option>
                                        <option value="2">นอกเขตบริการ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="control-label">ประเภทเวลา</label>
                                    <select class="form-control" id="slServiceIntime">
                                        <option value="1">ในเวลาราชการ</option>
                                        <option value="2">นอกเวลาราชการ</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label">ประเภทการมา</label>
                                    <select class="form-control" id="slServiceTypeIn">
                                        <option value="1">มารับบริการเอง</option>
                                        <option value="2">มารับบริการตามนัดหมาย</option>
                                        <option value="3">ได้รับการส่งต่อจากสถานบริการอื่น</option>
                                        <option value="4">รับส่งต่อจากบริการ EMS</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label">ความเร่งด่วน</label>
                                    <select class="form-control" id="slServicePriority">
                                        <option value="1">ปกติ</option>
                                        <option value="2">มาก</option>
                                        <option value="3">มากที่สุด</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label">สภาพผู้ป่วย</label>
                                    <select class="form-control" id="slServicePersonStatus">
                                        <option value="1">เดินมา</option>
                                        <option value="2">อุ้มมา</option>
                                        <option value="3">รถเข็น</option>
                                        <option value="4">รถนอน</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="control-label">อาการสำคัญ (CC)</label>
                                    <textarea class="form-control" id="txtServiceCC" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label" for="slServiceClinic">แผนกให้บริการ</label>
                                    <select class="form-control" id="slServiceClinic">
                                        <option value="">-*-</option>
                                        @foreach($clinics as $cl)
                                        <option value="{{ $cl->id }}">[{{ $cl->export_code }}] {{ $cl->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="slServiceDoctorRoom">ส่งไปห้องตรวจ</label>
                                    <select class="form-control" id="slServiceDoctorRoom">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-calendar-o"></i> สิทธิการรักษาพยาบาล</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <label for="" class="control-label">ประเภทสิทธิ์</label>
                                    <select id="slServiceIns" class="form-control">
                                        <option value="">*</option>
                                        @foreach($ins as $i)
                                        <option value="{{ $i->id }}">[{{ $i->export_code }}] {{ $i->insurance_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <label for="" class="control-label">หมายเลขบัตร</label>
                                    <input type="text" class="form-control" id="txtServiceInsCode"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="" class="control-label">สถานบริการหลัก</label>
                                    <input type="hidden" class="form-control" id="slServiceInsMain"/>
                                </div>
                                <div class="col-sm-6">
                                    <label for="" class="control-label">สถานบริการรอง</label>
                                    <input type="hidden" class="form-control" id="slServiceInsSub"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label class="control-label">วันเริ่มใช้สิทธิ์</label>
                                    <div class="input-group date" data-type="date-picker">
                                        <input type="text" id="txtServiceInsStartDate" class="form-control" placeholder="dd/mm/yyyy"/>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="control-label">วันหมดอายุ</label>
                                    <div class="input-group date" data-type="date-picker">
                                        <input type="text" id="txtServiceInsExpireDate" class="form-control" placeholder="dd/mm/yyyy"/>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="button" class="btn btn-primary bnt-sm">
                                <i class="fa fa-search"></i> ประวัติ...
                            </button>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="row">-->
<!--                <div class="col-sm-12">-->
<!--                    <div class="panel panel-primary">-->
<!--                        <div class="panel-heading"><i class="fa fa-calendar-o"></i> ข้อมูลรับส่งต่อ</div>-->
<!--                        <div class="panel-body">-->
<!--                            <div class="row">-->
<!--                                <div class="col-sm-6">-->
<!--                                    <label for="slServiceReferFromHosp" class="control-label">รับจากสถานบริการ</label>-->
<!--                                    <input type="hidden" class="form-control" id="slServiceReferFromHosp"/>-->
<!--                                </div>-->
<!--                                <div class="col-sm-6">-->
<!--                                    <label for="txtServiceReferFromCode" class="control-label">เลขที่ใบส่งต่อ</label>-->
<!--                                    <input class="form-control" type="text" id="txtServiceReferFromCode" />-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row">-->
<!--                                <div class="col-sm-3">-->
<!--                                    <label class="control-label">วันที่ออก</label>-->
<!--                                    <div class="input-group date" data-type="date-picker">-->
<!--                                        <input type="text" id="txtBirthDate" class="form-control" placeholder="dd/mm/yyyy"/>-->
<!--                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="panel-footer">-->
<!--                            <button type="button" class="btn btn-primary bnt-sm">-->
<!--                                <i class="fa fa-search"></i> ประวัติส่งต่อ...-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
        <div class="col-sm-4">
<!--            <div class="row">-->
<!--                <div class="col-sm-12">-->
<!--                    <div class="panel panel-primary">-->
<!--                        <div class="panel-heading"><i class="fa fa-picture-o"></i> รูปภาพ</div>-->
<!--                        <div class="panel-body">-->
<!--                            <p>...</p>-->
<!--                        </div>-->
<!--                        <div class="panel-footer">-->
<!--                            <button type="button" class="btn btn-primary btn-sm">-->
<!--                                <i class="fa fa-plus"></i> เปลี่ยน..-->
<!--                            </button>-->
<!--                            <button type="button" class="btn btn-primary btn-sm">-->
<!--                                <i class="fa fa-trash-o"></i> ลบ-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-instagram"></i> ข้อมูลทั่วไป</div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>เลขบัตรประชาชน</td>
                                <td><span id="txtInfoCID" class="text-muted">...</span></td>
                            </tr>
                            <tr>
                                <td>ชื่อ-สกลุ</td>
                                <td><span id="txtInfoFullname" class="text-muted">...</span></td>
                            </tr>
                            <tr>
                                <td>วันเกิด</td>
                                <td><span id="txtInfoBirthDate" class="text-muted">...</span></td>
                            </tr>
                            <tr>
                                <td>อายุ</td>
                                <td><span id="txtInfoAge" class="text-muted">...</span></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td><span id="txtInfoAddress" class="text-muted">...</span></td>
                            </tr>
                            <tr>
                                <td>Typearea</td>
                                <td><span id="txtInfoTypearea" class="text-danger">...</span></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="panel-footer">
                            <button type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> แก้ไข
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-th-list"></i> ประวัติการรรับบริการ (EMR)</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>PCU</th>
                                <th>Dx</th>
                                <th>สิทธิ์</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="4">...</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="panel-footer">
                            <button type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-sign-out"></i> ดูทั้งหมด
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@stop

@section('modal')
<div class="modal fade" id="modalSearchPerson">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><i class="fa fa-search"></i> ค้นหาผู้รับบริการ</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline well well-sm" action="#">
                    <label for="" class="control-label">ชื่อ/สกุล/CID</label>
                    <input type="text" class="form-control" id="txtQueryPerson" style="width: 400px;"/>
                    <a href="javascript:void(0);" class="btn btn-primary" id="btnDoSearchPerson">
                        <i class="fa fa-search"></i> ค้นหา
                    </a>
                </form>
                <table class="table table-bordered" id="tblSearchPersonResult">
                    <thead>
                    <tr>
                        <th>เลขบัตรประชาชน</th>
                        <th>ชื่อ-สกุล</th>
                        <th>เพศ</th>
                        <th>วันเกิด</th>
                        <th>อายุ</th>
                        <th>ที่อยู่</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="7">กรุณาระบุคำค้นหา</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
{{ HTML::script('assets/app/js/services.register.js'); }}
@stop

@section('urls')
<script>
    var servicesUrls = [
        "{{ action('ServicesController@postSave') }}"
    ];
</script>
@stop