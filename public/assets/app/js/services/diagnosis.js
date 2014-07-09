$(function() {
    //namespace
    var services = {};
    services.diag = {};
    // Save diag
    services.diag.doSave = function (items, cb) {
        app.post(serviceUrl[4], items, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    };
    // Remove diag
    services.diag.doRemove = function (id, cb) {
        app.delete(serviceUrl[5], { id: id }, function (err) {
           err ? cb(err) : cb(null);
        });
    };
    // Show new row for add diag
    $('#btnDiagNew').on('click', function(e) {
        e.preventDefault();
        $('tr#trAddDiag').toggleClass('hidden');
    });
    // Search diag
    $('#txtDiagQuery').select2({
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
    // Save diag
    $('#btnDiagSave').on('click', function (e) {
        e.preventDefault();

        var diag = $('#txtDiagQuery').select2('data'),
            diag_type = $('#slDiagType').val();


        if (diag == null) app.alert('กรุณาเลือกการวินิจฉัย');
        else if (!diag_type) app.alert('กรุณาระบุประเภทการวินิจฉัย');
        else
        {
            var items = {};
            items.service_id = $('#txtServiceId').val();
            items.diagnosis_code = diag.id;
            items.diagnosis_type_code = diag_type;

            services.diag.doSave(items, function (err, data) {
               if (err) app.alert(err);
               else
               {
                   $('tr#trAddDiag').toggleClass('hidden');

                   var diagType = $('#slDiagType option:selected').text();

                   $('#tblDiagList > tbody').append(
                     '<tr>' +
                     '<td class="text-center">' + diag.id + '</td>' +
                     '<td>' + diag.text + '</td>' +
                     '<td>' + diagType + '</td>' +
                     '<td class="text-center">' +
                     '<a href="javascript:void(0);" data-name="btnRemoveDiag" class="btn btn-sm btn-danger" ' +
                     'data-id="' + data.id + '"><i class="fa fa-times"></i></a>' +
                     '</td>' +
                     '</tr>'
                   );

                   $('#txtDiagQuery').select2('val', '');
               }
            });
        }

    });
    //disable double events
    $(document).off('click', 'a[data-name="btnRemoveDiag"]');
    //remove diag
    $(document).on('click', 'a[data-name="btnRemoveDiag"]', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var $table = $(this).parent().parent();

        if (confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?'))
        {
            services.diag.doRemove(id, function (err) {
               if (err)
               {
                   app.alert(err);
               }
               else
               {
                   $table.fadeOut('slow');
               }
            });
        }
    });
});
