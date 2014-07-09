@extends('layouts.default')

@section('content')

<?php $age = Helpers::countAge($person->birthdate) ?>

<ol class="breadcrumb">
    <li><a href="{{ URL::to('/') }}">หน้าหลัก</a></li>
    <li><a href="{{ URL::action('PregnanciesController@getIndex') }}">ทะเบียนหญิงตั้งครรภ์</a></li>
    <li class="active">ข้อมูลการตั้งครรภ์</li>
</ol>

<input type="hidden" id="txtPregnancyId" value="{{ $id }}"/>
<input type="hidden" id="txtPersonId" value="{{ $person->id }}"/>
<input type="hidden" id="txtGravida" value="{{ $data->gravida }}"/>

<div class="row">
    <div class="col-md-3 col-lg-3">
        <div class="panel-group" id="accordionDetail">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordionDetail" href="#collapsePregnanciesInfo">
                            <i class="fa fa-th-large"></i> ข้อมูลทั่วไป
                        </a>
                    </h4>
                </div>
                <div class="panel-collapse collapse in" id="collapsePregnanciesInfo">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>​CID</td>
                            <td><span id="txtInfoCID" class="text-muted">{{ $person->cid }}</span></td>
                        </tr>
                        <tr>
                            <td>ชื่อ-สกลุ</td>
                            <td><span id="txtInfoFullname" class="text-muted">{{ $person->fname }} {{ $person->lname }}</span></td>
                        </tr>
                        <tr>
                            <td>อายุ</td>
                            <td>
                                <span id="txtInfoAge" class="text-muted">
                                    {{ $age->year }} ปี {{ $age->month }} เดือน {{ $age->day }} วัน
                                </span></td>
                        </tr>

                        <tr>
                            <td>ครรภ์ที่</td>
                            <td>
                                <span id="txtInfoGravida" class="text-muted">
                                {{ $data->gravida }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>ลงทะเบียน</td>
                            <td>
                                <span id="txtInfoAge" class="text-muted">
                                {{ Helpers::fromMySQLToThaiDate($data->register_date) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Typearea</td>
                            <td><span id="txtInfoTypearea" class="text-danger">{{ $typearea }}</span></td>
                        </tr>
                        <tr>
                        <td>ที่อยู่</td>
                        <td><span id="txtInfoFullname" class="text-muted">{{ $address }}</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer text-center">
                    <a class="btn btn-primary" href="{{ action('PregnanciesController@getIndex') }}">
                        <i class="fa fa-home"></i> หน้าหลัก
                    </a>
                    <a class="btn btn-danger" href="javascript:void(0);" id="btnRemoveService">
                        <i class="fa fa-trash-o"></i> จำหน่าย
                    </a>
                </div>
            </div>

        </div>
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordionDetail" href="#collapseTools">
                            <i class="fa fa-cogs"></i> เครื่องมือ
                        </a>
                    </h4>
                </div>
                <div class="panel-collapse collapse in" id="collapseTools">
                    <div class="list-group">
                        <a class="list-group-item" href="#info">
                            <i class="fa fa-fw fa-edit"></i> ข้อมูลการตั้งครรภ์
                        </a>
                        <a class="list-group-item" href="#anc">
                            <i class="fa fa-fw fa-folder-open-o"></i> การฝากครรภ์
                        </a>
                        <a class="list-group-item" href="#postnatal">
                            <i class="fa fa-fw fa-file-text"></i> การดูแลหลังคลอด
                        </a>
<!--                        <a class="list-group-item" href="#screening">-->
<!--                            <i class="fa fa-fw fa-search"></i> ค้นหาประวัติการฝากครรภ์ที่อื่น-->
<!--                        </a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-lg-9" id="content"></div>
</div>
@stop

@section('urls')
<script>
    var pageUrl = [
            "{{ action('PagesController@postPregnancyDetail') }}", //0
            "{{ action('PagesController@postPregnanciesAnc') }}", //1
            "{{ action('PagesController@postPregnanciesPostnatal') }}" //2
        ],

        scriptUrl = [
            "{{ asset('assets/app/js/pregnancies/pregnancies.js') }}",
            "{{ asset('assets/app/js/pregnancies/anc.js') }}",
            "{{ asset('assets/app/js/pregnancies/postnatal.js') }}"
        ],

        actionUrl = [
            "{{ action('PregnanciesController@postRegister') }}", //0
            "{{ action('PregnanciesController@getList') }}", //1
            "{{ action('PregnanciesController@postDetail') }}", //2
            "{{ action('PregnanciesController@postAncCoverage') }}", //3
            "{{ action('PregnanciesController@deleteAncCoverage') }}", //4
            "{{ action('PregnanciesController@postPostnatalCoverage') }}", //5
            "{{ action('PregnanciesController@deletePostnatalCoverage') }}" //6
        ];
</script>
@stop

@section('scripts')
{{ HTML::script( asset('assets/app/js/pregnancies/detail.js') ); }}
@stop
