@extends('layouts.innerFront')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h2>{{ $post->title }}</h2>
                    <p class="card-text">{!! $post->body !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
