<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserFavorites;

class FavoriteMovieController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $user = auth()->user();

        $data['favorites'] = UserFavorites::where('user_id',$user->id)->get();

        return view('user_favorite', $data);
    }

    public function addFavorites(Request $request){
        $user = auth()->user()->id;

        $check = UserFavorites::where('user_id',$user)->where('imdbid',$request->imdbid)->first();

        if(!$check){
            UserFavorites::create([
                'user_id' => $user,
                'imdbid' => $request->imdbid,
                'title' => $request->title,
                'poster_url' => $request->poster_url,
                'year' => $request->year
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Movie already in favorites'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Movie added to favorites'
        ]);
    }

    public function delFavorites(Request $request){
        $user = auth()->user()->id;

        UserFavorites::where('id',$request->id)->where('user_id',$user)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Movie deleted from favorites'
        ]);
    }
}
