<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Album;
use App\Models\Song;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Colección de Albums
        $albums = Album::where('user_id', Auth::user()->id)->orderBy('name', 'desc')->get();
        //$albums = Album::all();
        
        return view('albums.index')->with('albums', $albums);
    }

    public function chooseCreate()
    {
        $albums = Album::where('user_id', Auth::user()->id)->orderBy('name', 'desc')->get();      
        return view('albums.chooseCreate')->with('albums', $albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Cover Upload
        if ($request->hasFile('cover')) {

            // Get filename with extension
            $filenameWithExt = $request->file('cover')->getClientOriginalName();

            //Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Just Extension
            $extension = $request->file('cover')->getClientOriginalExtension();

            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('cover')->storeAs('public/album_covers', $filenameToStore);


        }else{
            $filenameToStore = 'generic_coverart.png';
        }


        $album = Album::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'artist' => $request->artist ,
            'year' => $request->year,
            'cover' => $filenameToStore
        ]);
        
        return redirect()->route('albums.show', $album->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::find($id);
        return view('albums.show')->with('album', $album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);
        return view('albums.edit')->with('album', $album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $album = Album::find($id);

        //Cover Update
        if ($request->hasFile('cover')) {

            // Get filename with extension
            $filenameWithExt = $request->file('cover')->getClientOriginalName();

            //Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Just Extension
            $extension = $request->file('cover')->getClientOriginalExtension();

            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('cover')->storeAs('public/album_covers', $filenameToStore);


        }

        if ($request->hasFile('cover')) {

            //Delete Previous Sound File
                if ($album->cover != 'generic_coverart.png') {
                    //Delete file
                    Storage::delete('public/album_covers/'.$album->cover);
                }

            $album->update([
            'name' => $request->name,
            'artist' => $request->artist ,
            'year' => $request->year,
            'cover' => $filenameToStore
            ]);

            

        }else{

            $album->update([
            'name' => $request->name,
            'artist' => $request->artist ,
            'year' => $request->year,
            ]);
        }

        
        


            return redirect()->route('albums.show', $album->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        $file_songs = Song::where('album_id', $id)->get();
        $linked_songs = Song::where('album_id', $id);
        
        
        //Delete Cover Image
        if ($album->cover != 'generic_coverart.png') {
            //Delete file
            Storage::delete('public/album_covers/'.$album->cover);
        }

        //Delete Sound Files
        foreach ($file_songs as $song) {

            if ($song->music_file != 'Default_Song.mp3') {
            //Delete file
            Storage::delete('public/music_files/'.$song->music_file);
            }
        }

        $linked_songs->delete();
        $album->delete();
        
        return redirect()->route('albums.index');
    }
}
