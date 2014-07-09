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
                    <a class="list-group-item" href="#" id="btnShowSearchPerson">
                        <i class="fa fa-fw fa-plus-circle"></i> ลงทะเบียนรายใหม่
                    </a>
                    <a class="list-group-item" href="#">
                        <i class="fa fa-fw fa-share-square-o"></i> ส่งออกรายชื่อ
                    </a>
                </div>
            </div>
        </div>
<!--        <div class="panel-group">-->
<!--            <div class="panel panel-primary">-->
<!--                <div class="panel-heading">-->
<!--                    <h4 class="panel-title">-->
<!--                        <i class="fa fa-cogs"></i> เครื่องมือ-->
<!--                    </h4>-->
<!--                </div>-->
<!--                <div class="list-group" id="collapseTools">-->
<!--                    <a class="list-group-item" href="#search">-->
<!--                        <i class="fa fa-fw fa-search"></i> ค้นหาประวัติการฝากครรภ์ที่อื่น-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <div class="col-md-9 col-lg-9" id="content"></div>
</div>
@stop

@section('urls')
<script>
    var pageUrl = [
            "{{ action('PagesController@getPregnanciesList') }}",
            "{{ action('PagesController@getPregnanciesSearch') }}"
        ],

        scriptUrl = [
            "{{ asset('assets/app/js/pregnancies/list.js') }}",
            "{{ asset('assets/app/js/pregnancies/search.js') }}"
        ],

        actionUrl = [
            "{{ action('PregnanciesController@postRegister') }}",
            "{{ action('PregnanciesController@getList') }}"
        ];
</script>
@stop

@section('modal')
<!-- Search person -->
<div class="modal fade" id="modalSearchPerson">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><i class="fa fa-search"></i> ค้นหาผู้รับบริการ</h3>
            </div>
            <div class="modal-body">
                <div class="navbar navbar-default">
                    <form class="form-inline navbar-form" action="#">
                        <label for="" class="control-label">ชื่อ/สกุล/CID</label>
                        <input type="text" class="form-control" id="txtQueryPerson" style="width: 400px;"/>
                        <a href="#" class="btn btn-primary navbar-btn" id="btnDoSearchPerson">
                            <i class="fa fa-search"></i> ค้นหา
                        </a>
                    </form>
                </div>
                <table class="table table-bordered" id="tblSearchPersonResult">
                    <thead>
                    <tr>
                        <th>เลขบัตรประชาชน</th>
                        <th>ชื่อ-สกุล</th>
                        <th>เพศ</th>
                        <th>วันเกิด</th>
                        <th>อายุ</th>
                        <th>ที่อยู่</th>
                        <th>T</th>
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
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!--End Search person-->

@stop

@section('scripts')
{{ HTML::script( asset('assets/app/js/pregnancies/index.js') ); }}
@stop
