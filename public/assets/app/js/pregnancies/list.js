$(function () {
    var preg = {};

    preg.doGetList = function (cb) {
        app.get(actionUrl[1], {}, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    };



    preg.setPregnanciesList = function(data) {
        var $table = $('#tblPregnaciesList > tbody');

        $table.empty();

        if (_.size(data.rows)) {
            var i = 1;
            _.each(data.rows, function(v) {
                //var age = _.toArray(v.age).join('-');
                var laborStatus = v.labor_status == 'Y' ? 'คลอดแล้ว' : 'ยังไม่คลอด';

                var html = [
                    '<tr>',
                    '<td>' + i + '</td>',
                    '<td>' + v.cid + '</td>',
                    '<td>' + v.fullname + '</td>',
                    '<td class="visible-lg visible-md">' + v.age.year + '</td>',
                    '<td>' + v.gravida + '</td>',
                    '<td>' + laborStatus + '</td>',
                    '<td><div class="progress">',
                    '<div class="progress-bar progress-bar-success" ',
                    'role="progressbar" aria-valuenow="' + v.prenatal_percent + '" aria-valuemin="0"',
                    'aria-valuemax="100" style="width: '+ v.prenatal_percent +'%">',
                    v.prenatal_percent + '%</div>',
                    '</div></td>',
                    '<td><div class="progress">',
                    '<div class="progress-bar" role="progressbar" ',
                    'aria-valuenow="' + v.postnatal_percent + '" aria-valuemin="0" ',
                    'aria-valuemax="100" style="width: '+ v.postnatal_percent +'%">',
                    v.postnatal_percent + '%</div>',
                    '</div></td>',
                    '<td>',
                    '<a href="' + base_url + '/pregnancies/detail/' + v.id + '" ',
                    'class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>',
                    '</td>',
                    '</tr>'
                ].join('');

                $table.append(html);

                i++;
            });
        } else {
            $table.append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
        }
    };

    preg.getList = function() {
        preg.doGetList(function(err, data) {
           if (err) {
               app.alert(err);

               var $table = $('#tblPregnaciesList > tbody');
               $table.empty();
               $table.append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
           } else {
                preg.setPregnanciesList(data);
           }
        });
    };


    preg.getList();

});
