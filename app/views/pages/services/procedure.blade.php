<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-ambulance"></i> การให้หัตถการทั่วไป
        </h4>
    </div>
    <div class="panel-body">
        บันทึกข้อมูลการทำหัตถการ สามารถบันทึกได้ทั้งหัตถการทั่วไป และ หัตถการทันตกรรม
        ส่วนทันกรรมให้บันทึกในรายการหัตถการทันตกรรม (ด้านล่าง)
    </div>
    <table class="table table-bordered" id="tblProcedureList">
        <thead>
        <tr>
            <th>#</th>
            <th>หัตถการ</th>
            <th>ตำแหน่ง</th>
            <th class="text-center">ราคา</th>
            <th class="text-center visible-lg visible-md">เวลาเริ่ม</th>
            <th class="text-center visible-lg visible-md">เวลาสิ้นสุด</th>
            <th>ผู้ให้บริการ</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="8">...</td>
        </tr>
        </tbody>
    </table>
    <div class="panel-footer">
        <button class="btn btn-primary" data-name="btnNewProcedure">
            <i class="fa fa-plus"></i> เพิ่ม
        </button>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-ambulance"></i> การให้หัตถการทันตกรรม
        </h4>
    </div>
    <table class="table table-bordered" id="tblProcedureDentalList">
        <thead>
        <tr>
            <th>#</th>
            <th>หัตถการ</th>
            <th>ราคา</th>
            <th>รหัสซี่ฟัน</th>
            <th>ซี่</th>
            <th class="visible-lg visible-md">ด้าน</th>
            <th class="visible-lg visible-md">ราก</th>
            <th>ผู้ให้บริการ</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="9">...</td>
        </tr>
        </tbody>
    </table>
    <div class="panel-footer">
        <button class="btn btn-primary" data-name="btnNewProcedureDental">
            <i class="fa fa-plus"></i> เพิ่ม
        </button>
    </div>
</div>

<div class="modal fade" id="modalProcedure">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-search"></i> บันทึกข้อมูลการทำหัตถการ</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>กิจกรรม</th>
                        <th colspan="3">การให้บริการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>ผู้ทำหัตถการ</td>
                        <td colspan="3">
                            <select class="form-control" id="slProcedureProvider">
                                <option value="">เลือกผู้ทำหัตถการ</option>
                                @foreach ($providers as $p)
                                <option value="{{ $p->id }}">{{ $p->fname }} {{ $p->lname }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>หัตถการ</td>
                        <td colspan="3">
                            <input type="hidden" id="txtProcedureQuery" class="form-control" placeholder="พิมพ์ชื่อหัตถการ"/>
                        </td>
                    </tr>
                    <tr>
                        <td>ตำแหน่ง</td>
                        <td colspan="3">
                            <select class="form-control" id="slProcedurePosition"></select>
                        </td>
                    </tr>
                    <tr>
                        <td>เวลาเริ่ม</td>
                        <td>
                            <input class="form-control" id="txtProcedureStartTime" type="text"
                                   data-type="time" style="width: 100px;" placeholder="hh:mm"/></td>
                        <td>เวลาสิ้นสุด</td>
                        <td>
                            <input class="form-control" id="txtProcedureFinishedTime" type="text"
                                   data-type="time" style="width: 100px;" placeholder="hh:mm"/></td>
                    </tr>
                    <tr>
                        <td>ราคา</td>
                        <td colspan="3">
                            <input type="text" class="form-control" id="txtProcedurePrice"
                                   data-type="number" style="width: 100px;" placeholder="00.00"/></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnProcedureSave">
                    <i class="fa fa-save"></i> บันทึกรายการ
                </button>
                <button class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-power-off"></i> ปิดหน้าต่าง
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalProcedureDental">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-search"></i> บันทึกข้อมูลการทำหัตถการทันตกรรม</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>กิจกรรม</th>
                        <th colspan="3">การให้บริการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>ผู้ทำหัตถการ</td>
                        <td colspan="3">
                            <select class="form-control" id="slProcedureDentalProvider">
                                <option value="">เลือกผู้ทำหัตถการ</option>
                                @foreach ($providers as $p)
                                <option value="{{ $p->id }}">{{ $p->fname }} {{ $p->lname }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>หัตถการ</td>
                        <td colspan="3">
                            <input type="hidden" id="txtProcedureDentalQuery" class="form-control" placeholder="พิมพ์ชื่อหัตถการ"/>
                        </td>
                    </tr>
                    <tr>
                        <td>รหัสซี่ฟัน</td>
                        <td>
                            <input class="form-control" id="txtProcedureDentalTCode" type="text"
                                   placeholder="#0"/>
                        </td>
                        <td>จำนวนซี่</td>
                        <td>
                            <input class="form-control" id="txtProcedureDentalTCount" type="text"
                                   data-type="number" style="width: 100px;" placeholder="0"/>
                        </td>
                    </tr>
                    <tr>
                        <td>จำนวนราก</td>
                        <td>
                            <input type="text" class="form-control" id="txtProcedureDentalRCount"
                                   placeholder="0" style="width: 100px;"/>
                        </td>
                        <td>จำนวนด้าน</td>
                        <td>
                            <input type="text" class="form-control" id="txtProcedureDentalDCount"
                                   placeholder="0" style="width: 100px;"/>
                        </td>
                    </tr>
                    <tr>
                        <td>ราคา</td>
                        <td colspan="3">
                            <input type="text" class="form-control" id="txtProcedureDentalPrice"
                                   data-type="number" style="width: 100px;" placeholder="00.00"/></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnProcedureDentalSave">
                    <i class="fa fa-save"></i> บันทึกรายการ
                </button>
                <button class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-power-off"></i> ปิดหน้าต่าง
                </button>
            </div>
        </div>
    </div>
</div>