<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

    public function __construct(){
        $this->apiKey = '39c6e52b';
        $this->baseUrl = "https://www.omdbapi.com/?apikey=" . $this->apiKey;
    }

    public function home(){
        $client = new \GuzzleHttp\Client();
        $request = $client->get($this->baseUrl . "&i=tt0944947&Season=1");

        $data['response'] = $request->getStatusCode();

        if($data['response'] == 200){
            $data['body'] = json_decode($request->getBody());
        }

        dd($data,$this->baseUrl . "&i=tt0944947");
        return view('welcome');
    }

    public function movieDetail($id){
        $client = new \GuzzleHttp\Client();
        $request = $client->get($this->baseUrl . "&i=" . $id);

        $data['response'] = $request->getStatusCode();

        if($data['response'] == 200){
            $data['body'] = json_decode($request->getBody());
        }

        return view('detail_movies',$data);
    }

    public function searchMovie(Request $request){

        if($request->has('s')){

            $reqUrl = $this->baseUrl . "&s=" . $request->s;

            // if page exist
            if($request->has('page')){
                $reqUrl .= "&page=" . $request->page;
            }

            // if type exist (movie, series, episode)
            if($request->has('type')){
                $reqUrl .= "&type=" . $request->type;
            }

            // if year exist
            if($request->has('y')){
                $reqUrl .= "&y=" . $request->y;
            }

            $client = new \GuzzleHttp\Client();
            $request = $client->get($reqUrl);

            $data['response'] = $request->getStatusCode();

            if($data['response'] == 200){
                $data['body'] = json_decode($request->getBody());

                return response()->json($data['body']);
            }
        }
    }
}
