;$(function() {
    var postnatal = {};

    postnatal.clearForm = function () {
        $('#txtPostnatalId').val('');
        $('#slPostnatalGravida').val('');
        $('#slPostnatalResult').val('');
        $('#slPostnatalServicePlace').val('');
        $('#slPostnatalUterusLevel').val('');
        $('#slPostnatalProviders').val('');
        $('#slPostnatalAmnioticFluid').val('');
        $('#slPostnatalTits').val('');
        $('#slPostnatalAlbumin').val('');
        $('#slPostnatalSugar').val('');
        $('#slPostnatalPerineal').val('');
        $('#txtPostnatalAdvice').val('');
    };

    postnatal.doSave = function (items, cb) {
        app.post(serviceUrl[34], items, function (err, data) {
           if (err) {
               cb(err);
           } else {
               cb(null, data.id);
           }
        });
    };

    postnatal.doRemove = function (id, cb) {
        app.delete(serviceUrl[35], {id: id}, function (err) {
            if (err) {
                cb(err);
            } else {
                cb(null);
            }
        });
    };

    $('#btnPostnatalDoSave').on('click', function (e) {
        e.preventDefault();

        var items = {};

        items.service_id = $('#txtServiceId').val();
        items.id = $('#txtPostnatalId').val();
        items.person_id = $('#txtPersonId').val();

        items.gravida = $('#slPostnatalGravida').val();
        items.result = $('#slPostnatalResult').val();
        items.service_place = $('#slPostnatalServicePlace').val();
        items.uterus_level = $('#slPostnatalUterusLevel').val();
        items.provider_id = $('#slPostnatalProviders').val();
        items.amniotic_fluid = $('#slPostnatalAmnioticFluid').val();
        items.tits = $('#slPostnatalTits').val();
        items.albumin = $('#slPostnatalAlbumin').val();
        items.sugar = $('#slPostnatalSugar').val();
        items.perineal = $('#slPostnatalPerineal').val();
        items.advice = $('#txtPostnatalAdvice').val();

        if (!items.gravida) app.alert('กรุณาระบุครรภ์ที่');
        else if (!items.result) app.alert('กรุณาระบุผลการตรวจ');
        else if (!items.service_place) app.alert('กรุณาระบุสถานที่ตรวจ');
        else if (!items.advice) app.alert('กรุณาระบุการให้คำแนะนำ');
        else {
            postnatal.doSave(items, function (err, id) {
                if (err) app.alert(err);
                else {
                    $('#txtPostnatalId').val(id);
                    app.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                }
            });
        }
    });

    $('#btnPostnatalDoRemove').on('click', function (e) {
        e.preventDefault();

        var id = $('#txtPostnatalId').val();

        if (confirm('คุณต้องการลบการตรวจหลังคลอด ครั้งนี้ใช่หรือไม่?')) {
            postnatal.doRemove(id, function(err) {
                if (err) app.alert(err);
                else {
                    app.alert('ลบรายการเยี่ยมหลังคลอดเสร็จสิ้นแล้ว');
                    postnatal.clearForm();
                }
            });
        }
    });
});