<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>HIS : Settings : {{ $title or 'Enterprise HIS' }}</title>

    {{ HTML::style(asset('assets/css/themes/spacelab/bootstrap.min.css')) }}
    {{ HTML::style(asset('assets/css/font-awesome.min.css')) }}
    {{ HTML::style(asset('assets/css/datepicker3.css')) }}
    {{ HTML::style(asset('assets/css/select2.css')) }}
    {{ HTML::style(asset('assets/css/select2-bootstrap.css')) }}
    {{ HTML::style(asset('assets/css/icheck/square/red.css')) }}
    {{ HTML::style(asset('assets/app/css/index.css')) }}
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ Url::to('/') }}"><i class="fa fa-windows"></i> iCare</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
        <li class="active">
          <a href="#"><i class="fa fa-cogs"></i></a>
        </li>
        <li class="active">
          <a href="#"><i class="fa fa-envelope-o"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cog"></i> ตัวเลือก <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li role="presentation" class="dropdown-header">USER PROFILES</li>
            <li role="presentation"><a href="#/users/profile"><i class="fa fa-user fa-fw">
            </i> ข้อมูลส่วนตัว [{{ Auth::user()->email }}]</a></li>
            <li role="presentation" class="disabled"><a href="#/users/messages">
              <i class="fa fa-comments-o fa-fw"></i> ข้อความ (Private messages)</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> ลงชื่อออก (Logout)</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container">
        @yield('content')
    </div>

    @yield('modal')

    <script type="text/javascript" charset="utf-8">
        var csrf_token = "{{csrf_token()}}";
        var base_url = "{{ URL::to('/') }}" ;
        //API Url
        var apiUrls = [
            "{{ action('ApisController@getHospitals') }}", //0
            "{{ action('ApisController@getDiagnosis') }}", //1
            "{{ action('PersonController@getSearch') }}", //2
            "{{ action('ApisController@getDoctorRooms') }}", //3
            "{{ action('ApisController@getProcedures') }}", //4
            "{{ action('ApisController@getProcedurePositions') }}", //5
            "{{ action('ApisController@getIncomes') }}", //6
            "{{ action('ApisController@getDrugs') }}", //7
            "{{ action('ApisController@getDrugUsages') }}", //8
            "{{ action('ApisController@getDoctorRooms') }}", //9
            "{{ action('ApisController@getVaccineLot') }}" //10
        ];

    </script>

    {{ HTML::script(asset('assets/js/jquery.min.js')) }}
    {{ HTML::script(asset('assets/js/bootstrap.min.js')) }}
    {{ HTML::script(asset('assets/js/bootstrap-datepicker.js')) }}
    {{ HTML::script(asset('assets/js/bootstrap-datepicker.th.js')) }}
    {{ HTML::script(asset('assets/js/select2.min.js')) }}
    {{ HTML::script(asset('assets/js/select2_locale_th.js')) }}
    {{ HTML::script(asset('assets/js/jquery.maskedinput.min.js')) }}
    {{ HTML::script(asset('assets/js/underscore.min.js')) }}
    {{ HTML::script(asset('assets/js/jquery.numeric.js')) }}
    {{ HTML::script(asset('assets/js/numeral.min.js')) }}
    {{ HTML::script(asset('assets/js/icheck.min.js')) }}
    {{ HTML::script(asset('assets/app/js/index.js')) }}

    @yield('urls')

    @yield('scripts')

</body>
</html>
