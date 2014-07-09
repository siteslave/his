$(function() {

    var procedure = {};

    procedure.doSave = function (items, cb) {
        app.post(serviceUrl[6], items, function(err) {
           err ? cb(err) : cb(null);
        });
    };

    procedure.doSaveDental = function (items, cb) {
        app.post(serviceUrl[9], items, function (err) {
           err ? cb(err) : cb(null);
        });
    };

    procedure.getList = function(cb) {
        var service_id = $('#txtServiceId').val();

        app.get(serviceUrl[7], {service_id: service_id}, function(err, data) {
            err ? cb(err) : cb(null, data);
        });
    };

    procedure.getDentalList = function(cb) {
        var service_id = $('#txtServiceId').val();

        app.get(serviceUrl[10], {service_id: service_id}, function(err, data) {
            err ? cb(err) : cb(null, data);
        });
    };

    procedure.doRemove = function(id, cb) {
        app.delete(serviceUrl[8], {id: id}, function (err) {
           err ? cb(err) : cb(null);
        });
    };

    procedure.doRemoveDental = function(id, cb) {
        app.delete(serviceUrl[11], {id: id}, function (err) {
           err ? cb(err) : cb(null);
        });
    };

    procedure.modal = {
        showProcedure: function() {
            $('#modalProcedure').modal({
                backdrop: 'static',
                keyboard: false
            });
        },

        showProcedureDental: function() {
            $('#modalProcedureDental').modal({
                backdrop: 'static',
                keyboard: false
            });
        },

        hideProcedure: function() {
            $('#modalProcedure').modal('hide');
        },

        hideProcedureDental: function() {
            $('#modalProcedureDental').modal('hide');
        }
    };

    // Clear form
    procedure.clearForm = function() {
        $('#txtProcedureQuery').select2('val', '');
        $('#slProcedureProvider').val('');
        $('#slProcedurePosition').val('');
        $('#txtProcedureStartTime').val('');
        $('#txtProcedureFinishedTime').val('');
        $('#txtProcedurePrice').val('');
    };

    procedure.clearDentalForm = function() {
        $('#slProcedureDentalProvider').val('');
        $('#txtProcedureDentalQuery').select2('val', '');
        $('#txtProcedureDentalTCode').val('');
        $('#txtProcedureDentalTCount').val('');
        $('#txtProcedureDentalRCount').val('');
        $('#txtProcedureDentalDCount').val('');
        $('#txtProcedureDentalPrice').val('');
    };
    // Event for modal when hidden
    $('#modalProcedure').on('hidden.bs.modal', function() {
        procedure.clearForm();
    });
    // Event for modal when hidden
    $('#modalProcedureDental').on('hidden.bs.modal', function() {
        procedure.clearDentalForm();
    });

    $('button[data-name="btnNewProcedure"]').on('click', function(e) {
        e.preventDefault();
        procedure.modal.showProcedure();
    });

    $('button[data-name="btnNewProcedureDental"]').on('click', function(e) {
        e.preventDefault();
        procedure.modal.showProcedureDental();
    });

    $('#txtProcedureQuery').select2({
        placeholder: 'ชื่อหัตถการ',
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
            url: apiUrls[4],
            dataType: 'jsonp',
            type: 'GET',
            quietMillis: 100,

            data: function (term, page) {
                return {
                    query: term,
                    page_limit: 10,
                    page: page,
                    t: 1
                };
            },

            results: function (data, page) {
                var myResults = [];
                $.each(data.rows, function (i, v) {
                    myResults.push({
                        id: v.id,
                        text: v.name,
                        price: v.price
                    });
                });

                return { results: myResults, more: (page * 10) < data.total };
            }
        }
    });

    $('#txtProcedureDentalQuery').select2({
        placeholder: 'ชื่อหัตถการ',
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
            url: apiUrls[4],
            dataType: 'jsonp',
            type: 'GET',
            quietMillis: 100,

            data: function (term, page) {
                return {
                    query: term,
                    page_limit: 10,
                    page: page,
                    t: 2
                };
            },

            results: function (data, page) {
                var myResults = [];
                $.each(data.rows, function (i, v) {
                    myResults.push({
                        id: v.id,
                        text: v.name,
                        price: v.price
                    });
                });

                return { results: myResults, more: (page * 10) < data.total };
            }
        }
    });

    $('#txtProcedureQuery').on('change', function() {
        var data = $(this).select2('data');

        if (data != null)
        {
            var id = data.id,
                price = data.price ? data.price : 0;

            $('#txtProcedurePrice').val(price);
            //get position
            app.get(apiUrls[5], {id: id}, function(err, data) {
               if(!err)
               {
                  var $slPosition = $('#slProcedurePosition');

                   $slPosition.empty();

                   _.each(data.rows, function(v) {
                        $slPosition.append(
                            '<option value="' + v.id + '">' + v.name + ' [' + v.icd10tm + ']</option>'
                        );
                   });
               }
            });
        }

    });

    $('#txtProcedureDentalQuery').on('change', function() {
        var data = $(this).select2('data');

        if (data != null)
        {
            var price = data.price ? data.price : 0;

            $('#txtProcedureDentalPrice').val(price);
        }

    });

    //do save
    $('#btnProcedureSave').on('click', function(e) {
        e.preventDefault();

        var proced = $('#txtProcedureQuery').select2('data'),
            provider_id = $('#slProcedureProvider').val(),
            position_id = $('#slProcedurePosition').val(),
            start_time = $('#txtProcedureStartTime').val(),
            finished_time = $('#txtProcedureFinishedTime').val(),
            price = $('#txtProcedurePrice').val(),
            service_id = $('#txtServiceId').val();

        if (!provider_id)
        {
            app.alert('กรุณาเลือกผู้ทำหัตถการ');
        }
        else if (proced == null)
        {
            app.alert('กรุณาเลือกหัตถการ');
        }
        else if (!start_time)
        {
            app.alert('กรุณาระบุเวลาเริ่มต้นทำกิจกรรม');
        }
        else if (!finished_time)
        {
            app.alert('กรุณาระบุเวลาสิ้นสุดการทำกิจกรรม');
        }
        else if (!price)
        {
            app.alert('กรุณาระบุราคา');
        }
        else
        {
            var items = {};
            items.service_id    = service_id;
            items.procedure_id  = proced.id;
            items.provider_id   = provider_id;
            items.position_id   = position_id;
            items.start_time    = start_time;
            items.finished_time = finished_time;
            items.price         = price;

            procedure.doSave(items, function (err) {
               if (err)
               {
                   app.alert(err);
               }
                else
               {
                   procedure.getProcedureList();
                   procedure.modal.hideProcedure();
               }
            });
        }
    });

    procedure.getProcedureList = function() {
        var $table = $('#tblProcedureList > tbody');

        $table.empty();

        procedure.getList(function(err, data) {
            if(err)
            {
                app.alert(err);
                $table.append(
                    '<tr>' +
                    '<td colspan="8">ไม่พบรายการ</td>' +
                    '</tr>'
                );
            }
            else
            {
                if (_.size(data.rows))
                {
                    var i = 1;
                    _.each(data.rows, function(v) {
                        var provider_name = [v.fname, v.lname].join(' ');
                        $table.append(
                            '<tr>' +
                            '<td>' + i + '</td>' +
                            '<td>' + v.procedure_name + '</td>' +
                            '<td>' + app.clearNull(v.position_name) + '</td>' +
                            '<td class="text-center">' + v.price + '</td>' +
                            '<td class="text-center visible-lg visible-md">' + v.start_time + '</td>' +
                            '<td class="text-center visible-lg visible-md">' + v.finished_time + '</td>' +
                            '<td>' + app.clearNull(provider_name) + '</td>' +
                            '<td class="text-center">' +
                            '<a href="javascript:void(0);" class="btn btn-sm btn-danger" data-name="btnProcedureRemove"' +
                            ' data-id="' + v.id + '">' +
                            '<i class="fa fa-times"></i>' +
                            '</a>' +
                            '</td>' +
                            '</tr>'
                        );

                        i++;
                    });
                }
                else
                {
                    $table.append(
                        '<tr>' +
                        '<td colspan="8">ไม่พบรายการ</td>' +
                        '</tr>'
                    );
                }
            }
        });
    };
    /**
     * Procedure dental list
     */
    procedure.getProcedureDentalList = function() {
        var $table = $('#tblProcedureDentalList > tbody');

        $table.empty();

        procedure.getDentalList(function(err, data) {
            if(err)
            {
                app.alert(err);
                $table.append(
                    '<tr>' +
                    '<td colspan="9">ไม่พบรายการ</td>' +
                    '</tr>'
                );
            }
            else
            {
                if (_.size(data.rows))
                {
                    var i = 1;
                    _.each(data.rows, function(v) {
                        var provider_name = [v.fname, v.lname].join(' ');
                        $table.append(
                            '<tr>' +
                            '<td>' + i + '</td>' +
                            '<td>' + v.procedure_name + '</td>' +
                            '<td class="text-center">' + v.price + '</td>' +
                            '<td class="text-center">' + v.tcode + '</td>' +
                            '<td class="text-center">' + v.tcount + '</td>' +
                            '<td class="text-center visible-lg visible-md">' + v.dcount + '</td>' +
                            '<td class="text-center visible-lg visible-md">' + v.rcount + '</td>' +
                            '<td>' + app.clearNull(provider_name) + '</td>' +
                            '<td class="text-center">' +
                            '<a href="javascript:void(0);" class="btn btn-sm btn-danger" data-name="btnProcedureDentalRemove"' +
                            ' data-id="' + v.id + '">' +
                            '<i class="fa fa-times"></i>' +
                            '</a>' +
                            '</td>' +
                            '</tr>'
                        );

                        i++;
                    });
                }
                else
                {
                    $table.append(
                        '<tr>' +
                        '<td colspan="9">ไม่พบรายการ</td>' +
                        '</tr>'
                    );
                }
            }
        });
    };

    $(document).off('click', 'a[data-name="btnProcedureRemove"]');

    $(document).on('click', 'a[data-name="btnProcedureRemove"]', function (e) {
        e.preventDefault();

        var id = $(this).data('id');

        if (confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?'))
        {
            procedure.doRemove(id, function (err) {
               if (err)
               {
                   app.alert(err);
               }
                else
               {
                   app.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                   procedure.getProcedureList();
               }
            });
        }
    });

    $(document).off('click', 'a[data-name="btnProcedureDentalRemove"]');

    $(document).on('click', 'a[data-name="btnProcedureDentalRemove"]', function (e) {
        e.preventDefault();

        var id = $(this).data('id');

        if (confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?'))
        {
            procedure.doRemoveDental(id, function (err) {
               if (err)
               {
                   app.alert(err);
               }
                else
               {
                   procedure.getProcedureDentalList();
               }
            });
        }
    });

    $('#btnProcedureDentalSave').on('click', function() {
        var items = {};
        var proceds = $('#txtProcedureDentalQuery').select2('data');

        if (proceds == null)
        {
            app.alert('กรุณาระบุหัตถการ');
        }
        else
        {
            items.provider_id = $('#slProcedureDentalProvider').val();
            items.procedure_id = proceds.id;
            items.tcode = $('#txtProcedureDentalTCode').val();
            items.tcount = $('#txtProcedureDentalTCount').val();
            items.rcount = $('#txtProcedureDentalRCount').val();
            items.dcount = $('#txtProcedureDentalDCount').val();
            items.price = $('#txtProcedureDentalPrice').val();

            items.service_id = $('#txtServiceId').val();

            if (!items.provider_id) app.alert('กรุณาระบุผู้ทำหัตถการ');
            else if (!items.procedure_id) app.alert('กรุณาระบุหัตถการ');
            else if (!items.price) app.alert('กรุณาระบุราคา');
            else
            {
                procedure.doSaveDental(items, function (err) {
                   if (err) app.alert(err);
                   else
                   {
                       procedure.getProcedureDentalList();
                       procedure.modal.hideProcedureDental();
                   }
                });
            }
        }

    });

    procedure.getProcedureList();
    procedure.getProcedureDentalList();
});
