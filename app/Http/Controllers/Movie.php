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

            $data['movies'] = array_merge($json_movie, $this->get_pagination($json_movie['totalResults'], $page_movie));
            $data['series'] = array_merge($json_series, $this->get_pagination($json_series['totalResults'], $page_series));
        }

        return view('home', $data);
    }

    public function test(Request $req){
        $movie_name  = $req->input('name');
        $page = "1##1";

        $page = urlencode(base64_encode($page));
        return redirect('/get_movie/' . $movie_name . '/' . $page);
    }

    public function get_pagination($total_result=0, $page=1){
        $data = [];

        $cur_page_load = $page * 10;
        $next = false;
        $prev = false;

        if($total_result > $cur_page_load){
            $next = $page + 1;
        }

        if($page > 1){
            $prev = $page - 1;
        }

        $data = [
            'next' => $next,
            'prev' => $prev,
            'current' => $page
        ];

        return $data;
    }
}
