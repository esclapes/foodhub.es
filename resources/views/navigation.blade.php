<nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">FoodHub</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li {!!  (Request::is('/') ? 'class="active"' : ''); !!}><a href="/">Inicio</a></li>
            <li {!!  (Request::is('orders/create') ? 'class="active"' : ''); !!}><a href="/orders/create">Nueva compra</a></li>
            @if(Auth::check())
              <li><a href="/auth/logout">Salir</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>