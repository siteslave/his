$(function() {
    var preg = {};

    preg.target = $('#content');

    preg.setActive = function (obj) {
        $('#collapseMain a').each(function () {
            var $this = $(this);

            $this.removeClass('list-group-item-success');
        });

        $('#collapseTools a').each(function () {
            var $this = $(this);

            $this.removeClass('list-group-item-success');
        });

        obj.addClass('list-group-item-success');
    };

    $('a[href="#list"]').on('click', function() {
        preg.setActive($(this));
        app.loadPage({
            target: preg.target,
            url: pageUrl[0],
            //params: {},
            scripts: [scriptUrl[0]]
        });
    });

    $('a[href="#search"]').on('click', function() {
        preg.setActive($(this));
        app.loadPage({
            target: preg.target,
            url: pageUrl[1],
            //params: {},
            scripts: [scriptUrl[1]]
        });
    });

    //Turn off click event.
    $(document).off('click', 'a[data-name="btnAcceptPerson"]');

    //Turn on click event.
    $(document).on('click', 'a[data-name="btnAcceptPerson"]', function (e) {
        e.preventDefault();
        var sex = $(this).data('sex');

        if (sex == '1') {
            app.alert('เป็นเพศชายไม่สามารถลงทะเบียนได้');
        } else {
            //Confirm
            var person_id = $(this).data('person_id'),
                gravida = prompt('กรุณาระบุครรภ์ที่', '1'),
                res = confirm('คุณต้องการลงทะเบียน ใช่หรือไม่?');

            if (res) {
                var items = {};
                items.person_id = person_id;
                items.gravida = gravida;

                if (!gravida || parseInt(gravida) < 0 || parseInt(gravida) > 10) {
                    app.alert('กรุณาตรวจสอบลำดับที่ในการตั้งครรครั้งนี้ว่าถูกหรือไม่');
                } else if (!person_id) {
                    app.alert('ไม่พบรหัสบุคคล (Person ID)');
                } else {
                    preg.doRegister(items, function (err) {
                        if (err) {
                            app.alert(err);
                        } else {
                            app.alert('ลงทะเบียนเสร็จเรียบร้อยแล้ว');
                            preg.modal.hideSearchPerson();

                            app.loadPage({
                                target: preg.target,
                                url: pageUrl[0],
                                //params: {},
                                scripts: [scriptUrl[0]]
                            });

                            preg.setActive($('a[href="#list"]'));
                        }
                    });
                }
            }
        }
    });


    preg.modal = {
        showSearchPerson: function () {
            $('#modalSearchPerson').modal({
                backdrop: 'static',
                keyboard: false
            });
        },

        hideSearchPerson: function () {
            $('#modalSearchPerson').modal('hide');
        }
    };

    $('#modalSearchPerson').on('show.bs.modal', function (e) {
        $('#tblSearchPersonResult > tbody')
            .empty()
            .append('<tr><td colspan="8">กรุณาระบุคำค้นหา</td></tr>');
        $('#txtQueryPerson').val('');
    });

    preg.doSearchPerson = function (query, cb) {
        app.get(apiUrls[2], {query: query}, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    };

    preg.searchPerson = function () {

        var query = $('#txtQueryPerson').val(),
            $table = $('#tblSearchPersonResult > tbody');

        $table.empty();

        if (query) {
            preg.doSearchPerson(query, function (err, data) {
                if (err) {
                    $table.append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
                }
                else {
                    if (_.size(data.rows)) {
                        preg.setSearchResult(data.rows);
                    }
                    else {
                        $table.append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
                    }
                }
            });

        }
        else {
            app.alert('กรุณาระบุคำที่ต้องการค้นหา');
            $table.append('<tr><td colspan="8">กรุณาระบุคำค้นหา</td></tr>');
        }
    };

    preg.setSearchResult = function (data) {
        var $table = $('#tblSearchPersonResult > tbody');

        _.each(data, function (v) {
            var sex = v.sex == '1' ? 'ชาย' : 'หญิง',
                birthdate = app.toThaiDate(v.birthdate),
                age = app.countAge(v.birthdate),
                age = age.year + ' ปี ' + age.month + ' เดือน ' + age.date + ' วัน';

            var html = [
                '<tr>',
                '<td>' + v.cid + '</td>',
                '<td>' + v.fullname + '</td>',
                '<td>' + sex + '</td>',
                '<td>' + birthdate + '</td>',
                '<td>' + age + '</td>',
                '<td>' + v.address + '</td>',
                '<td><span class="text-danger">' + v.typearea + '</span></td>',
                '<td>',
                '<a href="#" class="btn btn-sm btn-primary" data-name="btnAcceptPerson" ',
                'data-person_id="' + v.person_id + '" data-sex="' + v.sex + '">',
                '<i class="fa fa-check"></i>',
                '</a>',
                '</td>',
                '</tr>'
            ].join('');

            $table.append(html);
        });
    };

    preg.doRegister = function (params, cb) {
        app.post(actionUrl[0], params, function (err) {
            err ? cb(err) : cb(null);
        });
    };

    $('#txtQueryPerson').on('keypress', function (e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);

        if (keycode == 13)
            preg.searchPerson();
    });

    $('#btnDoSearchPerson').on('click', function (e) {
        e.preventDefault();
        preg.searchPerson();
    });

    $('#btnShowSearchPerson').on('click', function (e) {
        e.preventDefault();
        preg.modal.showSearchPerson();
    });

    app.loadPage({
        target: preg.target,
        url: pageUrl[0],
        //params: {},
        scripts: [scriptUrl[0]]
    });

});
