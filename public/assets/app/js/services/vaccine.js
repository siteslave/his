;$(function() {

    var vaccine = {};

    vaccine.modal = {
        showNew : function() {
            $('#modalVaccineNew').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    };

    $('#modalVaccineNew').on('hidden.bs.modal', function (e) {
        vaccine.clearForm();
    });

    vaccine.clearForm = function () {
        $('#slVaccineList').val('');
        $('#slVaccinePlace').val(1);
        $('#slVaccineLots').val('');
        $('#txtVaccineExpireDate').val('');
        $('#slVaccineProviders').val('');
    };

    // do save vaccine
    vaccine.doSave = function (items, cb) {
        app.post(serviceUrl[32], items, function (err, data) {
            if (err) {
                cb(err);
            } else {
                cb(null, data.id);
            }
        });
    };

    // remove vaccine
    vaccine.doRemove = function (id, cb) {
        app.delete(serviceUrl[33], {id: id}, function(err) {
           if (err) {
               cb(err);
           } else {
               cb(null);
           }
        });
    };

    // get vaccine list in combo
    vaccine.getVaccine = function(t) {
        app.get(apiUrls[11], { t: t }, function(err, data) {
           if (err) {
               app.alert(err);
           } else {
               $('#slVaccineList').empty();
               $('#slVaccineList').append('<option value="">*</option>');

               _.each(data.rows, function (v) {
                   var options = [
                       '<option value="' + v.id + '">',
                       '['+ v.name +'] ' + v.th_name,
                       '</option>'
                   ].join('');

                  $('#slVaccineList').append(options);
               });

               vaccine.modal.showNew();
           }
        });
    };

    $('button[data-name="btnShowAddVaccine"]').on('click', function(e) {
        e.preventDefault();

        var t = $(this).data('type');
        vaccine.getVaccine(t);
    });

    $('#slVaccineList').on('change', function() {
        var vaccine_id = $(this).val();

        app.get(apiUrls[10], { vaccine_id: vaccine_id }, function(err, data) {
            if (!err) {
                var $sl = $('#slVaccineLots');
                $sl.empty();

                if (_.size(data.rows)) {
                    $sl.append('<option value="">-*-</option>');
                    _.each(data.rows, function(v) {

                        var html = [
                            '<option data-expire="' + v.expire_date + '" ',
                            'value="' + v.lot + '">' + v.lot + '</option>'
                        ].join('');

                        $('#slVaccineLots').append(html);
                    });

                    $('#txtVaccineExpireDate').val('');

                } else {
                    $('#slAncLots').empty();
                    $('#txtVaccineExpireDate').val('');
                }
            } else {
                $('#txtAncAddLot').val('');
                $('#txtVaccineExpireDate').val('');
            }
        });
    });

    $('#slVaccineLots').on('change', function() {
        var $this = $(this).find('option:selected');
        var expire_date = $this.data('expire');

        $('#txtVaccineExpireDate').val(app.toThaiDate(expire_date));

    });

    // save vaccine
    $('#btnVaccineSave').on('click', function (e) {
        e.preventDefault();

        var items = {};

        items.vaccine_id = $('#slVaccineList').val();
        items.vaccine_place = $('#slVaccinePlace').val();
        items.vaccine_lot = $('#slVaccineLots').val();
        items.vaccine_expire_date = $('#txtVaccineExpireDate').val();
        items.provider_id = $('#slVaccineProviders').val();

        items.service_id = $('#txtServiceId').val();
        items.person_id = $('#txtPersonId').val();

        if (!items.vaccine_id) app.alert('กรุณาระบุวัคซีน');
        else if (!items.vaccine_lot) app.alert('กรุณาระบุ Lot ของวัคซีน');
        else if (!items.provider_id) app.alert('กรุณาระบุผู้ให้บริการ');
        else {
            vaccine.doSave(items, function (err, id) {
                if (err) {
                    app.alert(err);
                } else {
                    var $table = $('#tblVaccineList').find('tbody'),

                        vaccine_name = $('#slVaccineList').find('option:selected').text(),
                        provider_name = $('#slVaccineProviders').find('option:selected').text(),
                        vaccine_place_name = $('#slVaccinePlace').find('option:selected').text();

                    var html = [
                        '<tr>',
                        '<td>' + vaccine_name + '</td>',
                        '<td class="text-center">' + items.vaccine_lot + '</td>',
                        '<td class="text-center">' + app.jsToThaiDate(items.vaccine_expire_date) + '</td>',
                        '<td>' + vaccine_place_name + '</td>',
                        '<td>' + provider_name + '</td>',
                        '<td class="text-center">',
                        '<a href="#" class="btn btn-sm btn-danger" data-name="btnRemoveVaccine" data-id="' + id + '">',
                        '<i class="fa fa-times"></i>',
                        '</a>',
                        '</td>'
                    ].join('');

                    $table.append(html);

                    // hide modal
                    $('#modalVaccineNew').modal('hide');
                }
            });
        }

    });

    $(document).off('click', 'a[data-name="btnRemoveVaccine"]');
    $(document).on('click', 'a[data-name="btnRemoveVaccine"]', function (e) {

        e.preventDefault();

        var id = $(this).data('id'),
            $tr = $(this).parent().parent();

        if (confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')) {
            vaccine.doRemove(id, function (err) {
               if (err) {
                   app.alert(err);
               } else {
                   $tr.fadeOut();
               }
            });
        }

    });

});