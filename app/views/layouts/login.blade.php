<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HIS : Please login...</title>

  <link rel="stylesheet" href="/assets/css/themes/cerulean/bootstrap.min.css" />
  <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
  <style>
    body {
      background: url(/assets/img/img01.jpg) no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

    .panel-default {
      opacity: 0.9;
      margin-top:30px;
    }
    .form-group.last { margin-bottom:0px; }
  </style>
</head>
<body>



  <div class="container">
    @yield('content')
  </div>

</body>
</html>