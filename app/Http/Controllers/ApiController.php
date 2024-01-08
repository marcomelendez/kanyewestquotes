<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ApiController extends Controller
{
    const ENDPOINT = 'https://api.kanye.rest/';

    public function index()
    {

        // $result = [
        //     ['quote'=>'resto es auna prueba 1'],
        //     ['quote'=>'resto es auna prueba 2'],
        //     ['quote'=>'resto es auna prueba 3'],
        //     ['quote'=>'resto es auna prueba 4'],
        //     ['quote'=>'resto es auna prueba 5'],
        // ];

        // return response()->json($result);

        $result = [];

        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get(self::ENDPOINT),
            $pool->get(self::ENDPOINT),
            $pool->get(self::ENDPOINT),
            $pool->get(self::ENDPOINT),
            $pool->get(self::ENDPOINT),
        ]);

        foreach($responses as $response) {

            $result[] = $response->json($key = null, $default = null);
        }

        return $result;
    }

    public function save(request $request)
    {
        $userId = Auth()->user()->id;

        $data = [
            'quote'=>$request->quote,
            'user_id'=>$userId
        ];

        $favorites = Favorite::where('quote',$data['quote'])
                            ->where('user_id',$data['user_id']);

        if(!$favorites->count()) {

            return Favorite::create($data);
        }
    }
}
