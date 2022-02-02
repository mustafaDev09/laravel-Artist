@extends('Admin.dashboard')
@section('title')
  Artist
@endsection
@section('content')
<div class="container-fluid">
   <div class="col-md-12">
        <div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    toastr.options.timeOut = 10000;
                    @if (Session::has('success'))
                        toastr.success('{{ Session::get('success') }}');
                    @endif
                });
         </script>
      <div>
          <div class=" float-right">
            <a href="{{route('artist.create')}}" class="btn btn-warning ">Add Artist</a>
        </div>
        <div>
            <h4 class="bold">Artist List</h4>     
        <div>
    </div>
     <p></P>
      <p></P>
       <div class="row full-width">
        <div class="col-md-12 p-1">
             <div>
                <div class="data-section table-actions">
                      {!! $html->table()!!} 
                </div>
             </div>
         </div>
    </div>
</div>
@push('script')
 <script src="{{ asset('js/datatable.js') }}"></script>
    {!! $html->scripts() !!}
@endpush
@endsection

