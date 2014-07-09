<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-edit"></i>
            ประวัติการรับบริการฝากครรภ์
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
<!--            <th>ครรภ์ที่</th>-->
            <th>อายุครรภ์ (สัปดาห์)</th>
            <th>ผลตรวจ</th>
            <th>ผู้ให้บริการ</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $s)
        <tr>
            <td class="text-center">{{ Helpers::fromMySQLToThaiDate($s->service_date) }}</td>
<!--            <td class="text-center">{{ $s->gravida }}</td>-->
            <td class="text-center">{{ $s->ga }}</td>
            <td class="text-center">{{ $s->anc_result == '1' ? 'ปกติ' : 'ผิดปกติ' }}</td>
            <td>{{ $s->fname }} {{ $s->lname }}</td>
            <td>
                <button class="btn btn-default btn-sm" rel="tooltip" title="ดูข้อมูลการฝากครรภ์">
                    <i class="fa fa-edit"></i>
                </button>
            </td>
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
            ประวัติการรับบริการฝากครรภ์ในกรณีฝากครรภ์ที่อื่น (บันทึกความครอบคลุม)
            <i class="fa fa-question-circle pull-right"></i>
        </h4>
    </div>
    <div class="panel-body">
            <span class="text-muted">
                ประวัติการรับบริการ ในกรณีที่เป็นการบันทึกความครอบคลุม
            </span>
    </div>
    <table class="table table-striped" id="tblAncCoverages">
        <thead>
        <tr>
            <th>วันที่</th>
<!--            <th>ครรภ์ที่</th>-->
            <th>อายุครรภ์ (สัปดาห์)</th>
            <th>ผลตรวจ</th>
            <th>สถานที่ตรวจ</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        @foreach($coverages as $c)
        <tr>
            <td class="text-center">{{ Helpers::fromMySQLToThaiDate($c->service_date) }}</td>
<!--            <td class="text-center">{{ $c->gravida }}</td>-->
            <td class="text-center">{{ $c->ga }}</td>
            <td class="text-center">{{ $c->anc_result == '1' ? 'ปกติ' : 'ผิดปกติ' }}</td>
            <td>[{{ $c->hmain }}] {{ $c->hname }}</td>
            <td class="text-center">
                <a href="#" class="btn btn-danger btn-sm" data-name="btnAncCoverageRemove" data-id="{{ $c->id }}">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="panel-footer">
        <button class="btn btn-success" type="button" id="btnShowAncOther">
            <span class="fa fa-plus-circle"></span> บันทึกความครอบคลุม
        </button>
        <small class="text-muted">การเพิ่มให้บันทึกผ่านหน้าให้บริการหลัก (ยกเว้นความครอบคลุม)</small>
    </div>
</div>

<div class="panel-group" id="accordionAncOther">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#collapseAncOtherService" data-toggle="collapse" data-parent="accordionAncOther">
                    <i class="fa fa-edit"></i>
                    ประวัติการรับบริการฝากครรภ์ (ทุกหน่วยบริการ) <span class="badge">{{ count($all_services) }}</span>
                    <i class="fa fa-chevron-circle-down pull-right"></i>
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse" id="collapseAncOtherService">
<!--            <div class="panel-body">-->
<!--                <span class="text-muted">-->
<!--                    ประวัติการรับบริการ ในกรณีที่ไปรับบริการนอกเขต-->
<!--                </span>-->
<!--            </div>-->
            <table class="table table-striped" id="tblPregnanciesOtherList">
                <thead>
                <tr>
                    <th>วันที่</th>
<!--                    <th>ครรภ์ที่</th>-->
                    <th>อายุครรภ์ (สัปดาห์)</th>
                    <th>ผลตรวจ</th>
                    <th>หน่วยบริการ</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($all_services as $a)
                <tr>
                    <td class="text-center">{{ Helpers::fromMySQLToThaiDate($a->service_date) }}</td>
<!--                    <td class="text-center">{{ $a->gravida }}</td>-->
                    <td class="text-center">{{ $a->ga }}</td>
                    <td class="text-center">{{ $a->anc_result == '1' ? 'ปกติ' : 'ผิดปกติ' }}</td>
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
<div class="modal fade" id="modalAncOther" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <label for="txtAncCoverDate">วันที่รับบริการ</label>
                            <div data-type="date-picker" class="input-group date col-sm-12">
                                <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtAncCoverDate"
                                       value="{{ Helpers::getCurrentDate() }}">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="">อายุครรภ์ (สัปดาห์)</label>
                                <input class="form-control" id="txtAncCoverGa" type="text" data-type="number"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <label for="">ผลการตรวจ</label>
                            <select id="slAncCoverResult" class="form-control">
                                <option value="1">ปกติ</option>
                                <option value="2">ผิดปกติ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <label for="txtAncCoverPlace">สถานพยาบาลที่ให้บริการ</label>
                            <input class="form-control" type="hidden" id="txtAncCoverPlace" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnAncCoverSave">
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