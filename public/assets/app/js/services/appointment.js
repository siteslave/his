$(function() {

    var appoints = {};

    appoints.doSave = function (items, cb) {
        app.post(serviceUrl[19], items, function (err) {
           err ? cb(err) : cb(null);
        });
    };

    appoints.doRemove = function (id, cb) {
        app.delete(serviceUrl[21], {id: id}, function (err) {
           err ? cb(err) : cb(null);
        });
    };

    appoints.getList = function (service_id, cb) {
        app.get(serviceUrl[20], {service_id: service_id}, function (err, data) {
           err ? cb(err) : cb(null, data);
        });
    };

    appoints.clearForm = function () {
        $('#slAppoint').val('');
        $('#txtAppointDate').val('');
        $('#txtAppointTime').val('');
        $('#slAppointProvider').val('');
        $('#slAppointClinic').val('');
    };

    $('#btnAppointNew').on('click', function(e) {
        e.preventDefault();
        appoints.clearForm();
        $('#divNewAppoint').toggleClass('hidden');
    });

    $('#btnAppointSave').on('click', function () {
        var items = {};

        items.appoint_id    = $('#slAppoint').val();
        items.appoint_date  = $('#txtAppointDate').val();
        items.appoint_time  = $('#txtAppointTime').val();
        items.provider_id   = $('#slAppointProvider').val();
        items.clinic_id     = $('#slAppointClinic').val();

        items.service_id      = $('#txtServiceId').val();

        if (!items.appoint_id) app.alert('กรุณาระบุกิจกรรมที่นัด');
        else if (!items.appoint_date) app.alert('กรุณาระบุวันที่นัด');
        else if (!items.appoint_time) app.alert('กรุณาระบุเวลาที่นัด');
        else if (!items.provider_id) app.alert('กรุณาระบุเจ้าหน้าที่ผู้นัด');
        else if (!items.clinic_id) app.alert('กรุณาระบุคลินิก');
        else
        {
            appoints.doSave(items, function (err) {
               if (err) app.alert(err);
               else
               {
                   $('#divNewAppoint').toggleClass('hidden');
                   appoints.getAppointList();
               };
            });
        }
    });

    appoints.getAppointList = function () {
        var service_id = $('#txtServiceId').val();
        var $table = $('#tblAppointList > tbody');

        if (!service_id) app.alert('ไม่พบรหัสรับบริการ');
        else
        {
            $table.empty();

            appoints.getList(service_id, function (err, data) {
                if (err)
                {
                    app.alert(err);
                    $table.append(
                        '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
                    );
                }
                else
                {
                    if (_.size(data.rows))
                    {
                        var i = 1;
                        _.each(data.rows, function (v) {
                            var provider_name = [v.fname, v.lname].join(' ');
                            $table.append(
                                '<tr>' +
                                '<td class="text-center">' + i + '</td>' +
                                '<td>' + v.appoint_name + ' [' + app.clearNull(v.th_name) + ']</td>' +
                                '<td class="text-center">' + app.toThaiDate(v.appoint_date) + '</td>' +
                                '<td class="text-center">' + v.appoint_time + '</td>' +
                                '<td>' + v.clinic_name + '</td>' +
                                '<td>' + provider_name + '</td>' +
                                '<td class="text-center"><a href="javascript:void(0);" class="btn btn-sm btn-danger" ' +
                                'data-name="btnAppointRemove" data-vname="' + v.appoint_name + '" data-id="' + v.id + '"><i class="fa fa-times"></i></a></td>' +
                                '</tr>'
                            );
                            i++;
                        });
                    }
                    else
                    {
                        $table.append(
                            '<tr><td colspan="7">ไม่พบรายการ</td></tr>'
                        );
                    }
                }
            });
        }
    };

    $(document).off('click', 'a[data-name="btnAppointRemove"]');
    $(document).on('click', 'a[data-name="btnAppointRemove"]', function (e) {
        e.preventDefault();

        var id = $(this).data('id'),
            name = $(this).data('vname');

        if (confirm('คุณต้องการลบรายการนี้ [' + name + '] ใช่หรือไม่?'))
        {
            appoints.doRemove(id, function (err) {
                if (err) app.alert(err);
                else appoints.getAppointList();
            });
        }
    });

    appoints.getAppointList();
});
