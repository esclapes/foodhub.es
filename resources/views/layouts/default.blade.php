<!DOCTYPE html>
<html lang="en" ng-app="foodHub" ng-strict-di>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>FoodHub Dev</title>

    
    <link href="/css/app.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <![endif]-->
  </head>
  <body >

    @include('navigation')

    <div class="container">
      @yield('content')
    </div>

    <script src="/js/bundle.js"></script>
  </body>
</html>