<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserFavorites;

class MainController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
        $this->apiKey = '39c6e52b';
        $this->baseUrl = "https://www.omdbapi.com/?apikey=" . $this->apiKey;
    }

    public function switchLang($lang)
    {
        if (array_key_exists($lang, config('language'))) {
            session()->put('applocale', $lang);
        }
        return redirect()->back();
    }

    public function home(){
        $client = new \GuzzleHttp\Client();
        $request = $client->get($this->baseUrl . "&s=batman&page=1");

        $data['response'] = $request->getStatusCode();

        if($data['response'] == 200){
            $data['body'] = json_decode($request->getBody());
        }

        return view('home',$data);
    }

    public function movieDetail($id){
        $client = new \GuzzleHttp\Client();
        $request = $client->get($this->baseUrl . "&i=" . $id . "&plot=full");

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
            if($request->type != 'all'){
                $reqUrl .= "&type=" . $request->type;
            }

            // if year exist
            if($request->y != 'all'){
                $reqUrl .= "&y=" . $request->y;
            }

            $client = new \GuzzleHttp\Client();
            $request = $client->get($reqUrl);

            $data['response'] = $request->getStatusCode();

            $data['body'] = json_decode($request->getBody());
            
            if($data['body']->Response == "True"){
                
                return view('layouts.movies',$data);
            }else{

                return response()->json([
                    'success' => false,
                    'html' => view('layouts.nodata')->render()
                ]);
            }

        }
    }
}
