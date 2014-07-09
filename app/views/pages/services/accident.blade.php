<input type="hidden" id="txtAccidentId" value="{{ !empty($accident->id) ? $accident->id : '' }}"/>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-ambulance"></i> บันทึกข้อมูลอุบัติเหตุจราจร</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="txtAccidentDate">วันที่เกิดอุบัติเหตุ</label>
                <div data-type="date-picker" class="input-group date col-sm-12">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtAccidentDate"
                           value="{{ !empty($accident->accident_date) ? Helpers::toJSDate($accident->accident_date) :
                           !empty($accident->service_date) ? Helpers::toJSDate($accident->service_date) : Helpers::getCurrentDate() }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-2 col-lg-2">
                <label for="txtAccidentTime">เวลา</label>
                <input id="txtAccidentTime" type="text" class="form-control" data-type="time"
                    value="{{ $accident->accident_time or '' }}"/>
            </div>
            <div class="col-md-4 col-lg-4">
                <label for="">ประเภทอุบัติเหตุ</label>
                <select class="form-control" id="slAccidentType">
                    <option value="">-*-</option>
                    @foreach ($type as $t)
                    @if (!empty($accident->accident_type_id))
                        @if ($accident->accident_type_id == $t->id)
                        <option value="{{ $t->id }}" selected="selected">[{{ $t->export_code }}] {{ $t->th_name }}</option>
                        @else
                        <option value="{{ $t->id }}">[{{ $t->export_code }}] {{ $t->th_name }}</option>
                        @endif
                    @else
                    <option value="{{ $t->id }}">[{{ $t->export_code }}] {{ $t->th_name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="">ความเร่งด่วน</label>
                <select class="form-control" id="slAccidentUrgency">
                    <option value="6" {{ !empty($accident->urgency) ? $accident->urgency == '6' ? 'selected="selected"' : '' : '' }}>[6] ไม่แน่ใจ</option>
                    <option value="1" {{ !empty($accident->urgency) ? $accident->urgency == '1' ? 'selected="selected"' : '' : '' }}>[1] Life threatening</option>
                    <option value="2" {{ !empty($accident->urgency) ? $accident->urgency == '2' ? 'selected="selected"' : '' : '' }}>[2] Emergency</option>
                    <option value="3" {{ !empty($accident->urgency) ? $accident->urgency == '3' ? 'selected="selected"' : '' : '' }}>[3] Urgent</option>
                    <option value="4" {{ !empty($accident->urgency) ? $accident->urgency == '4' ? 'selected="selected"' : '' : '' }}>[4] Acute</option>
                    <option value="5" {{ !empty($accident->urgency) ? $accident->urgency == '5' ? 'selected="selected"' : '' : '' }}>[5] Non acute</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 col-lg-5">
                <label for="">สถานที่เกิดอุบัติเหตุ</label>
                <select class="form-control" id="slAccidentPlace">
                    <option value="">-*-</option>
                    @foreach ($place as $p)
                    @if (!empty($accident->accident_place_id))
                    @if ($accident->accident_type_id == $p->id)
                    <option value="{{ $p->id }}" selected="selected">[{{ $p->export_code }}] {{ $p->name }}</option>
                    @else
                    <option value="{{ $p->id }}">[{{ $p->export_code }}] {{ $p->name }}</option>
                    @endif
                    @else
                    <option value="{{ $p->id }}">[{{ $p->export_code }}] {{ $p->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 col-lg-4">
                <label for="">ประเภทการมารับบริการ</label>
                <select class="form-control" id="slAccidentTypeIn">
                    <option value="">-*-</option>
                    @foreach ($typein as $ti)
                    @if (!empty($accident->accident_type_in_id))
                        @if ($accident->accident_type_in_id == $ti->id)
                        <option value="{{ $ti->id }}" selected="selected">[{{ $ti->export_code }}] {{ $ti->name }}</option>
                        @else
                        <option value="{{ $ti->id }}">[{{ $ti->export_code }}] {{ $ti->name }}</option>
                        @endif
                    @else
                    <option value="{{ $ti->id }}">[{{ $ti->export_code }}] {{ $ti->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="">ประเภทผู้บาดเจ็บ</label>
                <select class="form-control" id="slAccidentTraffic">
                    <option value="9" {{ !empty($accident->traffic) ? $accident->traffic == '9' ? 'selected="selected"' : ''  : '' }}>[9] ไม่ทราบ</option>
                    <option value="1" {{ !empty($accident->traffic) ? $accident->traffic == '1' ? 'selected="selected"' : ''  : ''}}>[1] ผู้ขับขี่</option>
                    <option value="2" {{ !empty($accident->traffic) ? $accident->traffic == '2' ? 'selected="selected"' : ''  : ''}}>[2] ผู้โดยสาร</option>
                    <option value="3" {{ !empty($accident->traffic) ? $accident->traffic == '3' ? 'selected="selected"' : ''  : ''}}>[3] คนเดินเท้า</option>
                    <option value="8" {{ !empty($accident->traffic) ? $accident->traffic == '8' ? 'selected="selected"' : ''  : ''}}>[8] อื่นๆ</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <label for="">ประเภทยานพาหนะ</label>
                <select class="form-control" id="slAccidentVehicle">
                    <option value="">-*-</option>
                    @foreach ($vehicle as $v)
                    @if (!empty($accident->accident_vehicle_id))
                        @if ($accident->accident_vehicle_id == $v->id)
                        <option value="{{ $v->id }}" selected="selected">[{{ $v->export_code }}] {{ $v->name }}</option>
                        @else
                        <option value="{{ $v->id }}">[{{ $v->export_code }}] {{ $v->name }}</option>
                        @endif
                    @else
                    <option value="{{ $v->id }}">[{{ $v->export_code }}] {{ $v->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-lg-2">
                <label for="">ดื่มแอลกอฮอลล์</label>
                <select class="form-control" id="slAccidentAlcohol">
                    <option value="9" {{ !empty($accident->alcohol) ? $accident->alcohol == '9' ? 'selected="selected"' : ''  : ''}}>ไม่ทราบ</option>
                    <option value="2" {{ !empty($accident->alcohol) ? $accident->alcohol == '2' ? 'selected="selected"' : ''  : ''}}>ไม่ดื่ม</option>
                    <option value="1" {{ !empty($accident->alcohol) ? $accident->alcohol == '1' ? 'selected="selected"' : ''  : ''}}>ดื่ม</option>
                </select>
            </div>
            <div class="col-md-2 col-lg-2">
                <label for="">ใช้สารเสพติด</label>
                <select class="form-control" id="slAccidentNacroticDrug">
                    <option value="9" {{ !empty($accident->nacrotic_drug) ? $accident->nacrotic_drug == '9' ? 'selected="selected"' : ''  : ''}}>ไม่ทราบ</option>
                    <option value="2" {{ !empty($accident->nacrotic_drug) ? $accident->nacrotic_drug == '2' ? 'selected="selected"' : ''  : ''}}>ไม่ใช้</option>
                    <option value="1" {{ !empty($accident->nacrotic_drug) ? $accident->nacrotic_drug == '1' ? 'selected="selected"' : ''  : ''}}>ใช้</option>
                </select>
            </div>
            <div class="col-md-2 col-lg-2">
                <label for="">คาดเข็มขัด</label>
                <select class="form-control" id="slAccidentBelt">
                    <option value="9" {{ !empty($accident->belt) ? $accident->belt == '9' ? 'selected="selected"' : ''  : ''}}>ไม่ทราบ</option>
                    <option value="2" {{ !empty($accident->belt) ? $accident->belt == '2' ? 'selected="selected"' : ''  : ''}}>ไม่คาด</option>
                    <option value="1" {{ !empty($accident->belt) ? $accident->belt == '1' ? 'selected="selected"' : ''  : ''}}>คาด</option>
                </select>
            </div>
            <div class="col-md-2 col-lg-2">
                <label for="">สวมหมวก</label>
                <select class="form-control" id="slAccidentHelmet">
                    <option value="9" {{ !empty($accident->helmet) ? $accident->helmet == '9' ? 'selected="selected"' : ''  : ''}}>ไม่ทราบ</option>
                    <option value="2" {{ !empty($accident->helmet) ? $accident->helmet == '2' ? 'selected="selected"' : ''  : ''}}>ไม่สวม</option>
                    <option value="1" {{ !empty($accident->helmet) ? $accident->helmet == '1' ? 'selected="selected"' : ''  : ''}}>สวม</option>
                </select>
            </div>
        </div>
        <br/>
        <legend>การให้การรักษาเบื้องต้น</legend>
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="">การดูแลการหายใจ</label>
                <select class="form-control" id="slAccidentAirway">
                    <option value="3" {{ !empty($accident->airway) ? $accident->airway == '3' ? 'selected="selected"' : ''  : ''}}>ไม่จำเป็น</option>
                    <option value="1" {{ !empty($accident->airway) ? $accident->airway == '1' ? 'selected="selected"' : ''  : ''}}>มีการดูแลการหายใจ</option>
                    <option value="2" {{ !empty($accident->airway) ? $accident->airway == '2' ? 'selected="selected"' : ''  : ''}}>ไม่มีการดูแลการหายใจ</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="">การห้ามเลือด</label>
                <select class="form-control" id="slAccidentStopBleed">
                    <option value="3" {{ !empty($accident->stop_bleed) ? $accident->stop_bleed == '3' ? 'selected="selected"' : ''  : ''}}>ไม่จำเป็น</option>
                    <option value="1" {{ !empty($accident->stop_bleed) ? $accident->stop_bleed == '1' ? 'selected="selected"' : ''  : ''}}>มีการห้ามเลือด</option>
                    <option value="2" {{ !empty($accident->stop_bleed) ? $accident->stop_bleed == '2' ? 'selected="selected"' : ''  : ''}}>ไม่มีการห้ามเลือด</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="">การใส่ splint/slab</label>
                <select class="form-control" id="slAccidentSplint">
                    <option value="3" {{ !empty($accident->splint) ? $accident->splint == '3' ? 'selected="selected"' : ''  : ''}}>ไม่จำเป็น</option>
                    <option value="1" {{ !empty($accident->splint) ? $accident->splint == '1' ? 'selected="selected"' : ''  : ''}}>มีการใส่ splint/slab</option>
                    <option value="2" {{ !empty($accident->splint) ? $accident->splint == '2' ? 'selected="selected"' : ''  : ''}}>ไม่มีการใส่ splint/slab</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="">การให้น้ำเกลือ</label>
                <select class="form-control" id="slAccidentFluid">
                    <option value="3" {{ !empty($accident->fluid) ? $accident->fluid == '3' ? 'selected="selected"' : ''  : ''}}>ไม่จำเป็น</option>
                    <option value="1" {{ !empty($accident->fluid) ? $accident->fluid == '1' ? 'selected="selected"' : ''  : ''}}>มีการให้น้ำเกลือ</option>
                    <option value="2" {{ !empty($accident->fluid) ? $accident->fluid == '2' ? 'selected="selected"' : ''  : ''}}>ไม่มีการให้น้ำเกลือ</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="">ความรู้สึกทางด้านตา</label>
                <input class="form-control" type="text" id="txtAccidentComaEye"
                    value="{{ !empty($accident->coma_eye) ? $accident->coma_eye : '' }}" data-type="number"/>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="">ความรู้สึกทางด้านการพูด</label>
                <input class="form-control" type="text" id="txtAccidentComaSpeak"
                       value="{{ !empty($accident->coma_speak) ? $accident->coma_speak : '' }}" data-type="number"/>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="">ความรู้สึกทางด้านการเคลื่อนไหว</label>
                <input class="form-control" type="text" id="txtAccidentComaMovement"
                       value="{{ !empty($accident->coma_movement) ? $accident->coma_movement : '' }}" data-type="number"/>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button class="btn btn-primary" id="btnAccidentSave">
            <i class="fa fa-save"></i> บันทึกรายการ
        </button>
        <button class="btn btn-danger" id="btnAccidentRemove">
            <i class="fa fa-trash-o"></i> ลบรายการ
        </button>
    </div>
</div>
