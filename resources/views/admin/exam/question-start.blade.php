
@extends('layouts/contentLayoutMaster')

@section('title', 'Training Category Management')

@section('vendor-style')
  {{-- vendor css files --}}
  {{-- <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/extensions/toastr.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

@endsection

@section('content')
{{-- <div class="row">
  <div class="col-12">
    <p>Read full documnetation <a href="https://datatables.net/" target="_blank">here</a></p>
  </div>
</div> --}}
<!-- Basic table -->
<section id="basic-datatable">
  <div class="row">
    <div class="container mb-2">
        <button class="btn btn-success" onclick="window.location.href='{{route('addcategory')}}'">Add New</button>
    </div>
    <div class="col-12">
        @foreach ($data as $item)

        <div class="question">
            @php
                echo $item->question;
            @endphp
                <ul class="answers">
                    @php
                        $data2 = \App\Models\question_bank_answer::where('quiz_id', $item->question_id)->get();
                // $z  =
                    @endphp
                    @foreach ($data2 as $item2)
                    @if(!empty($item2->answer))
                        <li><label><input name="Question{{$item->question_id}}" id="@if($item2->correct == 1){{trim('correct')}}@else{{trim('wrong')}}@endif" type="radio" > @php echo $item2->answer; @endphp</label></li>
                    @endif
                    @endforeach
                    {{-- <li><label><input name="Question0" id="wrong" type="checkbox"> Answer2</label></li> --}}
                    {{-- <li><label><input name="Question0" id="wrong" type="checkbox"> Answer3</label></li> --}}
                </ul>
        </div>
        @endforeach



{{-- <div class="question">Question2?
  <ul class="answers">
    <li><label><input name="Question1" id="correct" type="checkbox"> Answer1</label></li>
    <li><label><input name="Question1" id="wrong" type="checkbox"> Answer2</label></li>
    <li><label><input name="Question1" id="wrong" type="checkbox"> Answer3</label></li>
  </ul>
</div>

<div class="question">Question3?
  <ul class="answers">
    <li><label><input name="Question2" id="correct" type="checkbox"> Answer1</label></li>
    <li><label><input name="Question2" id="wrong" type="checkbox"> Answer2</label></li>
    <li><label><input name="Question2" id="wrong" type="checkbox"> Answer3</label></li>
  </ul>
</div>

<div class="question">Question4?
  <ul class="answers">
    <li><label><input name="Question3" id="correct" type="checkbox"> Answer1</label></li>
    <li><label><input name="Question3" id="wrong" type="checkbox"> Answer2</label></li>
    <li><label><input name="Question3" id="wrong" type="checkbox"> Answer3</label></li>
  </ul>
</div> --}}


<!-- <div class="results">Results</div> -->

<!-- <input class="previous" type="button" value="Previous"> -->

<input class="next"type="button" value="Next Question">

<!-- <input class="clear" type="button" value="Clear Selection">
<input class="results" type="button" value="Results"> -->

<input type="button" name="btnResults" id="btnResults" value="Results" onclick="Results()"/>

<div id="scoreBoard">
  <p> Your Score: <span id="score"></span></p>
</div>
    </div>
  </div>
  <!-- Modal to add new record -->

</section>
<!--/ Basic table -->
<style>
    body {
  font-family: 'Catamaran', sans-serif;
  color:#272625;
  background-color:#f6ea8c;
}

h1 {
  text-align:center;
  font-size:60px;
  text-shadow: #c9d6de 1px 3px;
}

.question {
  font-size:30px;
}

label {
  border:1px solid #e3e36a;
  padding:10px;
  margin:0 0 10px;
  display:block;
  font-size:20px;
}

label:hover {
  background:#e3dede;
  cursor:pointer;
}

ul {
  list-style: none;
}

nav li {
  display:inline;
  margin:10px;
  /* border-style:solid;
  border-width:thin; */
  position:relative;

}
nav {
  text-align: center;
  /* border-style: solid;
  border-width: thin; */
}

nav ul {
  padding:inherit;
  list-style:none;
}

</style>
@endsection


@section('vendor-script')
  {{-- vendor files --}}
  {{-- <script src="{{ asset('admin/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/extensions/toastr.min.js') }}"></script> --}}
    {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

@endsection
@section('page-script')
  {{-- Page js files --}}
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<script>
    $(document).ready(function(){

});

//Psuedo-Code:
//click start button (wishlist - possibly seperate categories)??
//first question box appears, multiple choice (checkbox)
//user clicks/selects answer and clicks 'next', question box disappears, next question box appears...
//wishlist - score is tabulated on screen with progress bar??
//wishlist - timer function? (during game)??
//wishlist - end of quiz display score and time??

//Total number of questions
var totalNumQuestions = $('.question').length;

//Display current question, sets it at first question
var currentQuestion = 0;

//jQuery variable
$question = $('.question');

//Hide all of the questions
$question.hide();

//Show the first question
$($question.get(currentQuestion)).fadeIn();

//Click listener to get next question...
$('.next').click(function() {

  //Current question disappears...
  $($question.get(currentQuestion)).fadeOut(function() {
    alert(currentQuestion);
    //Questions go up one by one
    currentQuestion = currentQuestion + 1;

    //Next question...
    $($question.get(currentQuestion)).fadeIn();



  });

});



//...Scoring...want this in jQuery, eventually...

var score = 0;

function Results() {
  if (document.getElementById("correct").checked === true) score++;
  else (alert("Incorrect!"));

}






//...Scoring...

</script>
  {{-- <script src="{{asset('admin/js/main.js')}}"></script> --}}
  {{-- <script src="{{ asset('js/scripts/tables/table-datatables-basic.js') }}"></script> --}}
@endsection
