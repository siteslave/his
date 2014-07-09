;$(function() {

    $('#txtQueryPerson').select2({
        placeholder: 'พิมพ์ชื่อ-สกุล เลขบัตรประชาชน',
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

});