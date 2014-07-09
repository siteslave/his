
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-edit"></i> ข้อมูลการขึ้นทะเบียน [คลิกเพื่อบันทึก/แก้ไข]
            <i class="fa fa-cog pull-right" id="spnDownOther"></i>
        </h4>
    </div>

    <div class="panel-body">
        <legend>ข้อมูลการตั้งครรภ์</legend>
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="txtPregnancyRegisterDate">วันที่ลงทะเบียน</label>
                <div data-type="date-picker" class="input-group date col-sm-12">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control"
                           id="txtPregnancyRegisterDate" value="{{ Helpers::toJSDate($preg->register_date) }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-5 col-lg-5">
                <label for="slPregnancyProviders">ผู้รับฝากครรภ์</label>
                {{
                    Form::select('slPregnancyProviders', $providers,
                        isset($preg->provider_id) ? $preg->provider_id : null,
                        ['id' => 'slPregnancyProviders', 'class' => 'form-control'])
                }}

            </div>
            <div class="col-md-2 col-lg-2">
                <label>เลขที่ฝากครรภ์</label>
                <input class="form-control" value="{{ $preg->id }}" type="text" data-type="number" readonly/>
            </div>
            <div class="col-md-2 col-lg-2">
                <label>ครรภ์ที่</label>
                <input class="form-control" type="text" value="{{ $preg->gravida }}" data-type="number" readonly/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <label for="txtPregnancyLMP">LMP</label>
                <div data-type="date-picker" class="input-group date col-sm-12">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control"
                           id="txtPregnancyLMP"
                        value="{{ Helpers::toJSDate($preg->lmp) }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="txtPregnancyEDC">EDC</label>

                <div data-type="date-picker" class="input-group date col-sm-12">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtPregnancyEDC"
                           value="{{ Helpers::toJSDate($preg->edc) }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="txtPregnancyFirstDoctorDate">พบแพทย์ครั้งแรก</label>

                <div data-type="date-picker" class="input-group date col-sm-12">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtPregnancyFirstDoctorDate"
                           value="{{ Helpers::toJSDate($preg->first_doctor_date) }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <label for="">สถานะปัจจุบัน</label>
                {{
                Form::select('slPregnancyStatus',
                ['N' => 'ยังไม่คลอด', 'Y' => 'คลอดแล้ว'], $preg->labor_status, ['class' => 'form-control',
                'id' => 'slPregnancyStatus'])
                }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <br/>
                <legend>ข้อมูลคัดกรองความเสี่ยง</legend>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_ans_history" data-toggle="tab">
                            <i class="fa fa-file-archive-o"></i> ประวัติอดีต
                        </a>
                    </li>
                    <li>
                        <a href="#tab_ans_current" data-toggle="tab">
                            <i class="fa fa-th-large"></i> ประวัติครรภ์ปัจจุบัน
                        </a>
                    </li>
                    <li>
                        <a href="#tab_ans_ill" data-toggle="tab">
                            <i class="fa fa-user-md"></i> ประวัติทางอายุรกรรม
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_ans_history">
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>รายการความเสี่ยง</th>
                                <th>ผลประเมิน</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1. เคยมีทารกตายในครรภ์ หรือเสียชีวิตแรกเกิด (1 เดือนแรก)</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk1',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk1) ? $risk->risk1 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk1'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>2. เคยแท้งเอง 3 ครั้ง หรือมากกว่า <strong>ติดต่อกัน</strong></td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk2',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk2) ? $risk->risk2 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk2'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>3. เคยคลอดบุตรน้ำหนักน้อยกว่า 2,500 กรัม</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk3',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk3) ? $risk->risk3 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk3'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>4. เคยคลอดบุตรน้ำหนักมากกว่า 4,000 กรัม</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk4',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk4) ? $risk->risk4 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk4'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>5. เคยเข้ารับการรักษาพยาบาลเพราะความดันโลหิตสูง ระหว่างตั้งครรภ์ หรือครรภ์เป็นพิษ</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk5',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk5) ? $risk->risk5 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk5'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>6. เคยผ่าตัดอวัยวะในระบบสืบพันธุ์ เช่น เนื้องอกมดลูก <br/> ผ่าตัดปากมดลูก ผูกปากมดลูก ฯลฯ</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk6',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk6) ? $risk->risk6 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk6'])
                                    }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab_ans_current">
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>รายการความเสี่ยง</th>
                                <th>ผลประเมิน</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>7. ครรภ์แฝด</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk7',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk7) ? $risk->risk7 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk7'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>8. อายุ < 15 ปี (นับ EDC)</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk8',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk8) ? $risk->risk8 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk8'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>9. อายุ >= 35 ปี (นับ EDC)</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk9',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk9) ? $risk->risk9 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk9'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>10. Rh Negative</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk10',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk10) ? $risk->risk10 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk10'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>11. เลือดออกทางช่องคลอด</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk11',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk11) ? $risk->risk11 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk11'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>12. มีก้อนในอุ้งเชิงกราน</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk12',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk12) ? $risk->risk12 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk12'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>13. มีความดันโลหิต Diastolic >= 90 mm/Hg</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk13',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk13) ? $risk->risk13 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk13'])
                                    }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab_ans_ill">
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>รายการความเสี่ยง</th>
                                <th>ผลประเมิน</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>14. เบาหวาน</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk14',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk14) ? $risk->risk14 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk14'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>15. โรคไต</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk15',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk15) ? $risk->risk15 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk15'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>16. โรคหัวใจ</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk16',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk16) ? $risk->risk16 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk16'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>17. ติดยาเสพติด, ติดสุรา</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk17',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk17) ? $risk->risk17 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk17'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>18. โรคอายุรกรรมอื่นๆ เช่น ความดันโลหิตสูง, โลหิตจาง ไทรอยด์, SLE ฯลฯ (โปรดระบุ)</td>
                                <td>
                                    {{
                                    Form::select('slPregnancySurveyRisk18',
                                    ['0' => 'ไม่มี', '1' => 'มี'], isset($risk->risk18) ? $risk->risk18 : null,
                                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk18'])
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    {{
                                    Form::text('txtPregnancySurveyRisk18ODetail', isset($risk->risk18_detail) ? $risk->risk18_detail : null,
                                    ['class' => 'form-control input-sm', 'id' => 'txtPregnancySurveyRisk18ODetail'])
                                    }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <a class="btn btn-primary" id="btnPregnancySave" href="javascript:void(0);">
                    <i class="fa fa-save"></i> บันทึกข้อมูล
                </a>

                <input type="checkbox" id="chkPregnancyDischargeStatus" {{ $preg->discharge_status == 'Y' ? 'checked="checked"' : ''}}/> จำหน่าย | <input type="checkbox" id="chkPregnancyForceExport" {{ $preg->force_export == 'Y' ? 'checked="checked"' : ''}}/> บังคับส่งออก วันที่
                (ในเดือน)
            </div>
            <div class="col-md-3 col-lg-3">
                <div data-type="date-picker" class="input-group date col-md-12 col-lg-12">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtPregnancyForceExportDate"
                           value="{{ Helpers::toJSDate($preg->force_export_date) }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>