<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSS And JavaScript -->
        <!-- CSS を追加 Bootstrap-->
    <link rel="stylesheet" href="/css/app.css">
    <style>

    </style>
    <!-- JavaScript を追加 Bootstrap-->
    <script src="/js/app.js" defer></script>
    </head>
    <body>
          <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #321278">
            <a class="navbar-brand" href="/Constitute">Constitution</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="#">Features</a>
                <a class="nav-item nav-link" href="#">Pricing</a>
                <a class="nav-item nav-link" href="#">Disabled</a>
              </div>
            </div>
          </nav>
          <div class="container">
              @yield('content')
        </div>
        @yield('script')
    </body>
</html>
