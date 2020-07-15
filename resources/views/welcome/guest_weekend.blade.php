@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-9 pb-4">
        <h1>Ranking of active users</h1>
    </div>
    @foreach($userRanking as $user)
        <div class="row">
            <div class="col-6 offset-3">
                    <h1 >{{ $user->username }} </h1>
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-6 offset-3">
                <div>
                    <p>
                    <span class="font-weight-bold">
                        <span class="text-dark">Favorite images: </span>
                    </span>{{ $user->likes_count }}
                    <span class="font-weight-bold">
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection