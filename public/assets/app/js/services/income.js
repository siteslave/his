$(function() {

    var income = {};

    income.doSave = function (items, cb) {
        app.post(serviceUrl[12], items, function (err) {
           err ? cb(err) : cb(null);
        });
    };

    income.doRemove = function (id, cb) {
        app.delete(serviceUrl[14], {id: id}, function (err) {
           err ? cb(err) : cb(null);
        });
    };


    income.getList = function (cb) {
        var service_id = $('#txtServiceId').val();

        app.get(serviceUrl[13], {service_id: service_id}, function (err, data) {
           err ? cb(err) : cb(null, data);
        });
    };

    income.clearForm = function() {
        $('#txtIncomePrice').val('');
        $('#txtIncomeQty').val('1');
        $('#txtIncomeId').val('');
        $('#txtIncomeQuery').select2('val', '');
        $('#txtIncomeQuery').select2('enable', true);
    };

    $('#btnNewIncome').on('click', function(e) {
        e.preventDefault();
        income.clearForm();
        $('#divNewIncome').toggleClass('hidden');

        $('#tblIncomeList > tbody > tr').each(function() {
            $(this).removeClass('active');
        });
    });

    $('#txtIncomeQuery').select2({
        placeholder: 'พิมพ์ชื่อรายการค่าใช้จ่า่ย',
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
            url: apiUrls[6],
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
                        id: v.id,
                        text: v.name,
                        price: v.price
                    });
                });

                return { results: myResults, more: (page * 10) < data.total };
            }
        }
    });

    $('#txtIncomeQuery').on('change', function() {
        var data = $(this).select2('data');

        if (data != null)
        {
            var price = data.price;

            $('#txtIncomePrice').val(price);
        }

    });

    $('#btnDoSaveIncome').on('click', function(e) {
        e.preventDefault();

        var data = $('#txtIncomeQuery').select2('data');

        if (data == null)
        {
            app.alert('กรุณาเลือกรายการค่าใช้จ่าย');
        }
        else
        {
            var items = {};
            items.income_id = data.id;
            items.price = $('#txtIncomePrice').val();
            items.qty = $('#txtIncomeQty').val();

            items.service_id = $('#txtServiceId').val();

            items.id = $('#txtIncomeId').val();

            if (!items.income_id) app.alert('กรุณาเลือกรายการค่าใช้จ่าย');
            else if (!items.price) app.alert('กรุณาระบุราคา');
            else if (!items.qty || items.qty == 0) app.alert('กรุณาระบุจำนวน');
            else
            {
                income.doSave(items, function (err) {
                   if (err) app.alert(err);
                   else income.getIncomeList();

                    $('#divNewIncome').toggleClass('hidden');
                });
            }
        }
    });

    income.getIncomeList = function() {
        var $table  = $('#tblIncomeList > tbody');

        $table.empty();

        income.getList(function (err, data) {
            if (err)
            {
                app.alert(err);
                $table.append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
            }
            else
            {
                if (_.size(data.rows))
                {
                    var i = 1;
                    var sumTotal = 0;

                    _.each(data.rows, function (v) {
                        var total = parseFloat(v.price) * parseInt(v.qty);

                        sumTotal += total;

                        $table.append(
                            '<tr>' +
                            '<td class="text-center">' + i + '</td>' +
                            '<td>' + v.income_name + '</td>' +
                            '<td class="text-center">' + app.clearNull(v.unit_name) + '</td>' +
                            '<td class="text-center">' + v.price + '</td>' +
                            '<td class="text-center">' + v.qty + '</td>' +
                            '<td class="text-center">' + total + '</td>' +
                            '<td class="text-center"><div class="btn-group">' +
                            '<a href="javascript:void(0);" class="btn btn-sm btn-default" ' +
                            'data-name="btnIncomeEdit" data-id="'  + v.id + '" data-qty="' + v.qty + '" ' +
                            'data-price="' + v.price + '" data-incomename="'+ v.income_name +'" data-incomeid="'+ v.income_id +'">' +
                            '<i class="fa fa-edit"></i>' +
                            '</a>' +
                            '<a href="javascript:void(0);" class="btn btn-sm btn-danger" ' +
                            'data-name="btnIncomeRemove" data-id=" '  + v.id + '"><i class="fa fa-times"></i>' +
                            '</a>' +
                            '</div></td>' +
                            '</tr>'
                        );

                        i++;
                    });

                    $table.append(
                        '<tr>' +
                        '<td colspan="5" class="text-right">รวม</td>' +
                        '<td class="text-right"><strong>' + sumTotal.toFixed(2) + '</strong></td>' +
                        '<td>&nbsp;</td>' +
                        '</tr>'
                    );
                }
                else
                {
                    $table.append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
                }
            }
        });
    };

    $(document).off('click', 'a[data-name="btnIncomeRemove"]');
    $(document).on('click', 'a[data-name="btnIncomeRemove"]', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        if (confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?'))
        {
            income.doRemove(id, function (err) {
                if (err) app.alert(err);
                else income.getIncomeList();
            });
        }
    });

    $(document).off('click', 'a[data-name="btnIncomeEdit"]');
    $(document).on('click', 'a[data-name="btnIncomeEdit"]', function (e) {
        var id = $(this).data('id'),
            income_name = $(this).data('incomename'),
            income_id = $(this).data('incomeid'),
            qty = $(this).data('qty'),
            price = $(this).data('price');

        var $tr = $(this).parent().parent().parent();

        $('#tblIncomeList > tbody > tr').each(function() {
            $(this).removeClass('active');
        });

        $tr.toggleClass('active');

        income.clearForm();

        $('#txtIncomeQuery').select2('enable', false);
        $('#txtIncomeQuery').select2('data', {id: income_id, text: income_name});
        $('#txtIncomePrice').val(price);
        $('#txtIncomeQty').val(qty);

        $('#txtIncomeId').val(id);

        $('#divNewIncome').removeClass('hidden').addClass('show');
    });

    income.getIncomeList();
});
