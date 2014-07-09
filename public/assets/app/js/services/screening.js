$(function() {

    var screening = {};

    screening.doSave = function (data, cb) {
        app.post(serviceUrl[3], data, function (err) {
           if (err) cb(err);
           else cb(null);
        });
    };

    $('#btnVSSaveScreen').on('click', function(e) {
        e.preventDefault();

        var items = {};

        items.service_id     = $('#txtServiceId').val();
        items.screen_id      = $('#txtVSScreenId').val();
        items.service_status = $('#slVSServiceStatus').val();
        items.locked         = $('#chkVSLocked').is(':checked') ? 'Y' : 'N';
        items.weight         = $('#txtVSWeight').val();
        items.height         = $('#txtVSHeight').val();
        items.body_temp      = $('#txtVSTemp').val();
        items.waist          = $('#txtVSWaist').val();
        items.pr             = $('#txtVSPR').val();
        items.rr             = $('#txtVSRR').val();
        items.sbp            = $('#txtVSSBP').val();
        items.dbp            = $('#txtVSDBP').val();
        items.cc             = $('#txtVSCC').val();
        items.pe             = $('#txtVSPE').val();

        items.ill_history            = $('#chkVSIsIllHistory').is(':checked') ? 'Y' : 'N';
        items.ill_history_detail     = $('#txtVSIllDetail').val();

        items.operate_history        = $('#chkVSOperateHistory').is(':checked') ? 'Y' : 'N';
        items.operate_history_detail = $('#txtVSOperateDetail').val();
        items.operate_history_year   = $('#txtVSOperateYear').val();

        items.mind_strain            = $('#chkVSScreenMindStrain').is(':checked') ? 'Y' : 'N';
        items.mind_work              = $('#chkVSScreenMindWork').is(':checked') ? 'Y' : 'N';
        items.mind_family            = $('#chkVSScreenMindFamily').is(':checked') ? 'Y' : 'N';
        items.mind_other             = $('#chkVSScreenMindOther').is(':checked') ? 'Y' : 'N';
        items.mind_other_detail      = $('#txtSVScreenMindOtherDetail').val();

        items.risk_ht                = $('#chkVSScreenRiskHT').is(':checked') ? 'Y' : 'N';
        items.risk_dm                = $('#chkVSScreenRiskDM').is(':checked') ? 'Y' : 'N';
        items.risk_stoke             = $('#chkVSScreenRiskStoke').is(':checked') ? 'Y' : 'N';
        items.risk_other             = $('#chkVSScreenRiskOther').is(':checked') ? 'Y' : 'N';
        items.risk_other_detail      = $('#chkVSScreenRiskDetail').val();

        items.smoking                = $('#slVSSmoking').val();
        items.drinking               = $('#slVSDrinking').val();

        items.lmp                    = $('#slVSScreenLmp').val();
        items.lmp_start              = $('#txtVSScreenLmpStartDate').val();
        items.lmp_finished           = $('#txtVSScreenLmpFinishedDate').val();

        items.consult_drug           = $('#chkVSScreenConsultDrug').is(':checked') ? 'Y' : 'N';
        items.consult_activity       = $('#chkVSScreenConsultActivity').is(':checked') ? 'Y' : 'N';
        items.consult_appoint        = $('#chkVSScreenConsultAppoint').is(':checked') ? 'Y' : 'N';
        items.consult_food           = $('#chkVSScreenConsultFood').is(':checked') ? 'Y' : 'N';
        items.consult_exercise       = $('#chkVSScreenConsultExercise').is(':checked') ? 'Y' : 'N';
        items.consult_complication   = $('#chkVSScreenConsultComplication').is(':checked') ? 'Y' : 'N';
        items.consult_other          = $('#chkVSScreenConsultOther').is(':checked') ? 'Y' : 'N';
        items.consult_other_detail   = $('#chkVSScreenConsultOtherDetail').val();

        //validator
        //if (!items.visit_id) app.alert('กรุณาระบุเลขที่รับบริการ');
        if (!items.screen_id) app.alert('กรุณาระบุเลขที่ Screen');
        else if (!items.height) app.alert('กรุณาระบุส่วนสูง');
        else if (!items.weight) app.alert('กรุณาระบุน้ำหนัก');
        else if (!items.body_temp) app.alert('กรุณาระบุอุณหภูมิ');
        else if (!items.sbp) app.alert('กรุณาระบุความดัน SBP');
        else if (!items.dbp) app.alert('กรุณาระบุความดัน DBP');
        else if (!items.cc) app.alert('กรุณาระบุอาการแรกรับ CC');
        else
        {
            screening.doSave(items, function (err) {
                if (err) app.alert(err);
                else app.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
            });
        }
    });
});
