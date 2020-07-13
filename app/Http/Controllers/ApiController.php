<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Client;

class ApiController extends Controller
{

    public function index()
    {
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

       
        /*
       $client = new Client(['verify' => false]);
       $response = $client->request('GET', $baseurl);
       $statusCode = $response->getStatusCode();
       $body = $response->getBody()->getContents();
       $photos = json_decode($body);*/

       //dd($photos);
       
       return $results;
    }

}
