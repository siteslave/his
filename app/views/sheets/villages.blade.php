@extends('layouts.default')

@section('content')

<ol class="breadcrumb">
  <li><a href="/">หน้าหลัก</a></li>
  <li class="active">หมู่บ้านและหลังคาเรือน</li>
</ol>

<div class="row">
  <div class="col-sm-3">

    <div class="panel panel-primary">
      <div class="panel-heading">หมู่บ้านในเขตรับผิดชอบ</div>
      <div class="list-group">
        @foreach ($villages as $v)
        <a href="#" data-name="btnGetHome" data-id="{{$v->id}}" class="list-group-item">
          {{$v->village_name}} <span class="badge">5</span>
        </a>
        @endforeach
      </div>
      <div class="panel-footer">
        <button type="button" class="btn btn-primary">
          <i class="fa fa-plus-circle"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="col-sm-9">
    <form class="form-inline well well-sm">
      <label for="slHome">เลือกหลังคาเรือน:</label>
      <select id="slHome" class="form-control" style="width: 200px;">
        <option value="0">กรุณาเลือก</option>
      </select> |
      <button name="btnNewHome" type="button" class="btn btn-success">
        <i class="fa fa-home"></i>
      </button>
      </select>
      <button name="btnNewHome" type="button" class="btn btn-primary">
        <i class="fa fa-plus-circle"></i>
      </button>
      <button name="btnNewPerson" type="button" class="btn btn-default">
        <i class="fa fa-user"></i>
      </button>
      <button name="btnNewPerson" type="button" class="btn btn-primary pull-right">
        <i class="fa fa-search"></i>
      </button>
    </form>

    <table class="table table-bordered" id="tblPerson">
      <thead>
        <tr>
          <th>#</th>
          <th>เลขบัตรประชาชน</th>
          <th>ชื่อ - สกุล</th>
          <th>เพศ</th>
          <th>วันเกิด</th>
          <th>อายุ (ป-ด-ว)</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="7">กรุณาเลือกหลังคาเรือน</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript" charset="utf-8" src="/assets/app/js/villages.js"></script>
@stop
