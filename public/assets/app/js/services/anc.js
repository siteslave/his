$(function() {

    var anc = {};

    anc.doSaveScreen = function (items, cb) {
        app.post(serviceUrl[26], items, function (err, data) {
            err ? cb(err) : cb(null, data.id);
        });
    };

    anc.doSaveVaccine = function (items, cb) {
        app.post(serviceUrl[27], items, function (err, data) {
            err ? cb(err) : cb(null, data.id);
        });
    };

    anc.doRemoveVaccine = function (id, cb) {
        app.delete(serviceUrl[28], {id: id}, function (err) {
            err ? cb(err) : cb(null);
        });
    };

    /***************************************************************************
    * Save anc screen data
    ***************************************************************************/
    $('#btnAncSaveScreen').on('click', function(e) {
        e.preventDefault();

        var items = {};

        items.id               = $('#txtAncId').val();
        items.ga               = $('#txtAncGa').val();
        items.gravida          = $('#slAncGravida').val();
        items.anc_result       = $('#slAncResult').val();
        items.uterus_level_id  = $('#slAncUterusLevel').val();
        items.baby_position_id = $('#slAncBabyPosition').val();
        items.baby_lead_id     = $('#slAncBabyLeads').val();
        items.baby_heart_sound = $('#txtAncBabyHeartSound').val();
        items.is_headache      = $('#chkAncHeadache').is(':checked') ? 1 : 0;
        items.is_swollen       = $('#chkAncSwollen').is(':checked') ? 1 : 0;
        items.is_sick          = $('#chkAncSick').is(':checked') ? 1 : 0;
        items.is_bloodshed     = $('#chkAncBloodshed').is(':checked') ? 1 : 0;
        items.is_thyroid       = $('#chkAncThyroid').is(':checked') ? 1 : 0;
        items.is_cramp         = $('#chkAncCramp').is(':checked') ? 1 : 0;
        items.is_baby_flex     = $('#chkAncBabyFlex').is(':checked') ? 1 : 0;
        items.is_urine         = $('#chkAncUrine').is(':checked') ? 1 : 0;
        items.is_leucorrhoea   = $('#chkAncLeucorrhoea').is(':checked') ? 1 : 0;
        items.is_heart_disease = $('#chkAncHeartDisease').is(':checked') ? 1 : 0;

        items.service_id       = $('#txtServiceId').val();
        items.person_id = $('#txtPersonId').val();

        if (!items.ga) {
            app.alert('กรุณาระบุอายุของครรภ์');
        } else if (!items.gravida) {
            app.alert('กรุณาระบุลำดับที่ของครรภ์ที่ตรวจในครั้งนี้');
        } else if (!items.anc_result) {
            app.alert('กรุณาระบุผลของการตรวจครรภ์');
        } else {
            anc.doSaveScreen(items, function (err, id) {
                if (err) app.alert(err);
                else {
                    $('#txtAncId').val(id);
                    app.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                }
            })
        }
    });

    /***************************************************************************
    * Toggle form
    ***************************************************************************/
    $('#btnAncAddVaccine').on('click', function(e) {
        e.preventDefault();
        // Clear form
        anc.clear_form();
        // Hide/Show form
        $('#tblAncNewVaccine').toggleClass('hidden');
    });

    /**************************************************************************
    * Clear form
    ***************************************************************************/
    anc.clear_form = function() {
        $('#slAncLots').empty();
        $('#txtAncAddExpireDate').val('');
        $('#slAncAddVaccines').val('');
        $('#slAncAddProviders').val('');
    };

    $('#slAncLots').on('change', function() {
        var $this = $(this).find('option:selected');
        var expire_date = $this.data('expire');

        $('#txtAncAddExpireDate').val(app.toThaiDate(expire_date));

    });

    $('#slAncAddVaccines').on('change', function() {
        var vaccine_id = $(this).val();

        app.get(apiUrls[10], {vaccine_id: vaccine_id}, function(err, data) {
            if (!err) {
                var $sl = $('#slAncLots');
                $sl.empty();

                if (_.size(data.rows)) {
                    $sl.append('<option value="">-*-</option>');
                    _.each(data.rows, function(v) {
                       $('#slAncLots').append(
                           '<option data-expire="' + v.expire_date + '" value="' + v.lot + '">' + v.lot + '</option>'
                       );
                    });

                    $('#txtAncAddExpireDate').val('');

                } else {
                    $('#slAncLots').empty();
                    $('#txtAncAddExpireDate').val('');
                }
            } else {
                $('#txtAncAddLot').val('');
                $('#txtAncAddExpireDate').val('');
            }
        });
    });

    $('#btnDoSaveVaccine').on('click', function(e) {
        e.preventDefault();

        var items = {};
        items.vaccine_id  = $('#slAncAddVaccines').val();
        items.provider_id = $('#slAncAddProviders').val();
        items.lot         = $('#slAncLots').val();
        items.expire_date = $('#txtAncAddExpireDate').val();

        items.service_id  = $('#txtServiceId').val();
        items.person_id = $('#txtPersonId').val();
        items.gravida = $('#slAncGravida').val();

        if (!items.vaccine_id) app.alert('กรุณาระบุวัคซีน');
        else if (!items.lot) app.alert('กรุณาระบุ Lot');
        //else if (!items.expire_date) app.alert('กรุณาระบุ วันหมดอายุของวัคซีน');
        else if (!items.provider_id) app.alert('กรุณาระบุ ผู้ให้บริการวัคซีน');
        else {
            anc.doSaveVaccine(items, function(err, id) {
                if (!err) {
                    var vaccine_name = $('#slAncAddVaccines option:selected').text();
                    var provider_name = $('#slAncAddProviders option:selected').text();

                    $('#tblAncNewVaccine').toggleClass('hidden');

                    $('#tblAncVaccines > tbody').append(
                        '<tr>' +
                        '<td>' + vaccine_name + '</td>' +
                        '<td class="text-center">' + items.lot + '</td>' +
                        '<td class="text-center">' + items.expire_date + '</td>' +
                        '<td>' + provider_name + '</td>' +
                        '<td class="text-center"><a href="#" data-name="btnAncRemoveVaccine" data-id="' + id + '" ' +
                        'class="btn btn-sm btn-danger">' +
                        '<i class="fa fa-times"></i>' +
                        '</a></td>' +
                        '</tr>'
                    );
                } else {
                    app.alert(err);
                }
            });
        }
    });

    /***************************************************************************
    * Remove vaccine
    ****************************************************************************/
    $(document).off('click', 'a[data-name="btnAncRemoveVaccine"]');
    $(document).on('click', 'a[data-name="btnAncRemoveVaccine"]', function(e) {
        e.preventDefault();

        var id  = $(this).data('id'),
            $tr = $(this).parent().parent();

        if (confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่?')) {
            anc.doRemoveVaccine(id, function(err) {
                if (err) app.alert(err);
                else {
                    $tr.fadeOut('slow');
                }
            });
        }
    });
});
