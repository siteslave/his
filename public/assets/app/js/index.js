/**
* Main application script
*
* @author		Satit Rianpit <rianpit@gmail.com>
* @copyright 	2014
*/

/**
 * Main application namespace
 *
 * @namespace app
 */

var app = {};

/**
 * Global ajax action
 *
 * @param {string} 	url 		The url for data sending.
 * @param {object} 	params  The parameters.
 * @return {object}
 */

app.get = function( url, params, cb ) {

  params._token = csrf_token;

	$.ajax({
		url: url,
		data: params,
		type: 'GET',
		dataType: 'JSONP'
	})
	// If success
	.done(function( data ) {
		data.ok == '0' ? cb(data.error) : cb(null, data);
	})
	// If error
	.error(function( err ) {
		cb( err.responseText );
	});

};

app.delete = function( url, params, cb ) {

  params._token = csrf_token;

	$.ajax({
		url: url,
		data: params,
		type: 'DELETE',
		dataType: 'JSON'
	})
	// If success
	.done(function( data ) {
		data.ok == '0' ? cb(data.error) : cb(null, data);
	})
	// If error
	.error(function( err ) {
		cb( err.responseText );
	});

};

app.put = function( url, params, cb ) {

  params._token = csrf_token;

	$.ajax({
		url: url,
		data: params,
		type: 'PUT',
		dataType: 'JSON'
	})
	// If success
	.done(function( data ) {
		data.ok == '0' ? cb(data.error) : cb(null, data);
	})
	// If error
	.error(function( err ) {
		cb( err.responseText );
	});

};

app.post = function( url, params, cb ) {

  params._token = csrf_token;

	$.ajax({
		url: url,
		data: params,
		type: 'POST',
		dataType: 'JSON'
	})

	// If success
	.done(function( data ) {
		if (data.ok == '0') {
            var error = null;

            if ($.isPlainObject(data.error))
                error = JSON.stringify(data.error);
            else
                error = data.error;

            cb( error )
        } else {
             cb( null, data )
        }
	})
	// If error
	.error(function( err ) {
        if ($.isPlainObject(err))
            err = JSON.stringify(err.responseText);

		cb(err);
	});

};

//Convert mysql date to thai date
app.toThaiDate = function(date)
{
  if (date)
  {
    var arrDate = date.split('-');
    var dd = arrDate[2],
        mm = arrDate[1],
        yy = parseInt(arrDate[0]) + 543;
    var newDate = dd + '/' + mm + '/' + yy;

    return newDate;
  }
  else
  {
    return '-';
  }
};

//Convert mysql date to thai date
app.jsToThaiDate = function(date)
{
  if (date)
  {
    var arrDate = date.split('/');
    var dd = arrDate[0],
        mm = arrDate[1],
        yy = parseInt(arrDate[2]) + 543;
    var newDate = dd + '/' + mm + '/' + yy;

    return newDate;
  }
  else
  {
    return '-';
  }
};

//Convert mysql date to thai date
app.mysqlToJSDate = function(date)
{
  if (date)
  {
    var arrDate = date.split('-');
    var dd = arrDate[2],
        mm = arrDate[1],
        yy = parseInt(arrDate[0]);
    var newDate = dd + '/' + mm + '/' + yy;

    return newDate;
  }
  else
  {
    return '-';
  }
};

app.getCurrentEngDate = function()
{
  var date = new Date(),
      y = date.getFullYear(),
      m = date.getMonth() + 1,
      d = date.getDate();

      return d + '/' + m + '/' + y;
};

app.getCurrentThaiDate = function()
{
  var date = new Date(),
      y = date.getFullYear(),
      m = date.getMonth() + 1,
      d = date.getDate();

      y = parseInt(y) + 543;

      return d + '/' + m + '/' + y;
};

//Count age
app.countAge = function(birthDate)
{
  if (birthDate)
  {
    var arrDate = birthDate.split('-');
    var dd = parseInt(arrDate[2]),
        mm = parseInt(arrDate[1]),
        yy = parseInt(arrDate[0]);

    var currentDate = new Date(),
        c_dd = currentDate.getDate(),
        c_mm = currentDate.getMonth() + 1,
        c_yy = currentDate.getFullYear();

    var age_d, age_m, age_y;

    //get date
    if (c_dd >= dd)
    {
      age_d = c_dd - dd;
    }
    else
    {
      c_mm = c_mm -1;
      c_dd = c_dd + 30;
      age_d = c_dd - dd;
    }

    //get month
    if (c_mm >= mm)
    {
      age_m = c_mm - mm;
    }
    else
    {
      c_yy = c_yy - 1;
      c_mm = c_mm + 12;
      age_m = c_mm - mm;
    }

    age_y = c_yy - yy;

    return { year: age_y, month: age_m, date: age_d };
  }
  else
  {
    return { year: 0, month: 0, date: 0 };
  }
};

app.alert = function(msg) {
  alert(msg);
};

app.clearNull = function(str) {
  return str == null || !str ? '-' : str;
};

app.stripped = function (msg, len) {
  return msg.length > len ? msg.substr(0, len) + '...' : msg;
};
//target, page, params, scripts
app.loadPage = function (data) {

    if (!data.params) {
        $(data.target).load(data.url, function (res, status, xhr) {
            if (status != 'error')
            {
                if(data.scripts)
                {
                    if (_.isArray(data.scripts))
                    {
                        _.each(data.scripts, function(v) {
                            $.getScript(v, function() {
                                app.setRuntime();
                            });
                        });
                    }
                    else
                    {
                        $.getScript(data.scripts, function() {
                            app.setRuntime();
                        });
                    }
                }
            }
            else
            {
                app.alert('ไม่สามารถโหลดหน้าเอกสารได้: [' + xhr.statusText + ']');
            }
        });
    } else {
        data.params.csrf_token = csrf_token;

        $(data.target).load(data.url, data.params, function (res, status, xhr) {
            if (status != 'error')
            {
                if(data.scripts)
                {
                    if (_.isArray(data.scripts))
                    {
                        _.each(data.scripts, function(v) {
                            $.getScript(v, function() {
                                app.setRuntime();
                            });
                        });
                    }
                    else
                    {
                        $.getScript(data.scripts, function() {
                            app.setRuntime();
                        });
                    }
                }
            }
            else
            {
                app.alert('ไม่สามารถโหลดหน้าเอกสารได้: [' + xhr.statusText + ']');
            }
        });
    }


};

app.setRuntime = function() {
    $('[data-type="date-picker"]').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "th",
        todayHighlight: true,
        forceParse: true,
        autoclose: true
    });

    /**
     * Setting maskedit
     */

        //time mask
    $('[data-type="time"]').mask('99:99');
    $('[data-type="year"]').mask('9999');
    $('input[data-type="number"]').numeric();

    $('th').addClass('text-center');
    $('select[disabled="disabled"]').css('background-color', 'white');
    $('input[disabled="disabled"]').css('background-color', 'white');
    $('input[readonly]').css('background-color', 'white');

    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'iradio_square-red'
    });

    $('[rel="tooltip"]').tooltip();
};

// Initial jQuery event.

$(function() {

	/**
	 * Setup loading when ajax fire.
	 */

	// When ajax start
	$( document ).ajaxStart(function() {

		// Show loading

	});
	// When ajax stop
	$( document ).ajaxStop(function() {

		// Hide loading

	});

    app.setRuntime();
});
