<input type="hidden" id="txtIncomeId"/>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-ambulance"></i> ค่าใช้จ่ายในการให้บริการ</h4>
    </div>
    <div class="panel-body">
        บันทึกข้อมูลค่าใช้จ่ายต่างๆ ที่เกิดขึ้นในการให้บริการในครั้งนี้
    </div>
    <table class="table table-bordered" id="tblIncomeList">
        <thead>
        <tr>
            <th>#</th>
            <th>ค่าใช้จ่าย</th>
            <th>หน่วย</th>
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

    <div class="hidden" id="divNewIncome">
        <table class="table bordered">
            <thead>
            <tr>
                <th>ค่าใช้จ่าย/ค่าบริการ</th>
                <th>ราคา</th>
                <th>จำนวน</th>
                <th>#</th>
            </tr>
            <tr>
                <td width="70%">
                    <input id="txtIncomeQuery" class="form-control" type="hidden" placeholder="พิมพ์ชื่อรายการค่าใช้จ่าย"/>
                </td>
                <td>
                    <input id="txtIncomePrice" type="text" class="form-control" data-type="number"/>
                </td>
                <td>
                    <input id="txtIncomeQty" class="form-control" type="text" data-type="number" value="1"/>
                </td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary" id="btnDoSaveIncome"><i class="fa fa-save"></i></a>
                </td>
            </tr>
            </thead>
        </table>
    </div>
    <div class="panel-footer">
        <button class="btn btn-primary" id="btnNewIncome">
            <i class="fa fa-plus"></i> เพิ่ม/ซ่อน
        </button>
    </div>
</div>
