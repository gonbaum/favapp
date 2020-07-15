<?php

use Illuminate\Http\Request;
Use App\Like;
Use App\User;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('photos', function() {
        
    #Fetch photos from external URL and prepare them for pagination in vue with laravel-vue-pagination plugin.
    $baseurl = env('API_BASE_URL');

        // Set default page
        $page = request()->has('page') ? request('page') : 1;

        // Set default per page
        $perPage = request()->has('per_page') ? request('per_page') : 10;

        // Offset required to take the results
        $offset = ($page * $perPage) - $perPage;

        // At here you might transform your data into collection
        $url = $baseurl;
        $newCollection = collect(json_decode(file_get_contents($url), true));

        // Set custom pagination to result set
        $results =  new LengthAwarePaginator(
            $newCollection->slice($offset, $perPage),
            $newCollection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
       
       return $results;
});

Route::get('likes', function() {

    # Return all likes.
    return Like::all();

});

Route::get('rankinguser', function() {

    # Returns list of users with more likes in descendent order without their likes.
    $userRanking = Like::all()->groupBy('user_id')->sort()->reverse();

    # Returns list of users with more likes in descendent order with their grouped likes.
    $userRankingWithLikes= User::with('likes')->withCount('likes')->orderBy('likes_count','desc')->get();

    return $userRankingWithLikes;

});

Route::get('rankingimage', function() {

    # Returns list of most liked images in descendent order.
    $mostLikedimg = Like::all()->groupBy('image_id')->sort()->reverse()->flatten()->unique();

    return $mostLikedimg;

});

