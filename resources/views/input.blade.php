@extends('layout')

@section('title', 'Constitution_Data_input')
@section('content')
<h1>Data Input</h1>
<form class="" action="\input\constitution" method="post">
  @csrf
  <button type="submit" name="button">Constitution_Data input</button>
  @if(isset($message_constitution))
  {{ $message_constitution }}
  @endif
</form>

<form class="" action="\input\chapter" method="post">
  @csrf
  <button type="submit" name="button">Chapter_Data input</button>
  @if(isset($message_chapter))
  {{ $message_chapter }}
  @endif
</form>

@endsection
