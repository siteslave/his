$(function () {

    var drugs = {};

    drugs.doSave = function (items, cb) {
        app.post(serviceUrl[15], items, function (err) {
            err ? cb(err) : cb(null);
        });
    };

    drugs.doRemove = function (id, cb) {
        app.delete(serviceUrl[17], {id: id}, function (err) {
            err ? cb(err) : cb(null);
        });
    };

    drugs.clearAll = function (service_id, cb) {
        app.delete(serviceUrl[18], {service_id: service_id}, function (err) {
            err ? cb(err) : cb(null);
        });
    };

    drugs.getList = function (cb) {
        var service_id = $('#txtServiceId').val();

        app.get(serviceUrl[16], {service_id: service_id}, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    };

    drugs.clearForm = function () {
        $('#txtDrugQuery').select2('enable', true);
        $('#txtDrugQuery').select2('val', '');
        $('#txtDrugUsage').select2('val', '');
        $('#txtDrugPrice').val('');
        $('#txtDrugQty').val('');
        $('#txtDrugId').val('');
    };

    $('#btnDrugNew').on('click', function (e) {
        e.preventDefault();
        drugs.clearForm();
        $('#divNewDrug').toggleClass('hidden');

        $('#tblDrugList > tbody > tr').each(function () {
            $(this).removeClass('active');
        });
    });

    $('#txtDrugQuery').select2({
        placeholder       : 'พิมพ์ชื่อยา',
        minimumInputLength: 2,
        allowClear        : true,
        ajax              : {
            url        : apiUrls[7],
            dataType   : 'jsonp',
            type       : 'GET',
            quietMillis: 100,

            data: function (term, page) {
                return {
                    query     : term,
                    page_limit: 10,
                    page      : page
                };
            },

            results: function (data, page) {
                var myResults = [];
                $.each(data.rows, function (i, v) {
                    myResults.push({
                        id   : v.id,
                        text : v.name,
                        price: v.price
                    });
                });

                return {results: myResults, more: (page * 10) < data.total};
            }
        }
    });

    $('#txtDrugUsage').select2({
        placeholder       : 'พิมพ์รหัสการใช้ยา',
        minimumInputLength: 2,
        allowClear        : true,
        ajax              : {
            url        : apiUrls[8],
            dataType   : 'jsonp',
            type       : 'GET',
            quietMillis: 100,

            data: function (term, page) {
                return {
                    query     : term,
                    page_limit: 10,
                    page      : page
                };
            },

            results: function (data, page) {
                var myResults = [];
                $.each(data.rows, function (i, v) {
                    myResults.push({
                        id  : v.id,
                        text: v.code
                    });
                });

                return {results: myResults, more: (page * 10) < data.total};
            }
        }
    });

    $('#txtDrugQuery').on('change', function () {
        var data = $(this).select2('data');

        if (data != null) {
            var price = data.price;

            $('#txtDrugPrice').val(price);
            $('#txtDrugQty').val('1');
        }
    });

    drugs.getDrugList = function () {
        var $table = $('#tblDrugList > tbody');

        $table.empty();

        drugs.getList(function (err, data) {
            if (err) {
                app.alert(err);
                $table.append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
            }
            else {
                if (_.size(data.rows)) {
                    var i = 1;
                    var sumTotal = 0;

                    _.each(data.rows, function (v) {
                        var total = parseInt(v.qty) * parseFloat(v.price);

                        sumTotal += total;
                        $table.append(
                            '<tr>' +
                            '<td class="text-center">' + i + '</td>' +
                            '<td>' + app.clearNull(v.drug_name) + '</td>' +
                            '<td>' + app.clearNull(v.usage_name) + '</td>' +
                            '<td class="text-center">' + numeral(v.price).format('0,0.00') + '</td>' +
                            '<td class="text-center">' + v.qty + '</td>' +
                            '<td class="text-center">' + numeral(total).format('0,0.00') + '</td>' +
                            '<td class="text-center"><div class="btn-group">' +
                            '<a href="javascript:void(0);" class="btn btn-sm btn-default" ' +
                            'data-name="btnDrugEdit" data-id="' + v.id + '" data-drugname="' + v.drug_name + '" ' +
                            'data-qty="' + v.qty + '" data-price="' + v.price + '" data-usageid="' + v.usage_id + '"' +
                            'data-usagename="' + v.usage_name + '" data-drugid="' + v.drug_id + '">' +
                            '<i class="fa fa-edit"></i>' +
                            '</a>' +
                            '<a href="javascript:void(0);" class="btn btn-sm btn-danger" ' +
                            'data-name="btnDrugRemove" data-id="' + v.id + '" data-vname="' + v.drug_name + '">' +
                            '<i class="fa fa-times"></i>' +
                            '</a>' +
                            '</div></td>' +
                            '</tr>'
                        );

                        i++;
                    });

                    $table.append('<tr>' +
                    '<td colspan="5" class="text-right">รวม</td>' +
                    '<td class="text-center"><strong>' + numeral(sumTotal).format('0,0.00') + '</strong></td>' +
                    '<td>&nbsp;</td>' +
                    '</tr>');
                }
                else {
                    $table.append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
                }
            }
        });
    };

    $(document).off('click', 'a[data-name="btnDrugRemove"]');

    $(document).on('click', 'a[data-name="btnDrugRemove"]', function (e) {
        e.preventDefault();

        var id = $(this).data('id'),
            name = $(this).data('vname');

        if (confirm('คุณต้องการลบรายการนี้ [' + name + '] ใช่หรือไม่?')) {
            drugs.doRemove(id, function (err) {
                if (err) app.alert(err);
                else drugs.getDrugList();
            })
        }
    });

    $('#btnDoSaveDrug').on('click', function (e) {
        e.preventDefault();

        var drug = $('#txtDrugQuery').select2('data');
        var usage = $('#txtDrugUsage').select2('data');
        var id = $('#txtDrugId').val();

        if (drug == null) app.alert('กรุณาระบุรายการยา');
        else if (usage == null) app.alert('กรุณาระบุวิธีการใช้ยา');
        else {
            var items = {};

            items.id = id;
            items.drug_id = drug.id;
            items.usage_id = usage.id;
            items.price = $('#txtDrugPrice').val();
            items.qty = $('#txtDrugQty').val();
            items.service_id = $('#txtServiceId').val();

            if (!items.drug_id) app.alert('ไม่พบรายการยา กรุณาเลือกรายการยา');
            else if (!items.usage_id) app.alert('กรุณาเลือกวิธีการใช้ยา');
            else if (!items.price) app.alert('กรุณาระบุราคา');
            else if (!items.qty) app.alert('กรุณาระบุจำนวน');
            else {
                drugs.doSave(items, function (err) {
                    if (err) app.alert(err);
                    else {
                        $('#divNewDrug').toggleClass('hidden');
                        drugs.getDrugList();
                    }
                });
            }
        }
    });

    //clear all drug
    $('#btnDrugClear').on('click', function (e) {
        e.preventDefault();

        var service_id = $('#txtServiceId').val();

        if (confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่?')) {
            drugs.clearAll(service_id, function (err) {
                if (err) app.alert(err);
                else drugs.getDrugList();
            });
        }
    });

    //edit drug
    $(document).off('click', 'a[data-name="btnDrugEdit"]');
    $(document).on('click', 'a[data-name="btnDrugEdit"]', function (e) {
        var id = $(this).data('id'),
            drug_name = $(this).data('drugname'),
            drug_id = $(this).data('drugid'),
            usage_id = $(this).data('usageid'),
            usage_name = $(this).data('usagename'),
            qty = $(this).data('qty'),
            price = $(this).data('price');

        var $tr = $(this).parent().parent().parent();

        $('#tblDrugList > tbody > tr').each(function () {
            $(this).removeClass('active');
        });

        $tr.toggleClass('active');

        drugs.clearForm();

        $('#txtDrugQuery').select2('enable', false);
        $('#txtDrugQuery').select2('data', {id: drug_id, text: drug_name});
        $('#txtDrugUsage').select2('data', {id: usage_id, text: usage_name});
        $('#txtDrugPrice').val(price);
        $('#txtDrugQty').val(qty);

        $('#txtDrugId').val(id);

        $('#divNewDrug').removeClass('hidden').addClass('show');
    });

    drugs.getDrugList();

});
