<input type="hidden" id="txtDrugId"/>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-ambulance"></i> ระบบจ่ายยา</h4>
    </div>
    <div class="panel-body">
        บันทึกข้อมูลการจ่ายยา และวิธีการใช้ยา สำหรับวิธีการใช้ยาให้ใช้สูตรในการใช้ยา
    </div>
    <table class="table table-bordered" id="tblDrugList">
        <thead>
        <tr>
            <th>#</th>
            <th>ชื่อยา</th>
            <th>วิธีการใช้</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>รวม</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="7">...</td>
        </tr>
        </tbody>
    </table>

    <div class="hidden" id="divNewDrug">
        <table class="table bordered">
            <thead>
            <tr>
                <th>ชื่อยา</th>
                <th>วิธีการใช้</th>
                <th>ราคา</th>
                <th>จำนวน</th>
                <th>#</th>
            </tr>
            <tr>
                <td width="40%">
                    <input id="txtDrugQuery" class="form-control" type="hidden" placeholder="พิมพ์ชื่อยา"/>
                </td>
                <td width="30%">
                    <input id="txtDrugUsage" type="hidden" class="form-control" data-type="number" placeholder="พิมพ์รหัสการใช้ยา"/>
                </td>
                <td>
                    <input id="txtDrugPrice" class="form-control" type="text" data-type="number" placeholder="0"/>
                </td>
                <td>
                    <input id="txtDrugQty" class="form-control" type="text" data-type="number" placeholder="0"/>
                </td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary" id="btnDoSaveDrug"><i class="fa fa-save"></i></a>
                </td>
            </tr>
            </thead>
        </table>
    </div>
    <div class="panel-footer">
        <button class="btn btn-primary" id="btnDrugNew">
            <i class="fa fa-plus"></i> เพิ่ม/ยกเลิก
        </button>
        <button class="btn btn-primary" id="btnDrugRemed" disabled>
            <i class="fa fa-refresh"></i> Remed
        </button>
        <button class="btn btn-danger" id="btnDrugClear">
            <i class="fa fa-trash-o"></i> ลบใบสั่งยา
        </button>
    </div>
</div>
