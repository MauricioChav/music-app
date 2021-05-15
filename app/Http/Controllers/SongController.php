<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Song;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Colección de canciones
        $songs = Song::where('user_id', Auth::user()->id)->orderBy('name', 'asc')->get();
        $albums = Album::where('user_id', Auth::user()->id)->get();
        
        return view('songs.index')
        ->with('songs', $songs)
        ->with('albums', $albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if($album_id != null){*/

            return view('songs.create');

        /*}else{
            return redirect()->route('songs.index');
        }*/

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //File Upload
        if ($request->hasFile('music_file')) {

            // Get filename with extension
            $filenameWithExt = $request->file('music_file')->getClientOriginalName();

            //Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Just Extension
            $extension = $request->file('music_file')->getClientOriginalExtension();

            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('music_file')->storeAs('public/music_files', $filenameToStore);


        }else{
            $filenameToStore = 'Default_Song.mp3';
        }

        $song = Song::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name ,
            'album_id' => $request->album_id,
            'track' => $request->track ,
            'music_file' => $filenameToStore
        ]);

        return redirect()->route('albums.show' , $request->album_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $song = Song::find($id);

        if(empty($song)){
            return redirect()->back();
        }else{
            return view('songs.show')->with('song', $song);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $song = Song::find($id);
        return view('songs.edit')->with('song', $song);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $song = Song::find($id);

        //File Update
        if ($request->hasFile('music_file')) {

            // Get filename with extension
            $filenameWithExt = $request->file('music_file')->getClientOriginalName();

            //Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Just Extension
            $extension = $request->file('music_file')->getClientOriginalExtension();

            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('music_file')->storeAs('public/music_files', $filenameToStore);
        }
        
        if ($request->hasFile('music_file')) {

            //Delete Previous Sound File
                if ($song->music_file != 'Default_Song.mp3') {
                    //Delete file
                    Storage::delete('public/music_files/'.$song->music_file);
                }

            $song->update([
            'name' => $request->name ,
            'track' => $request->track ,
            'music_file' => $filenameToStore   
            ]);

            

        }else{

            $song->update([
            'name' => $request->name ,
            'track' => $request->track ,  
            ]);

        }


        

        return redirect()->route('albums.show' , $song->album_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $song = Song::find($id);

        //Delete Previous Sound File
        if ($song->music_file != 'Default_Song.mp3') {
            //Delete file
            Storage::delete('public/music_files/'.$song->music_file);
        }

        $album_id = $song->album_id;


        $song->delete();

        if($request->origin == 0){
            //Regresar a index
            return redirect()->route('songs.index');
        }else{
            //Regresar si esta desde la pantalla editar
        return redirect()->route('albums.show', $album_id);
        }
 
    }
}
