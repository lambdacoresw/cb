@extends('layouts.back')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h4>Welcome {{ auth()->user()->name }}</h4>
        </div>
    </section>
@endsection
