$(function() {

    var accident = {};

    accident.doSave = function (items, cb) {
        app.post(serviceUrl[24], items, function (err, data) {
           err ? cb(err) : cb(null, data);
        });
    };

    accident.doRemove = function (id, cb) {
        app.post(serviceUrl[25], {id: id}, function (err) {
           err ? cb(err) : cb(null);
        });
    };

    accident.clearForm = function () {
        $('#txtAccidentId').val('');
        $('#txtAccidentDate').val('');
        $('#txtAccidentTime').val('');
        $('#slAccidentType').val('');
        $('#slAccidentPlace').val('');
        $('#slAccidentUrgency').val('6');
        $('#slAccidentTypeIn').val('');
        $('#slAccidentTraffic').val('9');
        $('#slAccidentVehicle').val('');
        $('#slAccidentAlcohol').val('9');
        $('#slAccidentNacroticDrug').val('9');
        $('#slAccidentBelt').val('9');
        $('#slAccidentHelmet').val('9');
        $('#slAccidentAirway').val('3');
        $('#slAccidentStopBleed').val('3');
        $('#slAccidentSplint').val('3');
        $('#slAccidentFluid').val('3');
        $('#txtAccidentComaEye').val('');
        $('#txtAccidentComaSpeak').val('');
        $('#txtAccidentComaMovement').val('');
    };

    $('#btnAccidentSave').on('click', function (e) {
        e.preventDefault();

        var items = {};

        items.id = $('#txtAccidentId').val();
        items.service_id = $('#txtServiceId').val();
        items.accident_date = $('#txtAccidentDate').val();
        items.accident_time = $('#txtAccidentTime').val();
        items.accident_type_id = $('#slAccidentType').val();
        items.accident_place_id = $('#slAccidentPlace').val();
        items.urgency = $('#slAccidentUrgency').val();
        items.accident_type_in_id = $('#slAccidentTypeIn').val();
        items.traffic = $('#slAccidentTraffic').val();
        items.accident_vehicle_id = $('#slAccidentVehicle').val();
        items.alcohol = $('#slAccidentAlcohol').val();
        items.nacrotic_drug = $('#slAccidentNacroticDrug').val();
        items.blet = $('#slAccidentBelt').val();
        items.helmet = $('#slAccidentHelmet').val();
        items.airway = $('#slAccidentAirway').val();
        items.stop_bleed = $('#slAccidentStopBleed').val();
        items.splint = $('#slAccidentSplint').val();
        items.fluid = $('#slAccidentFluid').val();
        items.coma_eye = $('#txtAccidentComaEye').val();
        items.coma_speak = $('#txtAccidentComaSpeak').val();
        items.coma_movement = $('#txtAccidentComaMovement').val();

        if (!items.service_id) app.alert('กรุณาระบุเลขที่รับบริการ');
        else if (!items.accident_date) app.alert('กรุณาระบุวันที่เกิดอุบัติเหตุ');
        else if (!items.accident_time) app.alert('กรุณาระบุเวลาที่เกิดอุบัติเหตุ');
        else if (!items.accident_type_id) app.alert('กรุณาระบุุประเภทของอุบัติเหตุ');
        else if (!items.accident_type_in_id) app.alert('กรุณาระบุประเภทการมารับบริการ');
        else if (!items.urgency) app.alert('กรุณาระบุุความเร่งด่วนของอุบัติเหตุ');
        else
        {
            accident.doSave(items, function (err, data) {
                if (err) app.alert(err);
                else
                {
                    $('#txtAccidentId').val(data.id);
                    app.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                }
            });
        }
    });

    $('#btnAccidentRemove').on('click', function (e) {
        e.preventDefault();

        var id = $('#txtAccidentId').val();

        if (id)
        {
            if (confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่?'))
            {
                accident.doRemove(id, function (err) {
                   if (err) app.alert(err);
                   else
                   {
                       app.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                       accident.clearForm();
                   }
                });
            }
        }
        else
        {
            app.alert('ไม่พบรายการที่ต้องการจะลบ กรุณาบันทึกรายการก่อน');
        }
    });
});