<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <span class="fa fa-edit"></span>
            รายชื่อทะเบียนเด็กแรกเกิด (0-11 เดือน)
            <i class="fa fa-question-circle pull-right"></i>
        </h4>
    </div>
    <div class="panel-body">
        <span class="text-muted">
            ทะเบียนเด็กหลังคลอด การให้บริการเยี่ยมหลังคลอด และการให้วัคซีน ข้อมูลนี้ควรจะมีเฉพาะ Type 1 และ 3 เท่านั้น แต่ถ้าเป็น Type 4 และ 2 ไม่ต้องทำการบังคับส่งออก
        </span>
    </div>
    <table class="table table-striped" id="tblBabiesList">
        <thead>
        <tr>
            <th>#</th>
            <th>เลขบัตรประชาชน</th>
            <th>ชื่อ-สกุล</th>
            <th class="visible-lg visible-md">อายุ (ป-ด-ว)</th>
            <th>ครรภ์ที่</th>
            <th>% หลังคลอด</th>
            <th>% วัคซีน</th>
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
        <button class="btn btn-primary" type="button" id="btnShowSearchPerson">
            <span class="fa fa-plus"></span> ลงทะเบียน
        </button>
        <button class="btn btn-primary" type="button" disabled>
            <span class="fa fa-file-excel-o"></span> ส่งออกรายชื่อ
        </button>
    </div>
</div>

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
