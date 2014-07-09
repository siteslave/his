$(function() {
    var vaccines = {};

    // Save vaccine's lot
    vaccines.doSave = function(items, cb) {
        app.post(serviceUrl[0], items, function(err, data) {
            if (err) cb(err);
            else cb(null, data.id);
        });
    };

    // Get vaccine lot
    vaccines.doGetList = function(cb) {
        app.get(serviceUrl[1], {}, function(err, data) {
            if (err) cb(err);
            else cb(null, data.rows);
        });
    };

    vaccines.setList = function(data) {
        var $table = $('#tblVaccineList').find('tbody');
        // Clear table row
        $table.empty();

        _.each(data, function(v) {
            $table.append(
                '<tr>' +
                '<td>' + v.th_name + '</td>' +
                '<td>' + v.name + '</td>' +
                '<td>' + v.lot + '</td>' +
                '<td>' + app.toThaiDate(v.expire_date) + '</td>' +
                '<td>' + v.export_code + '</td>' +
                '<td><div class="btn-group"> ' +
                '<a href="#" class="btn btn-sm btn-default" data-name="btnVaccineEdit" data-id="' + v.id + '" ' +
                'data-lot="' + v.lot + '" data-expire="' + app.mysqlToJSDate(v.expire_date) + '" data-vaccine="' + v.vaccine_id + '"> ' +
                '<i class="fa fa-edit"></i> ' +
                '</a> ' +
                //'<a href="#" class="btn btn-sm btn-danger" data-id="' + v.id + '"><i class="fa fa-times"></i></a> ' +
                '</div></td>' +
                '</tr>'
            );
        });
    };

    vaccines.clearTable = function() {

        var $table = $('#tblVaccineList').find('tbody');
            $table
                .empty()
                .append('<tr><td colspan="6">ไม่พบรายการ</td></tr>');
    };

    vaccines.getList = function() {
        vaccines.doGetList(function(err, rows) {
            if (err) {
                // Clear table row
                vaccines.clearTable();
                app.alert(err);
            } else {
                if (_.size(rows)) {
                    vaccines.setList(rows);
                } else {
                    // Clear table row
                    vaccines.clearTable();
                }
            }
        });
    };

    $(document).off('click', '#btnSaveVaccineLot');
    $(document).on('click', '#btnSaveVaccineLot', function(e) {
        e.preventDefault();

        var items = {};

        items.vaccine_id = $('#slVaccine').val();
        items.lot = $('#txtVaccineLot').val();
        items.expire_date = $('#txtVaccineExpireDate').val();
        items.id = $('#txtVaccineLotId').val();

        if (!items.vaccine_id) app.alert('กรุณาระบุชื่อวัคซีน');
        else if (!items.lot) app.alert('กรุณาระบุ Lot');
        else {
            vaccines.doSave(items, function(err) {

                if (!err) {
                    vaccines.clearForm();
                    vaccines.getList();
                } else {
                    app.alert(err);
                }
            });
        }
    });

    vaccines.clearForm = function() {
        $('#txtVaccineLotId').val('');
        $('#slVaccine')
            .val('')
            .prop('disabled', false);

        $('#txtVaccineLot').val('');
        $('#txtVaccineExpireDate').val('');
        $('#tblAddVaccine').toggleClass('hidden');
    };

    $('#btnAddVaccine').on('click', function(e) {
        e.preventDefault();
        vaccines.clearForm();
    });

    $(document).off('click', 'a[data-name="btnVaccineEdit"]');
    $(document).on('click', 'a[data-name="btnVaccineEdit"]', function(e) {
        e.preventDefault();


        var id = $(this).data('id'),
            lot = $(this).data('lot'),
            vaccine_id = $(this).data('vaccine'),
            expire_date = $(this).data('expire');

        $('#slVaccine')
            .val(vaccine_id)
            .prop('disabled', true);

        $('#txtVaccineLot').val(lot);
        $('#txtVaccineExpireDate').val(expire_date);

        $('#txtVaccineLotId').val(id);

        $('#tblAddVaccine').toggleClass('hidden');
    });
});
