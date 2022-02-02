<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
     <div>
          <div>
               <h4>Enter Artist</h4>
               <input type="text" id="name"  name="name" placeholder="Artist Name" class="form-control" value="{{isset($artist->name)?$artist->name:old('name')}}"/>
          </div>
          @if($errors->has('name'))
               <p class="text-danger help-block">{{$errors->first('name')}}</p>
          @endif
     <p></P>
        <div>
            <h4> Enter Artist Image</h4>
            <input type="file" id="image"  name="image" placeholder="Artist Image" class="form-control image-upload"/>
       </div>
            @if(isset($artist->image))
               <input type="hidden" id="image"  name="image" placeholder="Artist Image" class="form-control image-upload" value="{{$artist->image}}"/>
            @endif
           @if($errors->has('image'))
              <p class="text-danger help-block">{{$errors->first('image')}}</p>
           @endif
     <p></p>
  </div>
</body>
</html>