@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-9 pb-4">
        <h1>Images of the week</h1>
    </div>  
    @foreach($likes as $like)
        <div class="row">
            <div class="col-6 offset-3">
                <a href="/profile/{{ $like->user->id }}">
                    <img src="{{ $like->image_url }}" class="w-100">
                </a>
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-6 offset-3">
                <div>
                    <p>
                    <span class="font-weight-bold">
                        <a href="/profile/{{ $like->user->id }}">
                            <span class="text-dark">{{ $like->user->username }}</span>
                        </a>
                    </span> {{ $like->caption }}</p>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            
        </div>
    </div>
</div>
@endsection