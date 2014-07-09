<input type="hidden" id="txtAncId" value="{{ isset($anc->id) ? $anc->id : null }}">
<div class="panel-group" id="ancAccordion">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#collapseAncService" data-toggle="collapse" data-parent="ancAccordion">
                    <i class="fa fa-edit"></i>
                    ข้อมูลการให้บริการฝากครรภ์
                    <i class="fa fa-chevron-circle-down pull-right"></i>
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse in" id="collapseAncService">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group">
                            <label for="">อายุครรภ์ (สัปดาห์)</label>
                            {{
                            Form::text('txtAncGa',
                                isset($anc->ga) ? $anc->ga : null,
                                ['id'=> 'txtAncGa', 'class' => 'form-control', 'data-type' => 'number'])
                            }}
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <label for="">ครรภ์ที่</label>
                        {{ Form::select('slAncGravida', $gravidas, isset($anc->gravida) ? $anc->gravida : null, ['id' => 'slAncGravida', 'class' => 'form-control']) }}
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <label for="">ผลตรวจ</label>
                        {{
                            Form::select('slAncResult', ['1' => 'ปกติ', '2' => 'ผิดปกติ'], isset($anc->anc_result) ? $anc->anc_result : null, ['id' => 'slAncResult', 'class' => 'form-control'])
                        }}
                    </div>
                </div> <!-- /row -->
                <!-- screening -->
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <legend>การคัดกรอง</legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <label for="">ระดับมดลูก</label>
                                {{ Form::select('slAncUterusLevel', $uterus, isset($anc->uterus_level_id) ? $anc->uterus_level_id : null, ['id' => 'slAncUterusLevel', 'class' => 'form-control']) }}
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">ท่าเด็ก</label>
                                    {{ Form::select('slAncBabyPosition', $positions, isset($anc->baby_position_id) ? $anc->baby_position_id : null, ['id' => 'slAncBabyPosition', 'class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">ส่วนนำ/การลง</label>
                                    {{ Form::select('slAncBabyLeads', $leads, isset($anc->baby_lead_id) ? $anc->baby_lead_id : null, ['id' => 'slAncBabyLeads', 'class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">เสียงหัวใจเด็ก</label>
                                    {{ Form::text('txtAncBabyHeartSound', isset($anc->baby_heart_sound) ? $anc->baby_heart_sound : null, ['id' => 'txtAncBabyHeartSound', 'class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <legend>อาการสำคัญ</legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncHeadache', null, isset($anc->is_headache) ? $anc->is_headache : null, ['id' => 'chkAncHeadache'] ) }} ปวดศีรษะ
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncSwollen', null, isset($anc->is_swollen) ? $anc->is_swollen : null, ['id' => 'chkAncSwollen'] ) }} บวม
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncSick', null, isset($anc->is_sick) ? $anc->is_sick : null, ['id' => 'chkAncSick'] ) }} คลื่นไส้
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncBloodshed', null, isset($anc->is_bloodshed) ? $anc->is_bloodshed : null, ['id' => 'chkAncBloodshed'] ) }} เลือดออกทางช่องคลอด
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncThyroid', null, isset($anc->is_thyroid) ? $anc->is_thyroid : null, ['id' => 'chkAncThyroid'] ) }} ต่อมไทรอยด์โต
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncCramp', null, isset($anc->is_cramp) ? $anc->is_cramp : null, ['id' => 'chkAncCramp'] ) }} ตะคริว
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncBabyFlex', null, isset($anc->is_baby_flex) ? $anc->is_baby_flex : null, ['id' => 'chkAncBabyFlex'] ) }} เด็กดิ้น
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncUrine', null, isset($anc->is_urine) ? $anc->is_urine : null, ['id' => 'chkAncUrine'] ) }} ระบบทางเดินปัสสาวะ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncLeucorrhoea', null, isset($anc->is_leucorrhoea) ? $anc->is_leucorrhoea : null, ['id' => 'chkAncLeucorrhoea']) }} ตกขาว
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="checkbox-inline">
                                    <label>
                                        {{ Form::checkbox('chkAncHeartDisease', null, isset($anc->is_heart_disease) ? $anc->is_heart_disease : null, ['id' => 'chkAncHeartDisease']) }} โรคหัวใจ
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /screening -->
            </div>
        </div>
        <div class="panel-footer">
            <button class="btn btn-primary" id="btnAncSaveScreen">
                <i class="fa fa-save"></i> บันทึก
            </button>
            <small class="text-muted">คลิกที่ title bar เพื่อย่อ-ขยาย</small>
        </div>
    </div> <!-- panel anc -->

    <!-- Vaccine -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#collapseAncVaccine" data-toggle="collapse" data-parent="ancAccordion">
                    <i class="fa fa-edit"></i>
                    การให้วัคซีน
                    <i class="fa fa-chevron-circle-down pull-right"></i>
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse in" id="collapseAncVaccine">
            <table class="table table-striped" id="tblAncVaccines">
                <thead>
                    <tr>
                        <th>ชื่อวัคซีน</th>
                        <th>LOT.</th>
                        <th>วันหมดอายุ</th>
                        <th>เจ้าหน้าที่</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anc_vaccines as $a)
                    <tr>
                        <td>[{{ $a->name }}] {{ $a->th_name }}</td>
                        <td class="text-center">{{ $a->lot }}</td>
                        <td class="text-center">{{ Helpers::fromMySQLToThaiDate($a->expire_date) }}</td>
                        <td>{{ $a->fname }} {{ $a->lname }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-danger" data-name="btnAncRemoveVaccine" data-id="{{ $a->id }}">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <table class="table table-striped hidden" id="tblAncNewVaccine">
                <tbody>
                    <tr>
                        <td>
                            <select id="slAncAddVaccines" class="form-control">
                                <option value="">** กรุณาเลือกวัคซีน **</option>
                                @foreach($vaccines as $v)
                                <option value="{{ $v->id }}">[{{ $v->name }}] {{ $v->th_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" id="slAncLots"></select>
                        </td>
                        <td>
                            <input type="text" id="txtAncAddExpireDate" class="form-control" readonly="" style="background-color: white;">
                        </td>
                        <td>
                            {{ Form::select('slAncAddProviders', $providers, null, ['id' => 'slAncAddProviders', 'class' => 'form-control']) }}
                        </td>
                        <td>
                            <a href="#" class="btn btn-success" id="btnDoSaveVaccine"><i class="fa fa-save"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <button class="btn btn-primary" id="btnAncAddVaccine">
                <i class="fa fa-plus-circle"></i> เพิ่มรายการ/ซ่อน
            </button>
            <small class="text-muted">คลิกที่ title bar เพื่อย่อ-ขยาย</small>
        </div>
    </div> <!-- panel vaccine -->
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
                    <th>ครรภ์ที่</th>
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
                    <td class="text-center">{{ $a->gravida }}</td>
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
