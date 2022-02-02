<?php

namespace App\Http\Controllers;

use Session;
use App\Artist;
use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use App\Datatables\ArtistDatatableScope;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArtistDatatableScope $datatable)
    {
          
        if (request()->ajax()) {
            return $datatable->query();
        }
        return view('Admin.Artist.index', [
              'html' => $datatable->html(),
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Artist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistRequest $request)
    {
        
         $artist = new Artist();
         $artist->name = $request->name;
         if($request->hasfile('image'))
         {
             $file = ($request->file('image'));
             $exten = $file->getClientOriginalExtension();
             $filename = time() . '.' . $exten;
             $file->move('uploads/artist_image',$filename );
             $artist->image = $filename;
             
         }
           $artist->save();
        
         session()->flash('success', 'Artist added Successfully.');
         return redirect(route('artist.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
         return view('Admin.Artist.edit', compact('artist'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistRequest $request, $id)
    {
        
       
         $artist =  Artist::findorfail($id);
         $artist->name = $request->name;
         if($request->hasfile('image'))
         {
             $file = ($request->file('image'));
             $exten = $file->getClientOriginalExtension();
             $filename = time() . '.' . $exten;
             $file->move('uploads/artist_image',$filename );
             $artist->image = $filename;
             
         }
         $artist->save();
        session()->flash('success', 'Artist Updated Successfully.');
        return redirect(route('artist.index'));


        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Artist::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Artist Delete Successfully.',
        ]);
    }
}
