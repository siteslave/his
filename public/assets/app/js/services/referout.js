$(function () {

    var refer = {};

    refer.doSave = function (items, cb) {
        app.post(serviceUrl[22], items, function (err, data) {
           err ? cb(err) : cb(null, data);
        });
    };

    refer.doRemove = function (id, cb) {
        app.post(serviceUrl[23], {id: id}, function (err) {
           err ? cb(err) : cb(null);
        });
    };



    $('#txtReferHosp').select2({
        placeholder: 'ชื่อ หรือ รหัสสถานบริการ',
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
            url: apiUrls[0],
            dataType: 'jsonp',
            type: 'GET',
            quietMillis: 100,

            data: function (term, page) {
                return {
                    query: term,
                    page_limit: 10,
                    page: page
                };
            },

            results: function (data, page) {
                var myResults = [];
                $.each(data.rows, function (i, v) {
                    myResults.push({
                        id: v.hmain,
                        text: '[' + v.hmain + '] ' + v.hname
                    });
                });

                return { results: myResults, more: (page * 10) < data.total };
            }
        }
    });

    $('#txtReferDiag').select2({
        placeholder: 'ชื่อ หรือ รหัสการวินิจฉัย',
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
            url: apiUrls[1],
            dataType: 'jsonp',
            type: 'GET',
            quietMillis: 100,

            data: function (term, page) {
                return {
                    query: term,
                    page_limit: 10,
                    page: page
                };
            },

            results: function (data, page) {
                var myResults = [];
                $.each(data.rows, function (i, v) {
                    myResults.push({
                        id: v.code,
                        text: '[' + v.code + '] ' + v.desc_r
                    });
                });

                return { results: myResults, more: (page * 10) < data.total };
            }
        }
    });

    //save
    $('#btnReferSave').on('click', function (e) {
        e.preventDefault();

        var items = {};
        var hospital = $('#txtReferHosp').select2('data');
        var diag = $('#txtReferDiag').select2('data');

        if (hospital == null) app.alert('กรุณาระบุสถานพยาบาลที่ต้องการส่งต่อ');
        else if (diag == null) app.alert('กรุณาระบุรหัสการวินิจฉัยโรค');
        else
        {
            items.refer_id      = $('#txtReferId').val();
            items.refer_date    = $('#txtReferDate').val();
            items.cause_id      = $('#slReferCause').val();
            items.provider_id   = $('#slReferProvider').val();
            items.description   = $('#txtReferDescription').val();
            items.expire_date   = $('#txtReferExpireDate').val();

            items.diag_code     = diag.id;
            items.to_hospital   = hospital.id;

            items.service_id      = $('#txtServiceId').val();

            if (!items.refer_date) app.alert('กรุณาระบุวันที่ส่งต่อ');
            else if (!items.cause_id) app.alert('กรุณาระบุเหตุผลการส่งต่อ');
            else if (!items.provider_id) app.alert('กรุณาระบุแพทย์หรือเจ้าหน้าที่ส่งต่อ');
            else if (!items.to_hospital) app.alert('กรุณาระบุสถานที่ส่งต่อ');
            else if (!items.diag_code) app.alert('กรุณาระบุรหัสการวินิจฉัยโรค');
            else
            {
                refer.doSave(items, function (err, data) {
                   if (err) app.alert(err);
                   else
                   {
                       $('#txtReferId').val(data.id);
                       app.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว เลขที่ใบส่งตัวลำดับที่ ' + data.id);

                       //$('#panelRefer').removeClass('panel panel-primary');
                       //$('#panelRefer').addClass('panel panel-success');

//                       setTimeout(function() {
//                           $('#panelRefer').removeClass('panel panel-success');
//                           $('#panelRefer').addClass('panel panel-primary');
//                       }, 2000);
                   }
                });
            }
        }
    });

    refer.clearForm = function () {
        $('#txtReferId').val('');
        $('#txtReferDate').val(app.getCurrentEngDate());
        $('#slReferCause').val('');
        $('#slReferProvider').val('');
        $('#txtReferDescription').val('');
        $('#txtReferExpireDate').val('');
        $('#txtReferHosp').select2('val', '');
        $('#txtReferDiag').select2('val', '');
    };

    $('#btnReferRemove').on('click', function (e) {
        e.preventDefault();

        var refer_id = $('#txtReferId').val();

        if (!refer_id) app.alert('ไม่พบเลขที่ใบส่งต่อที่ต้องการลบ กรุณาตรวจสอบ');
        else
        {
            if (confirm('คุณต้องการลบเลขที่ใบส่งต่อ ' + refer_id + ' ใช่หรือไม่?'))
            {
                refer.doRemove(refer_id, function (err) {
                   if (err) app.alert('ไม่สามารถลบรายการได้ ' + err );
                   else
                   {
                       app.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                       refer.clearForm();
                   }
                });
            }
        }
    });

    //set default data for select2
    var hospcode = $('#txtReferHosp').data('id'),
        hospname = $('#txtReferHosp').data('text'),
        diagcode = $('#txtReferDiag').data('id'),
        diagname = $('#txtReferDiag').data('text');

    $('#txtReferHosp').select2('data', {id: hospcode, text: '[' + hospcode + '] ' + hospname});
    $('#txtReferDiag').select2('data', {id: diagcode, text: '[' + diagcode + '] ' + diagname});
});
