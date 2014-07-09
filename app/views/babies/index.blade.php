@extends('layouts.default')

@section('content')

<ol class="breadcrumb">
    <li><a href="/">หน้าหลัก</a></li>
    <li class="active">ทะเบียนหญิงตั้งครรภ์</li>
</ol>

<div class="row">
    <div class="col-md-3 col-lg-3">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-th-large"></i> เมนูหลัก
                    </h4>
                </div>
                <div class="list-group" id="collapseMain">
                    <a class="list-group-item" href="#list">
                        <i class="fa fa-fw fa-edit"></i> ทะเบียนหญิงตั้งครรภ์
                    </a>
                    <a class="list-group-item" href="#procedures">
                        <span class="badge">3</span>
                        <i class="fa fa-fw fa-envelope"></i> หญิงตั้งครรภ์รอขึ้นทะเบียน
                    </a>
                    <a class="list-group-item" href="#drug">
                        <span class="badge">5</span>
                        <i class="fa fa-fw fa-envelope-o"></i> หญิงคลอดรอขึ้นทะเบียน
                    </a>
                </div>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-cogs"></i> เครื่องมือ
                    </h4>
                </div>
                <div class="list-group" id="collapseTools">
                    <a class="list-group-item" href="#screening">
                        <i class="fa fa-fw fa-search"></i> ค้นหาประวัติการฝากครรภ์ที่อื่น
                    </a>
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
            "{{ action('PagesController@getPregnanciesList') }}"
        ],

        scriptUrl = [
            "{{ asset('assets/app/js/pregnancies/list.js') }}",
            "{{ asset('assets/app/js/pregnancies/register.js') }}"
        ],

        actionUrl = [
            "{{ action('PregnanciesController@postRegister') }}",
            "{{ action('PregnanciesController@getList') }}"
        ];
</script>
@stop

@section('scripts')
{{ HTML::script( asset('assets/app/js/pregnancies/index.js') ); }}
@stop
