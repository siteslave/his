/**
 * Service index script
 */

$(function() {
    var services = services || {};

    services.index = {};

    services.index.modal = {
        showSearch: function() {
            $('#modalSearch').modal({
                backdrop: 'static',
                keyboard: false
            });
        },
        hideSearch: function() {
            $('#modalSearch').modal('hide');
        }
    };

    services.index.setVisitList = function(data) {

        var $table = $('#tblVisitList > tbody');

        if (_.size(data.rows))
        {
            _.each(data.rows, function (v) {
                var age = app.countAge(v.birthdate);
                $table.append(
                    '<tr>' +
                    '<td class="text-center">' + app.toThaiDate(v.service_date) + '</td>' +
                    '<td class="text-center">' + v.cid + '</td>' +
                    '<td>' + v.fullname + '</td>' +
                    '<td class="visible-lg text-center">' + age.year + '-' + age.month + '-' + age.date + '</td>' +
                    '<td class="visible-lg">' + app.stripped(v.ins_name, 20) + '</td>' +
                    '<td>' + app.stripped(v.cc, 20) + '</td>' +
                    '<td>' + app.stripped(v.diag, 30) + '</td>' +
                    '<td>' + v.provider_name + '</td>' +
                    '<td>' +
                    '<a href="' + base_url + '/services/entries/' + v.visit_id + '" ' +
                    'class="btn btn-sm btn-primary"><i class="fa fa-sign-out"></i>' +
                    '</a>' +
                    '</td>' +
                    '</tr>'
                );
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
    };
    services.index.getList = function() {
        var startDate = $('#txtStartDate').val(),
            endDate = $('#txtEndDate').val(),
            clinic = $('#slClinic').val();

        var $table = $('#tblVisitList > tbody');

        $table.empty();

        if (startDate && endDate)
        {
            var params = {
                startDate: startDate,
                endDate: endDate,
                clinic: clinic
            };

            app.get('/services/list', params, function (err, data) {
               if (!err)
               {
                   services.index.setVisitList(data);
               }
                else
               {
                   $table.append(
                       '<tr>' +
                       '<td colspan="9">ไม่พบรายการ</td>' +
                       '</tr>'
                   );
               }
            });
        }
        else
        {
            app.alert('กรุณาระบุวันที่เริ่มต้นและสิ้นสุด');
        }
    };

    services.index.searchVisit = function (pid) {

        var $table = $('#tblVisitList > tbody');

        $table.empty();

        app.get('/services/search', { pid: pid }, function (err, data) {
            if (!err)
            {
                services.index.setVisitList(data);
                services.index.modal.hideSearch();
            }
            else
            {
                $table.append(
                    '<tr>' +
                    '<td colspan="9">ไม่พบรายการ</td>' +
                    '</tr>'
                );
            }
        });
    };

    $('#btnVisitFilter').on('click', function (e) {
        e.preventDefault();

        services.index.getList();
    });

    //search visit
    $('#btnSearchVisit').on('click', function(e) {
        e.preventDefault();
        services.index.modal.showSearch();
    });

    $('#txtQuery').select2({
        placeholder: 'ชื่อ หรือ รหัสสถานบริการ',
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
            url: '/api/search/person',
            dataType: 'jsonp',
            type: 'GET',
            quietMillis: 100,

            data: function (term) {
                return {
                    query: term
                };
            },

            results: function (data, page) {
                var myResults = [];
                $.each(data.rows, function (i, v) {
                    myResults.push({
                        id: v.person_id,
                        text: '[' + v.cid + '] ' + v.fullname
                    });
                });

                return { results: myResults };
            }
        }
    });

    $('#btnSelectedPerson').on('click', function(e) {
        e.preventDefault();

        var data = $('#txtQuery').select2('data');
        var pid = data.id;

        services.index.searchVisit(pid);
    });
    //get list
    services.index.getList();
});
