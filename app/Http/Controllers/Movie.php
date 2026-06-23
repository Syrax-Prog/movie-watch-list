<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Movie extends Controller
{
    public function get_movie($search_val = '', $page = ''){
        if($page == ''){
            $page_movie = 1;
            $page_series = 1;
        }else{
            $page = base64_decode(urldecode($page));
            $page = explode('##', $page);
            $page_movie = $page[0];
            $page_series = $page[1];
        }

        $data = [];
        if($search_val != ''){
            $url = "https://www.omdbapi.com/?s=" . $search_val . "&apikey=" . config('constants.api_key') . "&page=" . $page_movie . "&type=movie";
            $json_movie = Http::withoutVerifying()->get($url)->json();

            $url = "https://www.omdbapi.com/?s=" . $search_val . "&apikey=" . config('constants.api_key') . "&page=" . $page_series . "&type=series";
            $json_series = Http::withoutVerifying()->get($url)->json();

            $data['movies'] = $json_movie;
            $data['series'] = $json_series;

            $cur_total_load = $page_movie * 10;
            $data['movies']['next'] = false;
            $data['movies']['prev'] = false;

            if($json_movie['totalResults'] > $cur_total_load){
                $data['movies']['next'] = $page_movie + 1;
            }

            if($page_movie > 1){
                $data['movies']['prev'] = $page_movie - 1;
            }
        }

        return view('home', $data);
    }

    public function test(Request $req){
        $movie_name  = $req->input('name');
        $page = "1##1";

        $page = urlencode(base64_encode($page));
        return redirect('/get_movie/' . $movie_name . '/' . $page);
    }
}
