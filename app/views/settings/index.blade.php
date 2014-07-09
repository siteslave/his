@extends('layouts.settings')

@section('content')
<ol class="breadcrumb">
    <li><a href="{{ URL::to('/') }}">หน้าหลัก</a></li>
    <li class="active">ตั้งค่าระบบ</li>
</ol>

<div class="row">
    <div class="col-md-3 col-lg-3">
        <div class="panel-group" id="accordion">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseMain">
                            <i class="fa fa-th-large"></i> ข้อมูลทั่วไป
                        </a>
                    </h4>
                </div>
                <div class="panel-collapse collapse in" id="collapseMain">
                    <div class="list-group">
                        <a class="list-group-item" href="#screening">
                            <i class="fa fa-fw fa-suitcase"></i> ผู้ใช้งานในระบบ
                        </a>
                        <a class="list-group-item" href="#vaccines">
                            <i class="fa fa-fw fa-suitcase"></i> ข้อมูลวัคซีน
                        </a>
                        <a class="list-group-item" href="#procedures">
                            <i class="fa fa-fw fa-medkit"></i> ข้อมูลยา
                        </a>
                        <a class="list-group-item" href="#drug">
                            <i class="fa fa-fw fa-medkit"></i> แผนก/คลินิก
                        </a>
                        <a class="list-group-item" href="#income">
                            <i class="fa fa-fw fa-medkit"></i> ค่าใช้จ่าย
                        </a>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#collapseOther" data-toggle="collapse" data-parent="#accordion">
                            <i class="fa fa-th-large"></i> งานส่งเสริมสุขภาพ
                        </a>
                    </h4>

                </div>
                <div class="panel-collapse collapse in" id="collapseOther">
                    <div class="list-group no-border">
                        <a class="list-group-item" href="#"><i class="fa fa-fw fa-medkit"></i> วางแผนครอบครัว (FP)</a>
                        <a class="list-group-item" href="#"><i class="fa fa-fw fa-medkit"></i> บันทึกโภชนาการ (Nutrition)</a>
                        <a class="list-group-item" href="#"><i class="fa fa-fw fa-medkit"></i> บันทึกการให้วัคซีน (EPI)</a>
                        <a class="list-group-item" href="#anc"><i class="fa fa-fw fa-medkit"></i> บันทึกการฝากครรภ์ (ANC)</a>
                        <a class="list-group-item" href="#"><i class="fa fa-fw fa-medkit"></i> เยี่ยมหลังคลอด (มารดา)</a>
                        <a class="list-group-item" href="#"><i class="fa fa-fw fa-medkit"></i> เยี่ยมหลังคลอด (เด็ก)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-lg-9" id="content">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="#collapseSupportService" data-toggle="collapse" data-parent="#accordion">
                        <i class="fa fa-th-large"></i> งานส่งเสริมสุขภาพ
                    </a>
                </h4>

            </div>
            <div class="panel-collapse collapse" id="collapseSupportService">

            </div>
            <div class="panel-footer"></div>
        </div>

    </div>
</div>
@stop

@section('urls')
<script>
    var serviceUrl = [
        "{{ action('SettingsController@postVaccineLots') }}",
        "{{ action('SettingsController@getVaccineLots') }}"
    ],

    pageUrl = [
        "{{ action('PagesController@getSettingsVaccine') }}"
    ],

    scriptUrl = [
        "{{ asset('assets/app/js/settings/vaccines.js') }}"
    ];
</script>
@stop


@section('scripts')
{{ HTML::script(asset('assets/app/js/settings/index.js')); }}
@stop
