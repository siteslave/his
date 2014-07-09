<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>HIS: {{ $title or 'Enterprise HIS' }}</title>

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
      <a class="navbar-brand" href="/"><i class="fa fa-windows"></i> iCare</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-desktop fa-fw"></i> การให้บริการ <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li role="presentation" class="dropdown-header">SERVICES</li>
            <li role="presentation">
              <a href="{{ URL::action('ServicesController@getIndex') }}">
                <i class="fa fa-desktop fa-fw"></i>
                ระบบ One Stop Service
              </a>
            </li>
            <li role="presentation">
              <a href="/doctorroom">
                <i class="fa fa-desktop fa-fw"></i>
                ระบบห้องตรวจแพทย์
              </a>
            </li>
            <li role="presentation">
              <a href="/appointment">
                <i class="fa fa-desktop fa-fw"></i>
                ระบบทะเบียนนัด
              </a>
            </li>
            <li role="presentation">
              <a href="/appointment">
                <i class="fa fa-desktop fa-fw"></i>
                ระบบงานแพทย์แผนไทย
              </a>
            </li>
            <li role="presentation">
              <a href="/appointment">
                <i class="fa fa-desktop fa-fw"></i>
                ระบบงานทันตกรรม
              </a>
            </li>
            <li role="presentation">
              <a href="/users/logout">
                <i class="fa fa-desktop fa-fw"></i>
                ระบบงานระบาดวิทยา
              </a>
            </li>

            <li role="presentation" class="divider"></li>

            <li role="presentation">
              <a href="/users/logout">
                <i class="fa fa-search fa-fw"></i>
                ประวัติการรับบริการ (Patient EMR)
              </a>
            </li>

          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-th-large fa-fw"></i>
            ระบบงานเชิงรุก <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li role="presentation" class="dropdown-header">REGISTERTIONS</li>
            <li role="presentation">
              <a href="{{ URL::action('VillagesController@getIndex') }}">
                <i class="fa fa-desktop fa-fw"></i>
                บัญชี 1 ข้อมูลหลังคาเรือน
              </a>
            </li>
            <li role="presentation">
              <a href="{{ URL::action('PregnanciesController@getIndex') }}">
                <i class="fa fa-desktop fa-fw"></i>
                บัญชี 2 หญิงตั้งครรภ์ และการตรวจหลังคลอด
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i>
                บัญชี 3 เด็กแรกเกิดถึง 1 ปี
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i>
                บัญชี 4 เด็กอายุ 1-5 ปี
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i>
                บัญชี 5 งานอนามัยโรงเรียน
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i>
                บัญชี 6 หญิงเจริญพันธุ์
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i>
                บัญชี 7 หมู่บ้าน สำรวจบ้าน
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i>
                บัญชี 8 สำรวจบ้าน สถานประกอบการ/ร้านค้า วัด
              </a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-briefcase fa-fw"></i>
            ทะเบียน <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li role="presentation" class="dropdown-header">REGISTERTIONS</li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i>
                ทะเบียนผู้ป่วยเบาหวาน/ความดัน
              </a>
            </li>
            <li role="presentation">
              <a href="/doctorroom">
                <i class="fa fa-desktop fa-fw"></i>
                ทะเบียนผู้ป่วยโรคมะเร็ง
              </a>
            </li>
            <li role="presentation">
              <a href="/appointment">
                <i class="fa fa-desktop fa-fw"></i>
                ทะเบียนผู้พิการ
              </a>
            </li>
            <li role="presentation">
              <a href="/appointment">
                <i class="fa fa-desktop fa-fw"></i>
                ทะเบียนผู้เสียชีวิต
              </a>
            </li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-briefcase fa-fw"></i>
            ระบบงานอื่นๆ <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li role="presentation" class="dropdown-header">OTHER SERVICES</li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i>
                ระบบงานวัสดุ/ครุภัณฑ์
              </a>
            </li>
            <li role="presentation">
              <a href="/doctorroom">
                <i class="fa fa-desktop fa-fw"></i>
                ระบบบริหารคลังยาและเวชภัณฑ์
              </a>
            </li>
            <li role="presentation" class="divider"></li>

            <li role="presentation">
              <a href="/appointment">
                <i class="fa fa-desktop fa-fw"></i>
                ส่งออกข้อมูล 43 แฟ้ม
              </a>
            </li>
            <li role="presentation">
              <a href="/appointment">
                <i class="fa fa-desktop fa-fw"></i>
                ส่งออกข้อมูล 21 แฟ้ม
              </a>
            </li>
          </ul>
        </li>

<!--         <li role="presentation">
  <a href="{{ URL::action('SettingsController@getIndex') }}">
    <i class="fa fa-cogs fa-fw"></i>
    ตั้งค่าระบบ
  </a>
</li> -->

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active">
          <a href="{{ URL::action('SettingsController@getIndex') }}" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Tools"><i class="fa fa-cogs"></i></a>
        </li>
        <li class="active">
          <a href="#" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Notifications"><i class="fa fa-envelope-o"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Private menus">
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
            "{{ action('ApisController@getVaccineLot') }}", //10
            "{{ action('ApisController@getVaccine') }}" //11
        ];

    </script>

    {{ HTML::script(asset('assets/js/jquery.min.js')) }}
    {{ HTML::script(asset('assets/js/bootstrap.min.js')) }}
    {{ HTML::script(asset('assets/js/bootstrap-datepicker.js')) }}
    {{ HTML::script(asset('assets/js/bootstrap-datepicker.th.js')) }}
    {{ HTML::script(asset('assets/js/select2.min.js')) }}
    {{ HTML::script(asset('assets/js/select2_locale_th.js')) }}
    {{ HTML::script(asset('assets/js/jquery.maskedinput.min.js')) }}
    {{ HTML::script(asset('assets/js/underscore.js')) }}
    {{ HTML::script(asset('assets/js/jquery.numeric.js')) }}
    {{ HTML::script(asset('assets/js/numeral.min.js')) }}
    {{ HTML::script(asset('assets/js/icheck.min.js')) }}
    {{ HTML::script(asset('assets/app/js/index.js')) }}

    @yield('urls')

    @yield('scripts')

</body>
</html>
