<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-ambulance"></i> บันทึกข้อมูลการนัดหมาย (Appointment)
        </h4>
    </div>
    <div class="panel-body">
        บันทึกข้อมูลการนัดหมาย กรุณาระบุข้อมูลให้ถูกต้องและสมบูรณ์ เพื่อป้องกันข้อผิดพลาดในการส่งออก
    </div>
    <table class="table table-bordered" id="tblAppointList">
        <thead>
        <tr>
            <th>#</th>
            <th>กิจกรรมที่นัด</th>
            <th>วันที่</th>
            <th>เวลา</th>
            <th>คลินิค</th>
            <th>เจ้าหน้าที่นัด</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="7">...</td>
        </tr>
        </tbody>
    </table>

    <div class="hidden" id="divNewAppoint">
        <table class="table">
            <thead>
            <tr>
                <th>กิจกรรมที่นัด</th>
                <th>วันที่</th>
                <th>เวลา</th>
                <th>คลินิค</th>
                <th>เจ้าหน้าที่นัด</th>
                <th>#</th>
            </tr>
            <tr>
                <td width="30%">
                    <select class="form-control" id="slAppoint">
                        <option value="">-*-</option>
                        @foreach ($appoints as $a)
                        <option value="{{ $a->id }}">{{ $a->name }} [{{ $a->th_name }}]</option>
                        @endforeach
                    </select>
                </td>
                <td width="20%">
                    <div data-type="date-picker" class="input-group date col-sm-12">
                        <input type="text" placeholder="วว/ดด/ปปปป" class="form-control"
                               value="{{ Helpers::getCurrentDate() }}" id="txtAppointDate">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>
                <td width="10%">
                    <input id="txtAppointTime" class="form-control" type="text" data-type="time" />
                </td>
                <td width="20%">
                    <select class="form-control" id="slAppointClinic">
                        <option value="">-*-</option>
                        @foreach ($clinics as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td width="20%">
                    <select class="form-control" id="slAppointProvider">
                        <option value="">-*-</option>
                        @foreach ($providers as $p)
                        <option value="{{ $p->id }}">{{ $p->fname }} [{{ $p->lname }}]</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary" id="btnAppointSave"><i class="fa fa-save"></i></a>
                </td>
            </tr>
            </thead>
        </table>
    </div>
    <div class="panel-footer">
        <button class="btn btn-primary" id="btnAppointNew">
            <i class="fa fa-plus"></i> เพิ่ม/ซ่อน
        </button>
    </div>
</div>
