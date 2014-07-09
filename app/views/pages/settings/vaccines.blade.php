<input type="hidden" id="txtVaccineLotId" value=""/>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">รายการวัคซีนที่ใช้ในหน่วยงาน</h4>
    </div>
    <table class="table table-striped" id="tblVaccineList">
        <thead>
            <tr>
                <th>ชื่อวัคซีน</th>
                <th>ชื่อภาษาอังกฤษ</th>
                <th>Lot.</th>
                <th>วันหมดอายุ</th>
                <th>รหัสส่งออก</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($vaccine_all as $a)
            <tr>
                <td>{{{ $a->th_name }}}</td>
                <td>{{{ $a->name }}}</td>
                <td>{{{ $a->lot }}}</td>
                <td>{{ Helpers::fromMySQLtoThaiDate($a->expire_date) }}</td>
                <td>{{{ $a->export_code }}}</td>
                <td>
                    <div class="btn-group">
                        <a href="#" class="btn btn-sm btn-default" data-name="btnVaccineEdit" data-id="{{ $a->id }}"
                            data-lot="{{ $a->lot }}" data-expire="{{ Helpers::toJSDate($a->expire_date) }}"
                            data-vaccine="{{ $a->vaccine_id }}">
                            <i class="fa fa-edit"></i>
                        </a>
<!--                        <a href="#" class="btn btn-sm btn-danger" data-id="{{ $a->id }}"><i class="fa fa-times"></i></a>-->
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="table table-striped hidden" id="tblAddVaccine">
        <tr>
            <td width="60%">ชื่อวัคซีน</td>
            <td width="20%">Lot.</td>
            <td width="20%">วันหมดอายุ</td>
            <td width="20%">#</td>
        </tr>
        <tr>
            <td width="60%">
                {{ Form::select('slVaccine', $vaccines, null, ['id' => 'slVaccine', 'class' => 'form-control']) }}
            </td width="20%">
            <td>
                {{ Form::text('txtVaccineLot', null, ['id' => 'txtVaccineLot', 'class' => 'form-control']) }}
            </td>
            <td width="20%">
                <div data-type="date-picker" class="input-group date col-sm-12">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtVaccineExpireDate">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </td>
            <td>
                <a href="#" class="btn btn-success" id="btnSaveVaccineLot">
                    <span class="fa fa-save"></span>
                </a>
            </td>
        </tr>
    </table>
    <div class="panel-footer">
        <button class="btn btn-primary" id="btnAddVaccine">
            <span class="fa fa-plus-circle"></span>
            เพิ่มรายการ/ซ่อน
        </button>
    </div>
</div>
