/**
 * Register service script
 */
$(function() {
    /**
     * Namespace
     * @type    Object
     */
    var services = services || {};
    services.register = {};

    services.register.modal = {
        showSearchModal: function () {
            $('#modalSearchPerson').modal({
                backdrop: 'static',
                keyboard: false
            });
        },

        hideSearchModal: function () {
            $('#modalSearchPerson').modal('hide');
        }
    };
    /**
     * Set search result
     * @param data
     */
    services.register.setSearchResult = function (data) {

        var $table = $('#tblSearchPersonResult > tbody');

        _.each(data.rows, function (v) {
            var sex = v.sex == '1' ? 'ชาย' : 'หญิง',
                birthdate = app.toThaiDate(v.birthdate),
                age = app.countAge(v.birthdate),
                age = age.year + ' ปี ' + age.month + ' เดือน ' + age.date + ' วัน';
            $table.append(
                '<tr>' +
                '<td>' + v.cid + '</td>' +
                '<td>' + v.fullname + '</td>' +
                '<td>' + sex + '</td>' +
                '<td>' + birthdate + '</td>' +
                '<td>' + age  + '</td>' +
                '<td>' + v.address + '</td>' +
                '<td>' +
                '<a href="#" class="btn btn-primary" data-name="btnAcceptPerson" ' +
                'data-pid="' + v.person_id + '" data-cid="' + v.cid + '" data-fullname="' + v.fullname + '" ' +
                'data-typearea="' + v.typearea + '" data-birthdate="' + birthdate + '" data-age="' + age + '" ' +
                'data-address="' + v.address + '">' +
                '<i class="fa fa-check"></i>' +
                '</a>' +
                '</td>' +
                '</tr>'
            );
        });
    };

    /**
     * Select person for new service.
     */
    $(document).on('click', 'a[data-name="btnAcceptPerson"]', function (e) {
        e.preventDefault();

        var person_id = $(this).data('pid'),
            cid = $(this).data('cid'),
            fullname = $(this).data('fullname'),
            typearea = $(this).data('typearea'),
            birthdate = $(this).data('birthdate'),
            age = $(this).data('age'),
            address = $(this).data('address');

        $('#txtPersonId').val(person_id);
        $('#txtQuery').val(cid);
        $('#txtInfoCID').html(cid);
        $('#txtInfoFullname').html(fullname);
        $('#txtInfoBirthDate').html(birthdate);
        $('#txtInfoAge').html(age);
        $('#txtInfoAddress').html(address);
        $('#txtInfoTypearea').html(typearea);

        services.register.modal.hideSearchModal();
    });

    /**
     * Do search person
     */
    services.register.doSearch = function () {
        var query = $('#txtQueryPerson').val();
        var $table = $('#tblSearchPersonResult > tbody');

        $table.empty();

        if (!query)
        {
            app.alert('กรุณาระบุคำที่ต้องการค้นหา');
            $table.append('<td colspan="7">กรุณาระบุคำค้นหา</td>');
        }
        else
        {
            app.get(apiUrls[2], { query: query }, function (err, data) {
                if (!err)
                {
                    if (data.ok)
                    {
                        if (_.size(data.rows) > 0)
                        {
                            services.register.setSearchResult(data);
                        }
                        else
                        {
                            $table.append('<td colspan="7">ไม่พบรายการ</td>');
                        }
                    }
                    else
                    {
                        app.alert(data.error);
                        $table.append('<td colspan="7">กรุณาระบุคำค้นหา</td>');
                    }
                }
                else
                {
                    app.alert(err);
                }
            });
        }
    };

    /**
     * Do save service
     */
    services.register.doSave = function (items, cb) {
        app.post(servicesUrls[0], items, function (err) {
           return err ? cb(err) : cb(null);
        });
    };

    /**
     * Set doctor room list
     */
    services.register.setDoctorRoomList = function(clinic_id) {
        var params = { clinic_id: clinic_id };
        app.get(apiUrls[9], params, function (err, data) {
            if (!err)
            {
                _.each(data.rows, function (v) {
                    $('#slServiceDoctorRoom').append(
                        '<option value="' + v.id + '">' + v.name + '</option>'
                    );
                });
            }
        });
    };

    $('#btnSearchPerson').on('click', function (e) {
        e.preventDefault();
        services.register.modal.showSearchModal();
    });

    $('#btnDoSearchPerson').on('click', function (e) {
        e.preventDefault();

        services.register.doSearch();
    });

    //enter keypress
    $('#txtQueryPerson').on('keypress', function (e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);

       if (keycode == 13)
        services.register.doSearch();
    });

    /**
     * Save service
     */
    $('#btnSaveService').on('click', function (e) {
        e.preventDefault();

        var $this = $(this);

        var items = {};

        items.pid = $('#txtPersonId').val();
        items.service_date = $('#txtServiceDate').val();
        items.service_time = $('#txtServiceTime').val();
        items.service_place = $('#slServicePlace').val();
        items.service_location = $('#slServiceLocation').val();
        items.service_intime = $('#slServiceIntime').val();
        items.service_type_in = $('#slServiceTypeIn').val();
        items.service_priority = $('#slServicePriority').val();
        items.service_person_status = $('#slServicePersonStatus').val();
        items.service_cc = $('#txtServiceCC').val();
        items.service_clinic = $('#slServiceClinic').val();
        items.service_doctor_room = $('#slServiceDoctorRoom').val();
        //Insurance
        items.service_ins = $('#slServiceIns').val();
        items.service_ins_code = $('#txtServiceInsCode').val();
        items.service_ins_main = $('#slServiceInsMain').val();
        items.service_ins_sub = $('#slServiceInsSub').val();
        items.service_ins_start = $('#txtServiceInsStartDate').val();
        items.service_ins_expire = $('#txtServiceInsExpireDate').val();
        //Refer In
        items.service_referfrom_hosp = $('#slServiceReferFromHosp').val();
        items.service_referform_code = $('#txtServiceReferFromCode').val();

        if (!items.pid) { app.alert('กรุณาเลือกผู้รับบริการ'); }
        else if (!items.service_date) { app.alert('กรุณาระบุวันที่รับบริการ'); }
        else if (!items.service_time) { app.alert('กรุณาระบุเวลารับบริการ'); }
        else if (!items.service_place) { app.alert('กรุณาระบุประเภทบริการ'); }
        else if (!items.service_location) { app.alert('กรุณาระบุประเภทที่อยู่'); }
        else if (!items.service_intime) { app.alert('กรุณาระบุประเภทเวลา'); }
        else if (!items.service_type_in) { app.alert('กรุณาระบุประเภทการมา'); }
        else if (!items.service_cc) { app.alert('กรุณาระบุอาการสำคัญ (CC)'); }
        //else if (!items.service_doctor_room) { app.alert('กรุณาระบุห้องตรวจ'); }
        else if (!items.service_ins) { app.alert('กรุณาระบุสิทธิการรักษา'); }
        else if (!items.service_ins_code) { app.alert('กรุณาระบุเลขที่สิทธิการรักษา'); }
        else
        {
            if (confirm('คุณต้องการบันทึกรายการใช่หรือไม่?'))
            {
                $this.prop('disabled', true);

                services.register.doSave(items, function(err) {
                    if (err)
                    {   //release button
                        $this.prop('disabled', false);
                        app.alert(err);
                    }
                    else
                    {
                        location.href = base_url + '/services';
                    }
                });
            }
        }
    });


    /**
     * UI Configuration
     */
    $('#slServiceInsMain').select2({
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

    $('#slServiceInsSub').select2({
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

    $('#slServiceReferFormHosp').select2({
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

    $('#slServiceClinic').on('change', function () {
        var clinic_id = $(this).val();
        //set doctor room list empty
        $('#slServiceDoctorRoom').empty();

        if (clinic_id)
            services.register.setDoctorRoomList(clinic_id);
    });
});