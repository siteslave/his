<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <span class="fa fa-edit"></span>
            ข้อมูลการให้บริการวัคซีน
            <i class="fa fa-chevron-circle-down pull-right"></i>
        </h4>
    </div>
    <div class="panel-body">
                <span class="text-muted">
                    การให้บริการวัคซีนแก่ผู้มารับบริการ ทั้งในเขตและนอกเขต หากต้องการบันทึกความครอบคลุมให้บันทึกตามบัญชี ต่างๆ
                </span>
    </div>
    <table class="table table-striped" id="tblVaccineList">
        <thead>
        <tr>
            <th>รายการวัคซีน</th>
            <th>Lot.</th>
            <th>วันหมดอายุ</th>
            <th>สถานที่ให้บริการ</th>
            <th>ผู้ให้บริการ</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($vaccines as $v)
        <tr>
            <td>[{{ $v->name }}] {{ $v->th_name }}</td>
            <td class="text-center">{{ $v->vaccine_lot }}</td>
            <td class="text-center">{{ Helpers::fromMySQLToThaiDate($v->vaccine_expire_date) }}</td>
            <td>{{ $v->vaccine_place == '1' ? 'ในสถานบริการ' : 'นอกสถานบริการ' }}</td>
            <td>{{ $v->fname }} {{ $v->lname }}</td>
            <td class="text-center">
                <a href="#" class="btn btn-sm btn-danger" data-name="btnRemoveVaccine" data-id="{{ $v->id }}">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="panel-footer">
        @if ($age->year >= 18)
        <button class="btn btn-success" type="button" disabled>
            <span class="fa fa-plus-circle"></span> วัคซีนเด็กแรกเกิด
        </button>
        <button class="btn btn-info" type="button" disabled>
            <span class="fa fa-plus-circle"></span> วัคซีนนักเรียน
        </button>
        @else
        <button class="btn btn-success" type="button" data-name="btnShowAddVaccine" data-type="1">
            <span class="fa fa-plus-circle"></span> วัคซีนเด็กแรกเกิด
        </button>
        <button class="btn btn-info" type="button" data-name="btnShowAddVaccine" data-type="2">
            <span class="fa fa-plus-circle"></span> วัคซีนนักเรียน
        </button>
        @endif
        <button class="btn btn-primary" type="button" data-name="btnShowAddVaccine" data-type="3">
            <span class="fa fa-plus-circle"></span> วัคซีนทั่วไป
        </button>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapseVaccineHistory">
                <i class="fa fa-edit"></i>
                ประวัติการรับบริการวัคซีน <span class="badge">{{ count($vaccine_all) }}</span>
                <i class="fa fa-chevron-circle-down pull-right"></i>
            </a>

        </h4>
    </div>
    <div class="panel-collapse collapse" id="collapseVaccineHistory">
        <div class="panel-body">
                <span class="text-muted">
                    ประวัติการรับบริการวัคซีนทั้งหมด ทั้งในเขตและนอกเขตบริการ
                </span>
        </div>
        <table class="table table-striped" id="tblVaccineHistoryList">
            <thead>
            <tr>
                <th>รายการวัคซีน</th>
<!--                <th class="text-center">Lot.</th>-->
<!--                <th class="text-center">วันหมดอายุ</th>-->
                <th>สถานที่ให้บริการ</th>
                <th>หน่วยบริการ</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($vaccine_all as $a)
            <tr>
                <td>[{{ $a->name }}] {{ $a->th_name }}</td>
<!--                <td class="text-center">{{ $a->vaccine_lot }}</td>-->
<!--                <td class="text-center">{{ Helpers::fromMySQLToThaiDate($a->vaccine_expire_date) }}</td>-->
                <td>{{ $a->vaccine_place == '1' ? 'ในสถานบริการ' : 'นอกสถานบริการ' }}</td>
                <td>[{{ $a->hmain }}] {{ $a->hname }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
        <small class="text-muted">คลิกที่ Title bar เพื่อย่อหรือขยาย</small>
    </div>
</div>

<!-- Search person -->
<div class="modal fade" id="modalVaccineNew">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><i class="fa fa-plus-circle"></i> เพิ่มรายการวัคซีน</h3>
            </div>
            <div class="modal-body">
                <form action="#">

<!--                    <input id="txtServiceVaccineId" type="hidden"/>-->

                    <div class="row">
                        <div class="col-md-5 col-lg-5">
                            <div class="form-group">
                                <label for="">สถานที่ให้บริการ</label>
                                <select class="form-control" id="slVaccinePlace">
                                    <option value="1">ในสถานบริการ</option>
                                    <option value="2">นอกสถานบริการ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7">
                            <div class="form-group">
                                <label for="">รายการวัคซีน</label>
                                <select class="form-control" id="slVaccineList"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">Lot.</label>
                                <select class="form-control" id="slVaccineLots"></select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">วันหมดอายุ</label>
                                <input class="form-control" type="text" id="txtVaccineExpireDate" readonly/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="">ผู้ให้บริการ</label>
                                {{ Form::select('slVaccineProviders', $providers, null, ['id' => 'slVaccineProviders', 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnVaccineSave">
                    <i class="fa fa-save"></i> บันทึกรายการ
                </button>
                <button class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times"></i> ปิดหน้าต่าง
                </button>
            </div>
        </div>
    </div>
</div>
<!--End Search person-->