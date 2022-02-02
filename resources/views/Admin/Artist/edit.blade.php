@extends('Admin.dashboard')
@section('title')
  Artist
@endsection
@section('content')
<div class="container-fluid">
    <div class="">
        <div class=" float-left col-md-12">
            <h4 class="bold">
                <a href="{{ route('artist.index') }}" class="btn btn-warning">Back</a>
            </h4>
        </div>
        <div>
              <h3 class="bold text-center">Update Artist</h3>     
        <div>
    </div>
       <div class="row full-width">
        <div class="col-md-12">
             <div>
                <div class="data-section table-actions">
                    <div class="col-md-12 ml-auto mr-auto">
                        <form action="{{ route('artist.update',['id'=>$artist->id])}}" method="POST" id="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('Admin.Artist.form')
                            <button class="mrg-top-15 btn btn-warning float-right" type="submit">Update</button>
                        </form>
                    </div>
                 </div>
             </div>
         </div>
    </div>
</div>
@endsection

