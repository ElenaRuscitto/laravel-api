@php
    use App\Functions\Helper as Help;
@endphp



@extends('layouts.admin')

{{-- @include('admin.partials.aside') --}}


@section('content')




    <div class="container my-container">

        <h1 class="text-center my-5">Sono presenti {{$count_project}} Progetti</h1>

        <h2>Ultimo Progetto del {{Help::formDate($last_project->update_at)}}</h2>

        <div>
            <h3>{{$last_project->title}}</h3>
            <p>{{$last_project->description}}</p>
        </div>
    </div>



@endsection
