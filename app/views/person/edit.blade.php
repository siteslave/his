@extends('layouts.default')

@section('content')

<ol class="breadcrumb">
    <li><a href="/">หน้าหลัก</a></li>
    <li><a href="{{ URL::route('sheet_1') }}">หมู่บ้านและหลังคาเรือน</a></li>
    <li class="active">แก้ไขข้อมูล</li>
</ol>

<div class="navbar navbar-default">
    <form action="#" class="form-inline navbar-form">
        <label for="txtCid">เลขบัตรประชาชน</label>
        <input id="txtCid" class="form-control" style="width: 200px;" type="text" value="{{$person->cid}}" placeholder="xxxxxxxxxxxxx">
        <button class="btn btn-default" type="button" disabled><i class="fa fa-refresh"></i></button>
        <button class="btn btn-primary" type="button" id="btn_search_dbpop-x" disabled><i class="fa fa-search"></i></button>
        |
        <label for="txt_passport">เลขที่ Passport</label>
        <input class="form-control" type="text" id="txt_passport" style="width: 200px;" value="" placeholder="เลขที่ Passport" class="input-medium">

        <input type="hidden" id="txtPID" value="{{$person->id}}"/>

        <div class="btn-group pull-right">
            <button type="button" class="btn btn-success" id="btnSave">
                <i class="fa fa-save"></i> บันทึก
            </button>
            <button type="button" class="btn btn-default" id="bntCancel">
                <i class="fa fa-refresh"></i> ยกเลิก
            </button>
        </div>

    </form>
</div>

<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabPersonInfo" data-toggle="tab" id="btn_tab_person_info"><i class="fa fa-th-list"></i> ข้อมูลทั่วไป</a></li>
        <li><a href="#tabRight" data-toggle="tab" id="btn_tab_person_right"><i class="fa fa-folder-open-o"></i> สิทธิการรักษา</a></li>
        <li><a href="#tabOutsideAddress" data-toggle="tab" id="btn_tab_person_address"><i class="fa fa-edit"></i> ที่อยู่นอกเขต</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tabPersonInfo">
            <div class="row">
                <div class="col-md-2 col-lg-2">
                    <label for="slTitle">คำนำหน้า</label>
                    <select  id="slTitle" class="form-control">
                        <option value="">--</option>
                        @foreach($titles as $t)
                            @if($person->title_id == $t->id)
                            <option value="{{$t->id}}" selected="selected">[{{$t->export_code}}] {{$t->name}}</option>
                            @else
                            <option value="{{$t->id}}">[{{$t->export_code}}] {{$t->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-lg-3">
                    <label for="txt_first_name">ชื่อ</label>
                    <input class="form-control" type="text" id="txt_first_name" value="{{$person->fname}}" placeholder="ชื่อ">
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="control-group">
                        <label for="txt_last_name">สกุล</label>
                        <div class="controls">
                            <input type="text" class="form-control" id="txt_last_name" value="{{$person->lname}}" placeholder="สกุล">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2">
                    <label>วันเกิด</label>
                    <div class="input-group date" data-type="date-picker">
                        <input type="text" id="txtBirthDate" value="{{Helpers::toJSDate($person->birthdate)}}" class="form-control" placeholder="dd/mm/yyyy"/>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2">
                    <label for="sl_sex">เพศ</label>
                    <select class="form-control" id="sl_sex">
                        @if($person->sex == '1')
                        <option value="1" selected="selected">ชาย</option>
                        <option value="2">หญิง</option>
                        @else
                        <option value="1">ชาย</option>
                        <option value="2" selected="selected">หญิง</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <label for="slMStatus">สถานะสมรส</label>
                    <select class="form-control" id="slMStatus">
                        <option value="">--</option>
                        @foreach($mstatus as $m)
                            @if($person->married_status_id == $m->id)
                            <option value="{{$m->id}}" selected="selected">[{{$m->export_code}}] {{$m->name}}</option>
                            @else
                            <option value="{{$m->id}}">[{{$m->export_code}}] {{$m->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 col-lg-5">
                    <label for="slOccupation">อาชีพ</label>
                    <select class="form-control" id="slOccupation">
                        <option value="">--</option>
                        @foreach($occupations as $oc)
                            @if($person->occupation_id == $oc->id)
                            <option value="{{$oc->id}}" selected="selected">[{{$oc->export_code}}] {{$oc->name}}</option>
                            @else
                            <option value="{{$oc->id}}">[{{$oc->export_code}}] {{$oc->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-lg-4">
                    <label for="slEducation">การศึกษา</label>
                    <select class="form-control" id="slEducation">
                        <option value="">--</option>
                        @foreach($educations as $ed)
                            @if($person->education_id == $ed->id)
                            <option value="{{$ed->id}}" selected="selected">[{{$ed->export_code}}] {{$ed->name}}</option>
                            @else
                            <option value="{{$ed->id}}">[{{$ed->export_code}}] {{$ed->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <label for="slNation">สัญชาติ</label>
                    <select class="form-control" id="slNation">
                        <option value="">--</option>
                        @foreach($nations as $nt)
                            @if($person->nation_id == $nt->id)
                            <option value="{{$nt->id}}" selected="selected">[{{$nt->export_code}}] {{$nt->name}}</option>
                            @else
                            <option value="{{$nt->id}}">[{{$nt->export_code}}] {{$nt->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-lg-3">
                    <label for="slRace">เชื้อชาติ</label>
                    <select class="form-control" id="slRace">
                        <option value="">--</option>
                        @foreach($races as $re)
                            @if($person->race_id == $re->id)
                            <option value="{{$re->id}}" selected="selected">[{{$re->export_code}}] {{$re->name}}</option>
                            @else
                            <option value="{{$re->id}}">[{{$re->export_code}}] {{$re->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-lg-3">
                    <label for="slReligion">ศาสนา</label>
                    <select class="form-control" id="slReligion">
                        <option value="">--</option>
                        @foreach($religions as $rg)
                            @if($person->religion_id == $rg->id)
                            <option value="{{$rg->id}}" selected="selected">[{{$rg->export_code}}] {{$rg->name}}</option>
                            @else
                            <option value="{{$rg->id}}">[{{$rg->export_code}}] {{$rg->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-lg-3">
                    <label for="slFstatus">สถานะในครอบครัว</label>
                    <select class="form-control" id="slFstatus">
                        <option value="">--</option>
                        @foreach($fstatus as $fs)
                            @if($person->family_status_id == $fs->id)
                            <option value="{{$fs->id}}" selected="selected">[{{$fs->export_code}}] {{$fs->name}}</option>
                            @else
                            <option value="{{$fs->id}}">[{{$fs->export_code}}] {{$fs->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <label for="slVstatus">สถานะในชุมชน</label>
                    <select class="form-control" id="slVstatus">
                        <option value="">--</option>
                        @foreach($vstatus as $vs)
                            @if($person->village_status_id == $vs->id)
                            <option value="{{$vs->id}}" selected="selected">[{{$vs->export_code}}] {{$vs->name}}</option>
                            @else
                            <option value="{{$vs->id}}">[{{$vs->export_code}}] {{$vs->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-lg-3">
                    <label for="txtFatherCid">CID บิดา</label>
                    <input class="form-control" type="text" id="txtFatherCid" value="{{$person->father_cid}}" placeholder="xxxxxxxxxxxxx">
                </div>
                <div class="col-md-3 col-lg-3">
                    <label for="txtMotherCid">CID มารดา</label>
                    <input type="text" class="form-control" id="txtMotherCid" value="{{$person->mother_cid}}" placeholder="xxxxxxxxxxxxx">
                </div>

                <div class="col-md-3 col-lg-3">
                    <label for="txtCoupleCid">CID คู่สมรส</label>
                    <input type="text" class="form-control" id="txtCoupleCid" value="{{$person->couple_cid}}" placeholder="xxxxxxxxxxxxx">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-lg-2">
                    <div class="control-group">
                        <label>วันที่ย้ายเข้า</label>
                        <div class="input-group date" data-type="date-picker">
                            <input type="text" id="txtMoveInDate" value="{{Helpers::toJSDate($person->movein_date)}}" class="form-control" placeholder="dd/mm/yyyy"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2">
                    <label>วันที่ย้ายเข้า</label>
                    <div class="input-group date" data-type="date-picker">
                        <input type="text" id="txtDischargeDate" value="{{Helpers::toJSDate($person->discharge_date)}}" class="form-control" placeholder="dd/mm/yyyy"/>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="col-md-3 col-lg-3">
                    <label for="slDischarge">สถานะการจำหน่าย</label>
                    <select class="form-control" id="slDischarge">
                        <option value="">--</option>
                        @foreach($discharge_status as $ds)
                            @if($person->discharge_id == $ds->id)
                            <option value="{{$ds->id}}" selected="selected">[{{$ds->export_code}}] {{$ds->name}}</option>
                            @else
                            <option value="{{$ds->id}}">[{{$ds->export_code}}] {{$ds->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-lg-2">
                    <label for="slABOGroup">หมู่เลือด</label>
                    <select class="form-control" id="slABOGroup">
                        <option value="">--</option>
                        @foreach($abogroup as $abo)
                            @if($person->blood_group_id == $abo->id)
                            <option value="{{$abo->id}}" selected="selected">[{{$abo->export_code}}] {{$abo->name}}</option>
                            @else
                            <option value="{{$abo->id}}">[{{$abo->export_code}}] {{$abo->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 col-lg-2">
                    <label for="slRHGroup">หมู่เลือด RH</label>
                    <select class="form-control" id="slRHGroup">
                        <option value="">--</option>
                        @foreach($rhgroup as $rh)
                            @if($person->rh_group_id == $rh->id)
                            <option value="{{$rh->id}}" selected="selected">[{{$rh->export_code}}] {{$rh->name}}</option>
                            @else
                            <option value="{{$rh->id}}">[{{$rh->export_code}}] {{$rh->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <label for="slLabor">คนต่างด้าว</label>
                    <select class="form-control" id="slLabor">
                        <option value="">--</option>
                        @foreach($labors as $lb)
                            @if($person->labor_id == $lb->id)
                            <option value="{{$lb->id}}" selected="selected">[{{$lb->export_code}}] {{$lb->name}}</option>
                            @else
                            <option value="{{$lb->id}}">[{{$lb->export_code}}] {{$lb->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 col-lg-5">
                    <label for="slTypeArea">ประเภทบุคคล</label>
                    <select class="form-control" id="slTypeArea">
                        <option value="">--</option>
                        @foreach($typeareas as $ty)
                            @if($person->typearea_id == $ty->id)
                            <option value="{{$ty->id}}" selected="selected">[{{$ty->export_code}}] {{$ty->name}}</option>
                            @else
                            <option value="{{$ty->id}}">[{{$ty->export_code}}] {{$ty->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tabRight">
            <br />
            <div class="navbar navbar-default">
                <form action="#" class="navbar-form">
                    <label for="sl_inscl_type">ประเภทสิทธิการรักษา</label>
                    <select name="slInstype" id="slInsurance" class="form-control" style="width: 480px;">
                        <option value="">--</option>
                        @foreach($insurances as $ins)
                            @if($insurances_detail->insurance_id == $ins->id)
                            <option value="{{$ins->id}}" selected="selected">[{{$ins->export_code}}] {{$ins->name}}</option>
                            @else
                            <option value="{{$ins->id}}">[{{$ins->export_code}}] {{$ins->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="txt_inscl_code">รหัสสิทธิ</label>
                    <input class="form-control" style="width: 200px;" type="text" id="txtInsCode"
                           value="{{ $insurances_detail->insurance_code }}" placeholder="รหัสสิทธิการรักษา">
                </form>
            </div>
            <form class="form-horizontal" action="#">
                <div class="row">
                    <div class="col-md-2 col-lg-2">
                        <label for="txtInsStartDate">วันออกบัตร</label>
                        <div class="input-group date" data-type="date-picker">
                            <input type="text" id="txtInsStartDate" value="{{ Helpers::toJSDate($insurances_detail->start_date) }}" class="form-control" placeholder="dd/mm/yyyy"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <label for="txtInsExpireDate">วันหมดอายุ</label>
                        <div class="input-group date" data-type="date-picker">
                            <input type="text" id="txtInsExpireDate" value="{{ Helpers::toJSDate($insurances_detail->expire_date) }}" class="form-control" placeholder="dd/mm/yyyy"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <label for="txtInsHospmain">ชื่อสถานพยาบาลหลัก</label>
                        <input id="txtInsHospmain" data-id="{{$insurances_detail->hospmain}}"
                               data-text="{{$insurances_detail->hospmain_name}}"
                               type="hidden" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <label for="txtInsHospsub">ชื่อสถานพยาบาลรอง</label>
                        <input id="txtInsHospsub" data-id="{{$insurances_detail->hospsub}}"
                               data-text="{{$insurances_detail->hospsub_name}}"
                               type="hidden" class="form-control">
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="tabOutsideAddress">
            <form action="#" class="form-horizontal">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <label for="slOutsiedAddressType">ประเภท</label>
                        <select id="slOutsiedAddressType" class="form-control">
                            <option value="1">ที่อยู่ตามทะเบียนบ้าน</option>
                            <option value="2">ที่อยู่ที่ติดต่อได้</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="control-group">
                            <label for="slOutsiedHouseType">ลักษณะที่อยู่</label>
                            <div class="controls">
                                <select id="slOutsiedHouseType" class="form-control">
                                    <option value="">--</option>
                                    <?php //foreach($house_type as $t) echo '<option value="'.$t->id.'">'.$t->name.'</option>'; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="control-group">
                            <label for="txtOutsideHouseId">รหัสบ้าน</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="txtOutsideHouseId" value="" placeholder="ตามกรมการปกครอง">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="control-group">
                            <label for="txtOutsideRoomNumber">เลขห้อง</label>
                            <div class="controls">
                                <input type="text" class="form-control" value="" id="txtOutsideRoomNumber">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="control-group">
                            <label for="txtOutsideCondo">ชื่ออาคารชุด</label>
                            <div class="controls">
                                <input type="text" class="form-control" value="" id="txtOutsideCondo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-lg-2">
                        <div class="control-group">
                            <label for="txtOutsideAddressNumber">บ้านเลขที่</label>
                            <div class="controls">
                                <input type="text" value="" class="form-control" id="txtOutsideAddressNumber">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="control-group">
                            <label for="txtOutsideVillageName">บ้านจัดสรร</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="txtOutsideVillageName" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="control-group">
                            <label for="txtOutsideSoiSub">ซอยแยก</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="txtOutsideSoiSub" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="control-group">
                            <label for="txtOutsideSoiMain">ซอยหลัก</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="txtOutsideSoiMain" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="control-group">
                            <label for="txtOutsideRoad">ถนน</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="txtOutsideRoad" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-2 col-lg-2">
                        <div class="control-group">
                            <label for="slOutsideVillage">หมู่ที่</label>
                            <div class="controls">
                                <select id="slOutsideVillage" class="form-control">
                                    <?php for($i=0; $i<=50; $i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="control-group">
                            <label for="slOutsideProvince">จังหวัด</label>
                            <div class="controls">
                                <select id="slOutsideProvince" class="form-control">
                                    <option value="">--</option>
                                    <?php //foreach($provinces as $t) echo '<option value="'.$t->code.'">'.$t->name.'</option>'; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="control-group">
                            <label for="slOutsideAmpur">อำเภอ</label>
                            <div class="controls">
                                <select id="slOutsideAmpur" class="form-control">
                                    <option value="">--</option>
                                    <?php //foreach($ampurs as $t) echo '<option value="'.$t->code.'">'.$t->name.'</option>'; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="control-group">
                            <label for="slOutsideTambon">ตำบล</label>
                            <div class="controls">
                                <select id="slOutsideTambon" class="form-control">
                                    <option value="">--</option>
                                    <?php //foreach($tambons as $t)  echo '<option value="'.$t->code.'">'.$t->name.'</option>'; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-lg-2">
                        <div class="control-group">
                            <label for="txtOutsidePostcode">รหัสไปรษณีย์</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="txtOutsidePostcode" value="" data-type="number">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="control-group">
                            <label for="txtOutsideTelephone">โทรศัพท์บ้าน</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="txtOutsideTelephone" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="control-group">
                            <label for="txtOutsideMobile">โทรศัพท์มือถือ</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="txtOutsideMobile" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript" charset="utf-8" src="/assets/app/js/person.edit.js"></script>
@stop
