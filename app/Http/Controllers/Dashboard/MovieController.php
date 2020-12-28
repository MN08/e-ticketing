<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Movie $movies)
    {
        $search = $request->input('search');

        $active = "Movies";

        $movies = $movies->when   ($search, function($query) use ($search){
            return $query->where('title','like','%'.$search.'%')
                            ->orWhere('email','like','%'.$search.'%');
        })
            ->paginate(10);

        $request = $request->all();

        return view('dashboard/movie/list',['movies'=> $movies,
                                            'active' => $active,
                                            'request' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $active = "Movies";

        return view('dashboard/movie/form',['active' => $active]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(),[

            'title'         => 'required|unique:App\Models\Movie,title',
            'description'   => 'required',
            'thumbnail'      => 'required|image'

        ]);

        if($validator->fails()){
            return redirect()->route('dashboard.movies.create')
                             ->withErrors($validator)
                             ->withInput();
        }else{

            $image = $request->file('thumbnail');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('public/movies',$image, $filename);

            $movie->title = $request->input('title');
            $movie->description = $request->input('description');
            $movie->thumbnail = $filename;
            $movie->save();

            return redirect()->route('dashboard.movies');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $active = "Movies";



        return view('dashboard/movie/form',['active' => $active,
                                            'movie' => $movie,
                                            'url'   => 'dashboard.movies.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(),[

            'title'         => 'required|unique:App\Models\Movie,title,'.$movie->id,
            'description'   => 'required',
            'thumbnail'      => 'image'

        ]);

        if($validator->fails()){
            return redirect()->route('dashboard.movies.edit', $movie->id)
                             ->withErrors($validator)
                             ->withInput();
        }else{

            if($request->hasFile('thumbnail')){
                $image = $request->file('thumbnail');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->putFileAs('public/movies',$image, $filename);
                $movie->thumbnail = $filename;
            }

            $movie->title = $request->input('title');
            $movie->description = $request->input('description');
            $movie->save();

            return redirect()->route('dashboard.movies');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
