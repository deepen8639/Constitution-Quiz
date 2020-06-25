<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Constitution Quiz</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
  <vuetify-header-component></vuetify-header-component>
  <router-view
    :logoutpass="{{ json_encode(route('logout')) }}"
    :loginpass="{{ json_encode(route('login')) }}"
    :registerpass="{{ json_encode(route('register')) }}"
    ></router-view>
</div>
<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}" defer></script>
</body>
</html>
