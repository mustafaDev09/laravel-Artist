<?php

namespace App\Datatables;

use App\Datatables\BaseDatatableScope;
use App\Artist;

class ArtistDatatableScope extends BaseDatatableScope
{
    /**
     * AppDatatableScope constructor.
     */
    public function __construct()
    {
        $this->setHtml([
            [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Artist Name',
                'searchable' => true,
                'orderable' => true,
            
            ],
            [
                'data' => 'image',
                'name' => 'image',
                'title' => 'Image',
                'searchable' => false,
                'orderable' => false,
            ],
        ]);
        
    }
    
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function query()
    { 
        
        $query = Artist::query()->orderBy('id', 'DESC');
        return datatables()->eloquent($query)
            ->editColumn('image', function ($model) {
                if (empty($model->image)) {
                    return '<p>Image Not Available.</p>';
                }
                $url= asset('uploads/artist_image/'.$model->image);
                  
                return '<img src="'.$url.'" class="img-responsive" style="max-width:90px; min-height:50px; object-fit:cover;"/>';
            })
            ->addColumn('actions', function ($model) {
                   return view('Admin.shared.dtcontrols-without-ajax')
                    ->with('id', $model->getKey())
                    ->with('model', $model)
                    ->with('editUrl', route('artist.edit', $model->getKey()))
                    ->with('deleteUrl', route('artist.destroy', $model->getKey()))
                    ->render();
            })
            ->rawColumns([ 'actions','image'])
            ->addIndexColumn()
            ->make(true);
    }
}
