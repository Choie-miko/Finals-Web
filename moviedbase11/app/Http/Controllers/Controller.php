<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;

abstract class Controller
{
    public function index(){
        $movies = Movie::select('mov_id.actors')->with('mov_id.directors')->get('mov_id.genres')->get('mov_id.ratings');
        return response()->json($movies, 200);
    }

    public function showMovie(Movie $movies,Request $request){
        $movies = Movie::findofFail($request->mov_id)->with('mov_id.actors')->with('mov_id.directors')->get('mov_id.genres')->get('mov_id.ratings');
        return response()->json($movies, 200);
    }


    public function findDirectors(Director $director, Request $request){
       $director = Director::findorFail($request->dir_id)->movies()->with('dir_id.movies')->with('mov_id.directors')->get();
       return response()->json($director, 200);

    }

    public function findActor(Actor $actor, Request $request){
        $actor = Actor::findorFail($request->act_id)->with('actor_id.movies');
        return response()->json($actor, 200);
    }

    public function findGenre(Genre $genre, Request $request){
        $genre = Genre::findorFail($request->gen_id)->with('genre_id.movies');
        return response()->json($genre, 200);
    }


    public function movieRating(Movie $movie, Request $request){
        $rating = Rating::findorFail($request->mov_id)->with('rev_stars')->with('rev_id')->with('num_o_ratings');
        return response()->json($rating, 200);
    }


    public function register(array $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json('User has been created!',200);
    }

    public function login(array $data,Request $request){
        $request = $request->validate([
            'email' => 'required|string|email|min:8|max:255',
            'password' => 'required|string|min:8|max:255',
        ])
        (auth::attempt(['email' => $data['email'], 'password' => $data['password']]));

    }
}
