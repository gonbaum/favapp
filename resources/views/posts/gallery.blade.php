@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $data)
        <div class="row">
            <div class="col-6 offset-3">
                <a href="">
                    <img src="{{ $post->url }}" class="w-100">
                </a>
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-6 offset-3">
                <div>
                    <p>
                    <span class="font-weight-bold">
                        <a href="">
                            <span class="text-dark">{{ $post->title }}</span>
                        </a>
                    </span> {{ $post->url }}</p>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection