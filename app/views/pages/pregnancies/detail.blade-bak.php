<input type="hidden" id="txtPersonId"/>

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
            <label for="txtAncRegisterDate">วันที่ลงทะเบียน</label>

            <div data-type="date-picker" class="input-group date col-sm-12">
                <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtAncRegisterDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <div class="col-md-5 col-lg-5">
            <label for="">ผู้รับฝากครรภ์</label>
            <select class="form-control" id="slProviders">
                <option value="">*</option>
                @foreach ($providers as $p)
                <option value="{{ $p->id }}">{{ $p->fname }} {{ $p->lname }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-lg-2">
            <label for="">เลขที่ฝากครรภ์</label>
            <input id="txtAncNo" class="form-control" type="text" data-type="number" readonly/>
        </div>
        <div class="col-md-2 col-lg-2">
            <label for="">ครรภ์ที่</label>
            <input id="txtAncGravida" class="form-control" type="text" data-type="number" readonly/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <label for="txtAncLMP">LMP</label>

            <div data-type="date-picker" class="input-group date col-sm-12">
                <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtAncLMP">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <label for="txtAncEDC">EDC</label>

            <div data-type="date-picker" class="input-group date col-sm-12">
                <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtAncEDC">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <label for="txtAncFirstDoctorDate">พบแพทย์ครั้งแรก</label>

            <div data-type="date-picker" class="input-group date col-sm-12">
                <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtAncFirstDoctorDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <label for="">สถานะปัจจุบัน</label>
            {{
            Form::select('slPregnancyStatus',
            ['1' => 'ยังไม่คลอด', '2' => 'คลอดแล้ว'], null, ['class' => 'form-control', 'id' => 'slPregnacyStatus'])
            }}
        </div>
    </div>
    <br/>

    <div class="row">
    <div class="col-md-12 col-lg-12">
    <ul class="nav nav-pills">
        <li class="active"><a href="#risk" data-toggle="tab">ข้อมูลคัดกรองความเสี่ยง</a></li>
        <li><a href="#lab" data-toggle="tab">ข้อมูล LAB</a></li>
        <li><a href="#ultrasound" data-toggle="tab">ผล Ultrasound</a></li>
    </ul>
    <div class="tab-content">
    <div class="tab-pane active" id="risk">
    <br/>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_ans_history" data-toggle="tab"><i class="fa fa-times"></i> ประวัติอดีต</a></li>
        <li><a href="#tab_ans_current" data-toggle="tab"><i class="fa fa-th-large"></i> ประวัติครรภ์ปัจจุบัน</a></li>
        <li><a href="#tab_ans_ill" data-toggle="tab"><i class="fa fa-user-md"></i> ประวัติทางอายุรกรรม</a></li>
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
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk1'])
                    }}
                </td>
            </tr>
            <tr>
                <td>2. เคยแท้งเอง 3 ครั้ง หรือมากกว่า <strong>ติดต่อกัน</strong></td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk2',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk2'])
                    }}
                </td>
            </tr>
            <tr>
                <td>3. เคยคลอดบุตรน้ำหนักน้อยกว่า 2,500 กรัม</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk3',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk3'])
                    }}
                </td>
            </tr>
            <tr>
                <td>4. เคยคลอดบุตรน้ำหนักมากกว่า 4,000 กรัม</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk4',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk4'])
                    }}
                </td>
            </tr>
            <tr>
                <td>5. เคยเข้ารับการรักษาพยาบาลเพราะความดันโลหิตสูง ระหว่างตั้งครรภ์ หรือครรภ์เป็นพิษ</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk5',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk5'])
                    }}
                </td>
            </tr>
            <tr>
                <td>6. เคยผ่าตัดอวัยวะในระบบสืบพันธุ์ เช่น เนื้องอกมดลูก <br/> ผ่าตัดปากมดลูก ผูกปากมดลูก ฯลฯ</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk6',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
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
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk7'])
                    }}
                </td>
            </tr>
            <tr>
                <td>8. อายุ < 15 ปี (นับ EDC)</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk8',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk8'])
                    }}
                </td>
            </tr>
            <tr>
                <td>9. อายุ >= 35 ปี (นับ EDC)</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk9',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk9'])
                    }}
                </td>
            </tr>
            <tr>
                <td>10. Rh Negative</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk10',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk10'])
                    }}
                </td>
            </tr>
            <tr>
                <td>11. เลือดออกทางช่องคลอด</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk11',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk11'])
                    }}
                </td>
            </tr>
            <tr>
                <td>12. มีก้อนในอุ้งเชิงกราน</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk12',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk12'])
                    }}
                </td>
            </tr>
            <tr>
                <td>13. มีความดันโลหิต Diastolic >= 90 mm/Hg</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk13',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
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
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk14'])
                    }}
                </td>
            </tr>
            <tr>
                <td>15. โรคไต</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk15',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk15'])
                    }}
                </td>
            </tr>
            <tr>
                <td>16. โรคหัวใจ</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk16',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk16'])
                    }}
                </td>
            </tr>
            <tr>
                <td>17. ติดยาเสพติด, ติดสุรา</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk17',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk17'])
                    }}
                </td>
            </tr>
            <tr>
                <td>18. โรคอายุรกรรมอื่นๆ เช่น ความดันโลหิตสูง, โลหิตจาง ไทรอยด์, SLE ฯลฯ (โปรดระบุ)</td>
                <td>
                    {{
                    Form::select('slPregnancySurveyRisk18',
                    ['0' => 'ไม่มี', '1' => 'มี'], null,
                    ['class' => 'form-control input-sm', 'id' => 'slPregnancySurveyRisk18'])
                    }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    {{
                    Form::text('txtPregnancySurveyOther', null,
                    ['class' => 'form-control input-sm', 'id' => 'txtPregnancySurveyOther'])
                    }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    <div class="tab-pane" id="lab">
        <br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ชื่อ LAB</th>
                <th width="20%">ผล</th>
                <th width="10%">ผลปกติ</th>
                <th>ชื่อ LAB</th>
                <th width="20%">ผล</th>
                <th width="15%">ผลปกติ</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ตรวจ VDRL</td>
                <td width="20%"><input class="form-control input-sm" type="text"/></td>
                <td width="15%">
                    {{ Form::select('slVDRLResult', ['1' => 'ปกติ', '2' => 'ผิดปกติ'], null, ['class' => 'form-control
                    input-sm']) }}
                </td>
                <td>ตรวจ HIV</td>
                <td width="20%"><input class="form-control input-sm" type="text"/></td>
                <td width="15%">
                    {{ Form::select('slHIVResult', ['1' => 'ปกติ', '2' => 'ผิดปกติ'], null, ['class' => 'form-control
                    input-sm']) }}
                </td>
            </tr>
            <tr>
                <td>ตรวจ OF</td>
                <td width="20%"><input class="form-control input-sm" type="text"/></td>
                <td width="15%">
                    {{ Form::select('slOFResult', ['1' => 'ปกติ', '2' => 'ผิดปกติ'], null, ['class' => 'form-control
                    input-sm']) }}
                </td>
                <td>ตรวจ HCT</td>
                <td width="20%"><input class="form-control input-sm" type="text"/></td>
                <td width="15%">
                    {{ Form::select('slHCTResult', ['1' => 'ปกติ', '2' => 'ผิดปกติ'], null, ['class' => 'form-control
                    input-sm']) }}
                </td>
            </tr>
            <tr>
                <td>ตรวจ DCIP</td>
                <td width="20%"><input class="form-control input-sm" type="text"/></td>
                <td width="15%">
                    {{ Form::select('slDCIPResult', ['1' => 'ปกติ', '2' => 'ผิดปกติ'], null, ['class' => 'form-control
                    input-sm']) }}
                </td>
                <td>ตรวจ HbsAg</td>
                <td width="20%"><input class="form-control input-sm" type="text"/></td>
                <td width="15%">
                    {{ Form::select('slHbsAgResult', ['1' => 'ปกติ', '2' => 'ผิดปกติ'], null, ['class' => 'form-control
                    input-sm']) }}
                </td>
            </tr>
            <tr>
                <td>ตรวจ Blood group</td>
                <td width="20%"><input class="form-control input-sm" type="text"/></td>
                <td width="10%">
                    {{ Form::select('slBloodGroupResult', ['1' => 'ปกติ', '2' => 'ผิดปกติ'], null, ['class' => 'form-control
                    input-sm']) }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="ultrasound">
        ...
    </div>
    </div>
    </div>
    </div>

    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <a class="btn btn-primary" id="btnReferSave" href="javascript:void(0);">
                    <i class="fa fa-save"></i> บันทึกข้อมูล
                </a>

                <input type="checkbox"/> จำหน่าย | <input type="checkbox"/> บังคับส่งออก วันที่ (ในเดือน)
            </div>
            <div class="col-md-3 col-lg-3">
                <div data-type="date-picker" class="input-group date col-md-12 col-lg-12">
                    <input type="text" placeholder="วว/ดด/ปปปป" class="form-control" id="txtAccidentDate">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>