@extends('layout')


@section('title', 'Constitution_Quiz')
@section('content')
<h1>Quiz</h1>

<?php //var_dump($chapter_id); ?>
<div id="quiz" class="row">
   <div class="offset-3 col-6">
       <div class="card">
           <div class="card-body">
               <p class="badge badge-dark">@{{ title }}</p>
               <br>
               <h4 class="card-title">@{{ provision }}</h4>
               <hr>
               <button type="button" class="btn btn-primary btn-lg btn-block text-left">@{{choice_1}}</button>
               <button type="button" class="btn btn-primary btn-lg btn-block text-left">@{{choice_2}}</button>
               <button type="button" class="btn btn-primary btn-lg btn-block text-left">@{{choice_3}}</button>
             </div>
         </div>
     </div>
</div>
<quiz-component :provisions={{$provision}}></quiz-component>

<!-- <div id="app">
<example-component></example-component>
 </div> -->
<!-- @if(isset($provision_data))
@foreach($provision_data as $p)
{{ $p->title }}
{{ $p->caption }}
{{ $p->provision }}
{{ $p->blank }}
@endforeach
@endif -->
@endsection

@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>

</script>
@endsection
