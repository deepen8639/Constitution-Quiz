@extends('layout')

@section('title', 'Constitution Quiz')
@section('content')
<h1 class="mb-3">Constitution Quiz</h1>
<form class="" action="\quiz" method="get" name="chapter_form" id="chapter_form">

@foreach($chapters as $chapter)

<button type="submit" class="lead" form="chapter_form" name='chapter_id' value="<?php echo $chapter->id;?>">
  {{ $chapter->number}}
  {{ $chapter->name}}
</button>
@endforeach
</form>

@endsection
