/**
 * Edit person script
 */
$(function() {

    $('#txtInsHospmain').select2({
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

    $('#txtInsHospsub').select2({
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

    //set initial data
    var hospmain_id   = $('#txtInsHospmain').data('id'),
        hospmain_text = $('#txtInsHospmain').data('text'),
        hospsub_id    = $('#txtInsHospsub').data('id'),
        hospsub_text  = $('#txtInsHospsub').data('text');

    $('#txtInsHospmain').select2('data', {id : hospmain_id, text: '[' + hospmain_id + '] ' + hospmain_text});
    $('#txtInsHospsub').select2('data', {id  : hospsub_id, text: '[' + hospsub_id + '] ' + hospsub_text});

});
