<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="/assets/images/grupols.ico" type="image/x-icon">
  <title>LSPainel</title>

  <link rel="stylesheet" href="/assets/packages/Hover/hover.css">
  <link rel="stylesheet" href="/assets/packages/fontawesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/packages/weather-icons/css/weather-icons.css">
  <link rel="stylesheet" href="/assets/packages/ionicons/css/ionicons.css">
  <link rel="stylesheet" href="/assets/packages/jquery-toggles/toggles-full.css">
  <link rel="stylesheet" href="/assets/packages/morrisjs/morris.css">
  <link rel="stylesheet" href="/assets/packages/jquery.gritter/jquery.gritter.css">
  <link rel="stylesheet" href="/assets/css/quirk.css">
  <link rel="stylesheet" href="/assets/css/custom.css">
  <link rel="stylesheet" href="/assets/packages/pace-loading/pace.css">

  <script type="text/javascript">
    function setUrl(sUrl)
    {
      return "{!! env("API_BASEURL","http://localhost") !!}" + sUrl;
    }
  </script>
  <script src="/assets/packages/cookie/cookie.js"></script>
  <script src="/assets/packages/modernizr/modernizr.js"></script>

  @yield('extra_styles')

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="/assets/packages/html5shiv/html5shiv.js"></script>
  <script src="/assets/packages/respond/respond.src.js"></script>
  <![endif]-->
</head>