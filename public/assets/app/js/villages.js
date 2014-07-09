/**
* Villages script
*/

$(function() {
  //get home
  $('a[data-name="btnGetHome"]').on('click', function() {
    var village_id = $(this).data('id'),
        $slHome = $('#slHome');

    //clear person list
    $('#tblPerson > tbody').empty();
    //clear select list
    $slHome.empty();
    $slHome.append(
      '<option value="" selected>กรุณาเลือกหลังคาเรือน</option>'
    );

    var params = { village_id: village_id };

    app.get('/villages/home', params, function(err, data) {
      if (err)
      {
        alert(err.msg);
      }
      else
      {
        $.each(data.rows, function(i, v) {
          $slHome.append(
            '<option value="' + v.id + '">' + v.address + '</option>'
          );
        });
      }
    });
  });

  // get person
  $('#slHome').on('change', function() {
    var home_id = $(this).val(),
        $table = $('#tblPerson > tbody');
    //clear table
    $table.empty();
    //set params
    var params = { home_id: home_id };

    app.get('/home/person', params, function(err, data) {
      if(data)
      {
        $.each(data.rows, function(i, v) {

          i++;

          var fullname = v.title_name + v.fname + ' ' + v.lname,
              sex = v.sex == '1' ? 'ชาย' : 'หญิง',
              age = app.countAge(v.birthdate);

          $table.append(
            '<tr>' +
            '<td class="text-center">' + i + '</td>' +
            '<td class="text-center">' + v.cid + '</td>' +
            '<td>' + fullname  + '</td>' +
            '<td class="text-center">' + sex + '</td>' +
            '<td class="text-center">' + app.toThaiDate(v.birthdate) + '</td>' +
            '<td class="text-center">' + age.year + '-' + age.month + '-' + age.date + '</td>' +
            '<td class="text-center">' +
            '<a href="/person/edit/' + v.id +'" class="text-primary"><i class="fa fa-edit"></i></a>' +
            '</td>' +
            '</tr>'
          );
        });
      }
      else
      {
        app.alert(err.msg);
      }
    });
  });

});
