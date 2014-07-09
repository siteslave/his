$(function() {

    var pregnancies = {};

    pregnancies.doSave = function(items, cb) {
        app.post(actionUrl[2], items, function(err) {
           err ? cb(err) : cb(null);
        });
    };

    $('#btnPregnancySave').on('click', function(e) {
        e.preventDefault();

        var items = {};

        items.id = $('#txtPregnancyId').val();
        items.provider_id = $('#slPregnancyProviders').val();
        items.register_date = $('#txtPregnancyRegisterDate').val();
        items.lmp = $('#txtPregnancyLMP').val();
        items.edc = $('#txtPregnancyEDC').val();
        items.first_doctor_date = $('#txtPregnancyFirstDoctorDate').val();
        items.labor_status = $('#slPregnancyStatus').val();
        items.force_export = $('#chkPregnancyForceExport').prop('checked') ? 'Y' : 'N';
        items.force_export_date = $('#txtPregnancyForceExportDate').val();
        items.discharge_status = $('#chkPregnancyDischargeStatus').prop('checked') ? 'Y' : 'N';

        items.risk1 = $('#slPregnancySurveyRisk1').val();
        items.risk2 = $('#slPregnancySurveyRisk2').val();
        items.risk3 = $('#slPregnancySurveyRisk3').val();
        items.risk4 = $('#slPregnancySurveyRisk4').val();
        items.risk5 = $('#slPregnancySurveyRisk5').val();
        items.risk6 = $('#slPregnancySurveyRisk6').val();
        items.risk7 = $('#slPregnancySurveyRisk7').val();
        items.risk8 = $('#slPregnancySurveyRisk8').val();
        items.risk9 = $('#slPregnancySurveyRisk9').val();
        items.risk10 = $('#slPregnancySurveyRisk10').val();
        items.risk11 = $('#slPregnancySurveyRisk11').val();
        items.risk12 = $('#slPregnancySurveyRisk12').val();
        items.risk13 = $('#slPregnancySurveyRisk13').val();
        items.risk14 = $('#slPregnancySurveyRisk14').val();
        items.risk15 = $('#slPregnancySurveyRisk15').val();
        items.risk16 = $('#slPregnancySurveyRisk16').val();
        items.risk17 = $('#slPregnancySurveyRisk17').val();
        items.risk18 = $('#slPregnancySurveyRisk18').val();
        items.risk18_detail = $('#txtPregnancySurveyRisk18ODetail').val();

        if (!items.id) {
            app.alert('ไม่พบรหัสลงทะเบียน');
        } else {
            pregnancies.doSave(items, function(err) {
                if (err) {
                    app.alert(err);
                } else {
                    app.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                }
            });
        }
    });
});