@extends('layouts.admin')

@section('content')

<!-- script for chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* Today button */
    .fc-button-today {
      background-color: #428bca;
      color: #fff;
    }

    /* Prev and Next (arrow) buttons */
    .fc-button-prev,
    .fc-button-next {
      background-color: #5cb85c;
      color: #fff;
    }
  </style>
  
  @include('dup.doctorProfile')

@endsection