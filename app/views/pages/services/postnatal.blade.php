<input id="txtPostnatalId" type="hidden" value="{{ $postnatal->id or null}}"/>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-plus-circle"></i>
            บันทึกการให้บริการหลังคลอด
        </h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="slPostnatalGravida">ครรภ์ที่</label>
                {{ Form::select('slPostnatalGravida', $gravidas, isset($postnatal->gravida) ? $postnatal->gravida : null, ['id' => 'slPostnatalGravida', 'class' => 'form-control']) }}
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="slPostnatalServicePlace">สถานที่ตรวจ</label>
                <select class="form-control" id="slPostnatalServicePlace">
                    <option value="1" {{ isset($postnatal->service_place) ? $postnatal->service_place == '1' ? 'selected="selected"' : '' : '' }}>สถานีอนามัย</option>
                    <option value="2" {{ isset($postnatal->service_place) ? $postnatal->service_place == '2' ? 'selected="selected"' : '' : '' }}>ที่บ้าน</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="slPostnatalResult">ผลตรวจ</label>
                <select class="form-control" id="slPostnatalResult">
                    <option value="1" {{ isset($postnatal->result) ? $postnatal->result == '1' ? 'selected="selected"' : '' : '' }}>ปกติ</option>
                    <option value="2" {{ isset($postnatal->result) ? $postnatal->result == '2' ? 'selected="selected"' : '' : '' }}>ผิดปกติ</option>
                    <option value="9" {{ isset($postnatal->result) ? $postnatal->result == '9' ? 'selected="selected"' : '' : '' }}>ไม่ทราบ</option>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="slPostnatalGravida">ระดับมดลูก</label>
                <select class="form-control" id="slPostnatalUterusLevel">
                    <option value="1" {{ isset($postnatal->uterus_level) ? $postnatal->uterus_level == '1' ? 'selected="selected"' : '' : '' }}>ปกติ</option>
                    <option value="2" {{ isset($postnatal->uterus_level) ? $postnatal->uterus_level == '2' ? 'selected="selected"' : '' : '' }}>ผิดปกติ</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="slPostnatalAmnioticFluid">น้ำคาวปลา</label>
                <select class="form-control" id="slPostnatalAmnioticFluid">
                    <option value="1" {{ isset($postnatal->amniotic_fluid) ? $postnatal->amniotic_fluid == '1' ? 'selected="selected"' : '' : '' }}>ปกติ</option>
                    <option value="2" {{ isset($postnatal->amniotic_fluid) ? $postnatal->amniotic_fluid == '2' ? 'selected="selected"' : '' : '' }}>ผิดปกติ</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="slPostnatalTits">หัวนม</label>
                <select class="form-control" id="slPostnatalTits">
                    <option value="1" {{ isset($postnatal->tits) ? $postnatal->tits == '1' ? 'selected="selected"' : '' : '' }}>ปกติ</option>
                    <option value="2" {{ isset($postnatal->tits) ? $postnatal->tits == '2' ? 'selected="selected"' : '' : '' }}>ผิดปกติ</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="slPostnatalAlbumin">Albumin</label>
                <select class="form-control" id="slPostnatalAlbumin">
                    <option value="1" {{ isset($postnatal->albumin) ? $postnatal->albumin == '1' ? 'selected="selected"' : '' : '' }}>ปกติ</option>
                    <option value="2" {{ isset($postnatal->albumin) ? $postnatal->albumin == '2' ? 'selected="selected"' : '' : '' }}>+1</option>
                    <option value="3" {{ isset($postnatal->albumin) ? $postnatal->albumin == '3' ? 'selected="selected"' : '' : '' }}>+2</option>
                    <option value="4" {{ isset($postnatal->albumin) ? $postnatal->albumin == '4' ? 'selected="selected"' : '' : '' }}>Trace</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="slPostnatalSugar">Sugar</label>
                <select class="form-control" id="slPostnatalSugar">
                    <option value="1" {{ isset($postnatal->sugar) ? $postnatal->sugar == '1' ? 'selected="selected"' : '' : '' }}>ปกติ</option>
                    <option value="2" {{ isset($postnatal->sugar) ? $postnatal->sugar == '2' ? 'selected="selected"' : '' : '' }}>ผิดปกติ</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="slPostnatalPerineal">ฝีเย็บ</label>
                <select class="form-control" id="slPostnatalPerineal">
                    <option value="1" {{ isset($postnatal->perineal) ? $postnatal->perineal == '1' ? 'selected="selected"' : '' : '' }}>ปกติ</option>
                    <option value="2" {{ isset($postnatal->perineal) ? $postnatal->perineal == '2' ? 'selected="selected"' : '' : '' }}>ผิดปกติ</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-lg-9">
                <label for="txtPostnatalAdvice">การรักษาพยาบาล/การให้คำแนะนำ</label>
                <textarea class="form-control" id="txtPostnatalAdvice" rows="3">{{{ isset($postnatal->advice) ? $postnatal->advice : '' }}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-lg-9">
                <label for="slPostnatalProviders">ผู้ให้บริการ</label>
                {{ Form::select('slPostnatalProviders', $providers, isset($postnatal->provider_id) ? $postnatal->provider_id : null, ['id' => 'slPostnatalProviders', 'class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button class="btn btn-primary" id="btnPostnatalDoSave">
            <i class="fa fa-save"></i>
            บันทึกข้อมูล
        </button>
        <button class="btn btn-danger" id="btnPostnatalDoRemove">
            <i class="fa fa-trash-o"></i>
            ลบรายการเยี่ยม
        </button>
    </div>
</div>
<!-- history -->
<div class="panel-group" id="accordionPostnatal">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#accordionPostnatalHistory" data-toggle="collapse" data-parent="accordionPostnatal">
                    <i class="fa fa-th-list"></i>
                    ประวัติการรับบริการตรวจหลังคลอด <span class="badge">{{ count($services) }}</span>
                    <i class="fa fa-chevron-circle-up pull-right"></i>
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse" id="accordionPostnatalHistory">
            <table class="table table-striped" id="tblPregnanciesList">
                <thead>
                <tr>
                    <th>วันที่</th>
                    <th>ประเภทสถานที่</th>
                    <th>ครรภ์ที่</th>
                    <th>ผลตรวจ</th>
                    <th>ผู้ให้บริการ</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($services as $s)
                <tr>
                    <td class="text-center">{{ Helpers::fromMySQLToThaiDate($s->service_date) }}</td>
                    <td>{{ $s->service_place == '1' ? 'ในสถานบริการ' : 'ที่บ้าน' }}</td>
                    <td class="text-center">{{ $s->gravida }}</td>
                    <td class="text-center">
                        @if ($s->result == '1')
                        ปกติ
                        @elseif ($s->result == '2')
                        ผิดปกติ
                        @else
                        ไม่ทราบ
                        @endif
                    </td>
                    <td>{{ $s->fname }} {{ $s->lname }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <small class="text-mute">คลิก Title bar เพื่อแสดงรายการ</small>
        </div>
    </div>
</div>

