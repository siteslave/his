$(function () {

    var anc = {};

    anc.doSaveCoverage = function (items, cb) {
        app.post(actionUrl[3], items, function(err, data) {
            if (err) {
                cb(err);
            } else {
                cb(null, data.id);
            }
        });
    };

    anc.doRemoveCoverage = function (id, cb) {
        app.delete(actionUrl[4], { id: id }, function (err) {
            if (err) {
                cb(err);
            } else {
                cb(null);
            }
        });
    };

    anc.modal = {
        showAncOther: function() {
            $('#modalAncOther').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    };

    $('#btnShowAncOther').on('click', function(e) {
        e.preventDefault();
        anc.modal.showAncOther();
    });

    $('#txtAncCoverPlace').select2({
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

    $('#btnAncCoverSave').on('click', function(e) {
        e.preventDefault();

        var items = {};

        items.ga = $('#txtAncCoverGa').val();
        items.gravida = $('#txtGravida').val();
        items.person_id = $('#txtPersonId').val();
        items.anc_result = $('#slAncCoverResult').val();
        items.service_date = $('#txtAncCoverDate').val();
        items.service_place = $('#txtAncCoverPlace').val();

        if (!items.ga) app.alert('กรุณาระบุอายุครรภ์');
        else if (!items.service_date) app.alert('กรุณาระบุวันที่รับบริการ');
        else if (!items.anc_result) app.alert('กรุณาระบุผลการตรวจ');
        else if (!items.service_place) app.alert('กรุณาระบุสถานพยาบาลที่ให้บริการ');
        else {
            anc.doSaveCoverage(items, function(err, id) {
                if (err) {
                    app.alert(err);
                } else {
                    var $table = $('#tblAncCoverages').find('tbody'),
                        anc_result_text = $('#slAncCoverResult').find('option:selected').text(),
                        hospital = $('#txtAncCoverPlace').select2('data'),
                        hospital_name = hospital.text,

                        html = [
                            '<tr>',
                            '<td class="text-center">' + app.jsToThaiDate(items.service_date) + '</td>',
//                            '<td class="text-center">' + items.gravida + '</td>',
                            '<td class="text-center">' + items.ga + '</td>',
                            '<td class="text-center">' + anc_result_text + '</td>',
                            '<td class="text-center">' + hospital_name + '</td>',
                            '<td class="text-center">',
                            '<a href="#" class="btn btn-danger btn-sm" data-name="btnAncCoverageRemove" data-id="' + id + '">',
                            '<i class="fa fa-times"></i></a>',
                            '</td>',
                            '</tr>'
                        ].join('');

                    $table.append(html);

                    $('#modalAncOther').modal('hide');
                }
            });
        }
    });

    $(document).off('click', 'a[data-name="btnAncCoverageRemove"]');
    $(document).on('click', 'a[data-name="btnAncCoverageRemove"]', function(e) {
        e.preventDefault();

        var id = $(this).data('id'),
            $tr = $(this).parent().parent();

        if (confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่?')) {
            anc.doRemoveCoverage(id, function (err) {
               if (err) {
                   app.alert(err);
               } else {
                   $tr.fadeOut();
               }
            });
        }
    });
});