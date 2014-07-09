<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HIS : Dashboard</title>

  <link rel="stylesheet" href="/assets/css/themes/cerulean/bootstrap.min.css" />
  <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
  <link rel="stylesheet" href="/assets/css/datepicker3.css" />
  <link rel="stylesheet" href="/assets/ts/jquery.tablesorter.widgets.min.js" />
  <link rel="stylesheet" href="/assets/ts/theme.default.css" />
  <link rel="stylesheet" href="/assets/ts/theme.bootstrap.css" />
  <link rel="stylesheet" href="/assets/app/css/index.css" />

  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/bootstrap-datepicker.js"></script>
  <script src="/assets/js/bootstrap-datepicker.th.js"></script>
  <script src="/assets/js/jquery.tablesorter.min.js"></script>
  <script src="/assets/app/js/index.js"></script>

</head>
<body>

<!-- <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
              <a href="/services">
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
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i> 
                บัญชี 1 ระบบบันทึกข้อมูล หมู่บ้าน ข้อมูลทะเบียนบ้านและข้อมูลบุคคลในบ้าน
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i> 
                บัญชี 2 ระบบบันทึกข้อมูลหญิงตั้งครรภ์ บริการฝากครรภ์ ผลการคลอดละการตรวจหลังคลอด
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i> 
                บัญชี 3 ระบบบันทึกข้อมูล การให้วัคซีนเด็กแรกเกิดถึง 1 ปี
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i> 
                บัญชี 4 ระบบบันทึกข้อมูล การให้วัคซีนเด็กอายุ 1-5 ปี
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i> 
                บัญชี 5 ระบบบันทึกข้อมูล โรงเรียน เด็กในวัยเรียน การให้บริการตรวจสุขภาพ และการฉีดวัคซีน
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i> 
                บัญชี 6 ระบบบันทึกข้อมูล หญิงเจริญพันธุ์ การวางแผนครอบครัวและการตรวจมะเร็งเต้านม
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i> 
                บัญชี 7 ระบบบันทึกข้อมูล หมู่บ้าน สำรวจบ้าน
              </a>
            </li>
            <li role="presentation">
              <a href="/servies">
                <i class="fa fa-desktop fa-fw"></i> 
                บัญชี 8 ระบบบันทึกข้อมูล สำรวจบ้าน สถานประกอบการ/ร้านค้า วัด
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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active">
          <a href="#"><i class="fa fa-cogs"></i></a>
        </li>
        <li class="active">
          <a href="#"><i class="fa fa-envelope-o"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> ตัวเลือก <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li role="presentation" class="dropdown-header">USER PROFILES</li>
            <li role="presentation"><a href="#/users/profile"><i class="fa fa-user fa-fw"></i> ข้อมูลส่วนตัว</a></li>
            <li role="presentation" class="disabled"><a href="#/users/messages"><i class="fa fa-comments-o fa-fw"></i> ข้อความ (Private messages)</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a href="/users/logout"><i class="fa fa-sign-out fa-fw"></i> ลงชื่อออก (Logout)</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav> -->

  <div class="container">
    @yield('content')
  </div>

</body>
</html>