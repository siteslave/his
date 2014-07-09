;$(function () {

    var postnatal = {};

    postnatal.doSaveCoverage = function (items, cb) {
        app.post(actionUrl[5], items, function(err, data) {
            if (err) {
                cb(err);
            } else {
                cb(null, data.id);
            }
        });
    };

    postnatal.doRemoveCoverage = function (id, cb) {
        app.delete(actionUrl[6], { id: id }, function (err) {
            if (err) {
                cb(err);
            } else {
                cb(null);
            }
        });
    };

    postnatal.modal = {
        showPostnatalOther: function() {
            $('#modalPostnatalOther').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    };

    $('#btnShowPostnatalOther').on('click', function(e) {
        e.preventDefault();
        postnatal.modal.showPostnatalOther();
    });

    $('#txtPostnatalCoverPlace').select2({
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

    $('#btnPostnatalCoverSave').on('click', function(e) {
        e.preventDefault();

        var items = {};

        items.gravida = $('#txtGravida').val();
        items.person_id = $('#txtPersonId').val();
        items.result = $('#slPostnatalCoverResult').val();
        items.service_date = $('#txtPostnatalCoverDate').val();
        items.service_place = $('#txtPostnatalCoverPlace').val();

        if (!items.service_date) app.alert('กรุณาระบุวันที่รับบริการ');
        else if (!items.result) app.alert('กรุณาระบุผลการตรวจ');
        else if (!items.service_place) app.alert('กรุณาระบุสถานพยาบาลที่ให้บริการ');
        else {
            postnatal.doSaveCoverage(items, function(err, id) {
                if (err) {
                    app.alert(err);
                } else {
                    var $table = $('#tblPostnatalCoverages').find('tbody'),
                        result_text = $('#slPostnatalCoverResult').find('option:selected').text(),
                        hospital = $('#txtPostnatalCoverPlace').select2('data'),
                        hospital_name = hospital.text,

                        html = [
                            '<tr>',
                            '<td class="text-center">' + app.jsToThaiDate(items.service_date) + '</td>',
//                            '<td class="text-center">' + items.gravida + '</td>',
                            '<td class="text-center">' + result_text + '</td>',
                            '<td>' + hospital_name + '</td>',
                            '<td class="text-center">',
                            '<a href="#" class="btn btn-danger btn-sm" data-name="btnPostnatalCoverageRemove" data-id="' + id + '">',
                            '<i class="fa fa-times"></i></a>',
                            '</td>',
                            '</tr>'
                        ].join('');

                    $table.append(html);

                    $('#modalPostnatalOther').modal('hide');
                }
            });
        }
    });

    $(document).off('click', 'a[data-name="btnPostnatalCoverageRemove"]');
    $(document).on('click', 'a[data-name="btnPostnatalCoverageRemove"]', function(e) {
        e.preventDefault();

        var id = $(this).data('id'),
            $tr = $(this).parent().parent();

        if (confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่?')) {
            postnatal.doRemoveCoverage(id, function (err) {
               if (err) {
                   app.alert(err);
               } else {
                   $tr.fadeOut();
               }
            });
        }
    });
});