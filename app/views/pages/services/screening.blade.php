<input type="hidden" id="txtVSScreenId" value="{{ $screen->id }}"/>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-windows"></i> ข้อมูลการคัดกรองทั่วไป</h4>
    </div>
    <div class="panel-body">
        <div class="well well-sm">
            <div class="row">
                <div class="col-sm-6">
                    <select class="form-control" name="" id="slVSServiceStatus">
                        @foreach($status as $s):
                            @if ($services->service_status_id == $s->id)
                                <option value="{{ $s->id }}" selected="selected">[{{ $s->export_code }}] {{ $s->name }}</option>
                            @else
                                <option value="{{ $s->id }}">[{{ $s->export_code }}] {{ $s->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 col-md-3">
                    <input type="checkbox" id="chkVSLocked" {{ $services->locked == 'Y' ? 'checked="checked"' : '' }} disabled />
                    <label for="chkVSLocked">ป้องกันการแก้ไขโดยคนอื่น</label>
                </div>
                <div class="col-sm-3">
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary" id="btnVSSaveScreen">
                            <i class="fa fa-save"></i> บันทึกคัดกรอง
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <label for="">นำ้หนัก</label>
                <div class="input-group">
                    <input type="text" id="txtVSWeight" value="{{ $screen->weight }}" data-type="number" class="form-control"/>
                    <span class="input-group-addon">กก.</span>
                </div>
            </div>
            <div class="col-sm-2">
                <label for="">ส่วนสูง</label>
                <div class="input-group">
                    <input type="text" id="txtVSHeight" value="{{ $screen->height }}" data-type="number" class="form-control"/>
                    <span class="input-group-addon">ซม.</span>
                </div>
            </div>
            <div class="col-sm-2">
                <label for="">อุณหภูมิ</label>
                <div class="input-group">
                    <input type="text" id="txtVSTemp" value="{{ $screen->body_temp }}" data-type="number" class="form-control"/>
                    <span class="input-group-addon">C.</span>
                </div>
            </div>
            <div class="col-sm-2">
                <label for="">รอบเอว</label>
                <div class="input-group">
                    <input type="text" id="txtVSWaist" value="{{ $screen->waist }}" data-type="number" class="form-control"/>
                    <span class="input-group-addon">C.</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <label for="">ชีพจร</label>
                <div class="input-group">
                    <input type="text" id="txtVSPR" value="{{ $screen->pr }}" data-type="number" class="form-control"/>
                    <span class="input-group-addon">m.</span>
                </div>
            </div>
            <div class="col-sm-2">
                <label for="">การหายใจ</label>
                <div class="input-group">
                    <input type="text" id="txtVSRR" value="{{ $screen->rr }}" data-type="number" class="form-control"/>
                    <span class="input-group-addon">m.</span>
                </div>
            </div>
            <div class="col-sm-2">
                <label for="">ความดัน SBP</label>
                <div class="input-group">
                    <input type="text" id="txtVSSBP" value="{{ $screen->sbp }}" data-type="number" class="form-control"/>
                    <span class="input-group-addon">m.</span>
                </div>
            </div>
            <div class="col-sm-2">
                <label for="">ความดัน DBP</label>
                <div class="input-group">
                    <input type="text" id="txtVSDBP" value="{{ $screen->dbp }}" data-type="number" class="form-control"/>
                    <span class="input-group-addon">m.</span>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tabCC" data-toggle="tab">
                            <i class="fa fa-th-list fa-fw"></i> อาการแรกรับ (CC)
                        </a>
                    </li>
                    <li>
                        <a href="#tabPE" data-toggle="tab">
                            <i class="fa fa-eye-slash fa-fw"></i> การตรวจร่างกาย (PE)
                        </a>
                    </li>
                    <li>
                        <a href="#tabScreenIllHistory" data-toggle="tab">
                            <i class="fa fa-clock-o fa-fw"></i> เจ็บป่วยในอดีต
                        </a>
                    </li>
                    <li>
                        <a href="#tabScreen" data-toggle="tab">
                            <i class="fa fa-list fa-fw"></i> คัดกรอง
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-briefcase"></i> อื่นๆ
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#tabScreenLmp" data-toggle="tab"><i class="fa fa-calendar-o fa-fw"></i> ประจำเดือน (LMP)</a>
                            </li>
                            <li>
                                <a href="#tbScreenConsult" data-toggle="tab"><i class="fa fa-calendar-o fa-fw"></i> การให้คำแนะนำ</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabCC">
                        <blockquote>บันทึกข้อมูลอาการสำคัญ (Chief complaint)</blockquote>
                        <textarea class="form-control" rows="3" id="txtVSCC">{{ $screen->cc }}</textarea>
                    </div>
                    <div class="tab-pane" id="tabPE">
                        <blockquote>บันทึกข้อมูลการตรวจร่างกาย (Physical examination)</blockquote>
                        <textarea class="form-control" rows="3" id="txtVSPE">{{ $screen->pe }}</textarea>
                    </div>
                    <div class="tab-pane" id="tabScreenIllHistory">
                        <blockquote>ประวัติการเจ็บป่วยในอดีต</blockquote>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSIsIllHistory" {{ $screen->ill_history == 'Y' ? 'checked="checked"' : '' }}/>
                                        <label for="chkVSIsIllHistory">มีประวัติการเจ็บป่วยในอดีต</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label for="txtVSIllDetail">ระบุโรคประจำตัว</label>
                                        <input type="text" value="{{ $screen->ill_history_detail }}"
                                               class="form-control" placeholder="ระบุโรคประจำตัว" id="txtVSIllDetail"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSOperateHistory" {{ $screen->operate_history == 'Y' ? 'checked="checked"' : '' }}/>
                                        <label for="chkVSOperateHistory">มีประวัติการผ่าตัด</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <label for="txtVSOperateDetail">ระบุอาการที่ผ่าตัด</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $screen->operate_history_detail }}"
                                                       placeholder="ระบุโรคประจำตัว" id="txtVSOperateDetail"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3">
                                                <label for="txtVSOperateYear">ปีที่ผ่าตัด</label>
                                                <input type="text" class="form-control"
                                                       value="{{ $screen->operate_history_year }}"
                                                       placeholder="yyyy" data-type="year" id="txtVSOperateYear"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="tabScreen">
                        <br/>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <legend><i class="fa fa-rss"></i> ประเมินสุขภาพจิต</legend>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSScreenMindStrain" {{ $screen->mind_strain == 'Y' ? 'checked="checked"' : ''}} />
                                        <label for="chkVSScreenMindStrain">เครียดและวิตกกังวล</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSScreenMindWork" {{ $screen->mind_work == 'Y' ? 'checked="checked"' : ''}} />
                                        <label for="chkVSScreenMindWork">การเงิน/การทำงาน/เพื่อนร่วมงาน</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSScreenMindFamily" {{ $screen->mind_family == 'Y' ? 'checked="checked"' : '' }}/>
                                        <label for="chkVSScreenMindFamily">ปัญหาครอบครัว</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSScreenMindOther" {{ $screen->mind_other == 'Y' ? 'checked="checked"' : '' }}/>
                                        <label for="chkVSScreenMindOther">อื่นๆ (ระบุ)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <textarea class="form-control" id="txtSVScreenMindOtherDetail" rows="3">{{ $screen->mind_other_detail }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <legend><i class="fa fa-warning"></i> ภาวะความเสี่ยง</legend>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSScreenRiskHT" {{ $screen->risk_ht == 'Y' ? 'checked="checked"' : '' }}/>
                                        <label for="chkVSScreenRiskHT">เสี่ยงต่อการเป็นความดันโลหิตสูง</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSScreenRiskDM" {{ $screen->risk_dm == 'Y' ? 'checked="checked"' : '' }}/>
                                        <label for="chkVSScreenRiskDM">เสี่ยงต่อการเป็นเบาหวาน</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSScreenRiskStoke" {{ $screen->risk_stoke == 'Y' ? 'checked="checked"' : '' }}/>
                                        <label for="chkVSScreenRiskStoke">เสี่ยงต่อการเป็นโรคหัวใจ</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="checkbox" id="chkVSScreenRiskOther" {{ $screen->risk_other == 'Y' ? 'checked="checked"' : '' }}/>
                                        <label for="chkVSScreenRiskOther">อื่นๆ</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <textarea class="form-control" id="chkVSScreenRiskDetail" rows="3">{{ $screen->risk_other_detail }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <legend><i class="fa fa-filter"></i> สูบบุหรี่/ดื่มสุรา</legend>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <label for="slVSSmoking">สูบบุหรี่</label>
                                        <select class="form-control" id="slVSSmoking">
                                            <option value="1" {{ $screen->smoking == '1' ? 'selected="selected"' : '' }}>ไม่สูบ</option>
                                            <option value="2" {{ $screen->smoking == '2' ? 'selected="selected"' : '' }}>สูบ</option>
                                            <option value="3" {{ $screen->smoking == '3' ? 'selected="selected"' : '' }}>เคยสูบแต่เลิกแล้ว</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <label for="slVSDrinking">ดื่มสุรา</label>
                                        <select class="form-control" id="slVSDrinking">
                                            <option value="1" {{ $screen->drinking == '1' ? 'selected="selected"' : '' }}>ไม่ดื่ม</option>
                                            <option value="2" {{ $screen->drinking == '2' ? 'selected="selected"' : '' }}>ดื่ม</option>
                                            <option value="3" {{ $screen->drinking == '3' ? 'selected="selected"' : '' }}>เคยดื่มแต่เลิกแล้ว</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabScreenLmp">
                        <blockquote>บันทึกข้อมูลมูลการมีประจำเดือน (LMP)</blockquote>
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <label for="slVSScreenLmp">การมาของประจำเดือน</label>
                                <select class="form-control" id="slVSScreenLmp">
                                    <option value="1" {{ $screen->lmp == '1' ? 'selected="selected"' : '' }}>ประจำเดือนไม่มา</option>
                                    <option value="2" {{ $screen->lmp == '2' ? 'selected="selected"' : '' }}>ประจำเดือนมาปกติ (มีประจำเดือน)</option>
                                </select>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <label>วันที่ประจำเดือนมา</label>
                                <div class="input-group date" data-type="date-picker">
                                    <input type="text" id="txtVSScreenLmpStartDate"
                                           value="{{ Helpers::toJSDate($screen->lmp_start) }}"
                                           class="form-control" placeholder="dd/mm/yyyy"/>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <label>วันที่ประจำเดือนไม่มา</label>
                                <div class="input-group date" data-type="date-picker">
                                    <input type="text" id="txtVSScreenLmpFinishedDate"
                                           value="{{ Helpers::toJSDate($screen->lmp_finished) }}"
                                           class="form-control" placeholder="dd/mm/yyyy"/>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tbScreenConsult">
                        <blockquote>บันทึกข้อมูลการให้คำแนะนำ</blockquote>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <input type="checkbox" id="chkVSScreenConsultDrug" {{ $screen->consult_drug == 'Y' ? 'checked="checked"' : '' }}/>
                                <label for="chkVSScreenConsultDrug">แนะนำการใช้ยา</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <input type="checkbox" id="chkVSScreenConsultActivity" {{ $screen->consult_activity == 'Y' ? 'checked="checked"' : '' }}/>
                                <label for="chkVSScreenConsultActivity">แนะนำตัวการปฏิบัติตัวให้เหมาะสมกับโรค</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <input type="checkbox" id="chkVSScreenConsultAppoint" {{ $screen->consult_appoint == 'Y' ? 'checked="checked"' : '' }}/>
                                <label for="chkVSScreenConsultAppoint">แนะนำการมาตรวจตามนัด</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <input type="checkbox" id="chkVSScreenConsultFood" {{ $screen->consult_food == '1' ? 'checked="checked"' : '' }}/>
                                <label for="chkVSScreenConsultFood">แนะนำการรับประทานอาหาร</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <input type="checkbox" id="chkVSScreenConsultExercise" {{ $screen->consult_exercise == 'Y' ? 'checked="checked"' : '' }}/>
                                <label for="chkVSScreenConsultExercise">แนะนำการออกกำลังกาย</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <input type="checkbox" id="chkVSScreenConsultComplication" {{ $screen->consult_complication == 'Y' ? 'checked="checked"' : '' }}/>
                                <label for="chkVSScreenConsultComplication">แนะนำการป้องกันภาวะแทรกซ้อน</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <input type="checkbox" id="chkVSScreenConsultOther" {{ $screen->consult_other == 'Y' ? 'checked="checked"' : '' }}/>
                                <label for="chkVSScreenConsultOther">แนะนำอื่นๆ (ระบุ)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <textarea class="form-control" id="chkVSScreenConsultOtherDetail" rows="3">
                                    {{ $screen->consult_other_detail }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
