@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-3 p-5">
            <img src="https://cdn.studydrive.net/d/prod/storage/1808-og-en.jpg" alt="" class="rounded-circle" style="max-height: 10rem;">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username}}</h1>
                <a href="/p/create">Add new Post</a>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>300</strong> posts</div>
                <div class="pr-5"><strong>200k</strong> followers</div>
                <div class="pr-5"><strong>250</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="www.studydrive.net">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row pt-5">

        @foreach($user->posts as $post)
            <div class="col-4">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </div>
        @endforeach

    </div>
</div>
@endsection