<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-edit"></i>
            ประวัติการรับบริการตรวจหลังคลอด
            <i class="fa fa-question-circle pull-right"></i>
        </h4>
    </div>
    <div class="panel-body">
            <span class="text-muted">
                ประวัติการรับบริการ ในกรณีที่เป็นการบันทึกโดยหน่วยบริการ
            </span>
    </div>
    <table class="table table-striped" id="tblPregnanciesList">
        <thead>
        <tr>
            <th>วันที่</th>
            <th>ประเภทสถานที่</th>
<!--            <th>ครรภ์ที่</th>-->
            <th>ผลตรวจ</th>
            <th>ผู้ตรวจ</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($postnatals as $p)
        <tr>
            <td class="text-center">{{ Helpers::fromMySQLToThaiDate($p->service_date) }}</td>
            <td>{{ $p->service_place == '1' ? 'ในสถานบริการ' : 'ที่บ้าน' }}</td>
<!--            <td class="text-center">{{ $p->gravida }}</td>-->
            <td class="text-center">
                @if ($p->result == '1')
                ปกติ
                @elseif ($p->result == '2')
                ผิดปกติ
                @else
                ไม่ทราบ
                @endif
            </td>
            <td>{{ $p->fname }} {{ $p->lname }}</td>
            <td class="text-center"><a href="#" class="btn btn-sm btn-default" disabled><i class="fa fa-edit"></i></a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="panel-footer">
        <small class="text-muted">การเพิ่มให้บันทึกผ่านหน้าให้บริการหลัก (ยกเว้นความครอบคลุม)</small>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-edit"></i>
            ประวัติการรับบริการตรวจหลังคลอดในกรณีตรวจหลังคลอดที่อื่น
            <i class="fa fa-question-circle pull-right"></i>
        </h4>
    </div>
    <table class="table table-striped" id="tblPostnatalCoverages">
        <thead>
        <tr>
            <th>วันที่</th>
<!--            <th>ครรภ์ที่</th>-->
            <th>ผลตรวจ</th>
            <th>สถานบริการที่ตรวจ</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($coverages as $c)
        <tr>
            <td class="text-center">{{ Helpers::fromMySQLToThaiDate($c->service_date) }}</td>
<!--            <td class="text-center">{{ $c->gravida }}</td>-->
            <td class="text-center">
                @if ($c->result == '1')
                ปกติ
                @elseif ($c->result == '2')
                ผิดปกติ
                @else
                ไม่ทราบ
                @endif
            </td>
            <td>[{{ $c->service_place }}] {{ $c->hname }}</td>
            <td class="text-center"><a href="#" class="btn btn-sm btn-danger" data-name="btnPostnatalCoverageRemove" data-id="{{ $c->id }}"><i class="fa fa-times"></i></a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="panel-footer">
        <button class="btn btn-success" type="button" id="btnShowPostnatalOther">
            <span class="fa fa-plus-circle"></span> บันทึกความครอบคลุม
        </button>
        <small class="text-muted">การเพิ่มให้บันทึกผ่านหน้าให้บริการหลัก (ยกเว้นความครอบคลุม)</small>
    </div>
</div>

<div class="panel-group" id="accordionPostnatalOther">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#collapsePostnatalOtherService" data-toggle="collapse" data-parent="accordionPostnatalOther">
                    <i class="fa fa-edit"></i>
                    ประวัติการรับบริการหลังคลอด (ทุกหน่วยบริการ) <span class="badge">{{ count($postnatal_all) }}</span>
                    <i class="fa fa-chevron-circle-down pull-right"></i>
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse" id="collapsePostnatalOtherService">
            <!--            <div class="panel-body">-->
            <!--                <span class="text-muted">-->
            <!--                    ประวัติการรับบริการ ในกรณีที่ไปรับบริการนอกเขต-->
            <!--                </span>-->
            <!--            </div>-->
            <table class="table table-striped" id="tblPregnanciesOtherList">
                <thead>
                <tr>
                    <th>วันที่</th>
                    <th>ผลตรวจ</th>
                    <th>หน่วยบริการ</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($postnatal_all as $a)
                <tr>
                    <td class="text-center">{{ Helpers::fromMySQLToThaiDate($a->service_date) }}</td>
                    <td class="text-center">
                        @if ($a->result == '1')
                        ปกติ
                        @elseif ($a->result == '2')
                        ผิดปกติ
                        @else
                        ไม่ทราบ
                        @endif
                    </td>
                    <td>[{{ $a->hmain }}] {{ $a->hname }}</td>
                </tr>
                @endforeach
                </tr>
                </tbody>
            </table>
        </div>
        <div class="panel-footer"><small class="text-muted">คลิกที่ title bar เพื่อดูรายการฝากครรภ์ที่อื่น</small></div>
    </div>
</div>

<!-- modal anc other place -->
<div class="modal fade" id="modalPostnatalOther" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">บันทึกความครอบคลุมการฝากครรภ์</h4>
            </div>
            <div class="modal-body">
                <form action="#" role="form">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <label for="txtPostnatalCoverDate">วันที่รับบริการ</label>
                            <div data-type="date-picker" class="input-group date col-sm-12">
                                <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtPostnatalCoverDate">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <label for="slPostnatalCoverResult">ผลการตรวจ</label>
                            <select id="slPostnatalCoverResult" class="form-control">
                                <option value="1">ปกติ</option>
                                <option value="2">ผิดปกติ</option>
                                <option value="9">ไม่ทราบ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label for="txtPostnatalCoverPlace">สถานพยาบาลที่ให้บริการ</label>
                            <input class="form-control" type="hidden" id="txtPostnatalCoverPlace" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnPostnatalCoverSave">
                    <i class="fa fa-save"></i> บันทึกข้อมูล
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times"></i> ปิดหน้าต่าง
                </button>
            </div>
        </div>
    </div>
</div>
<!-- /modal -->