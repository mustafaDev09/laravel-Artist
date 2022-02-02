<!DOCTYPE html>
<html>
<head>
    	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">
    @stack('style')
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Dashboard</title>
    
	<link rel="stylesheet" href="">
    <style>
        .sidebar {
           position: fixed;
           left: 0;
           bottom: 0;
           top: 0;
           z-index: 100;
           padding: 20px 0 0 10px;
          border-right: 1px solid #d3d3d3;
          
         }

     .left-sidebar {
         position: sticky;
         top:0; 
         height: calc(100vh - 70px)
      }

       .sidebar-nav li .nav-link {
          color: #333;
          font-weight: 500;
      }
      .form-control-primary {
         margin: 10px;
         opacity: 0.2;
         border-radius: 2px;
     }
    </style>
</head>
<body style="background-color:#3359FF;">
 <div>
   <div>
    <nav class="navbar navbar-dark fixed-top bg-warning flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-dark" href="{{route('admin.dashboard')}}">Dashboard</a>
        <ul class="navbar-nav px-3">
          <li class="nav-item text-nowrap">
            <a class="nav-link text-dark" href="{{route('admin.logout')}}">Logout</a>
          </li>
        </ul>
    </nav>
   </div>
     <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 bg-light d-none d-md-block sidebar">
                    <div class="left-sidebar">
                      <ul  class="nav flex-column sidebar-nav p-4">
                        <li class="nav-item">
                            <a class="nav-link" href="artist">
                              <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd"/></svg>
                              Artist
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                              <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6.646 3.646a.5.5 0 01.708 0l6 6a.5.5 0 010 .708l-6 6a.5.5 0 01-.708-.708L12.293 10 6.646 4.354a.5.5 0 010-.708z" clip-rule="evenodd"/></svg>
                              Event
                            </a>
                          </li>
                       </ul>
                    </div>
                  </div>
                 </div>
             </div>
        </div>
    <div class="col-md-10 ml-sm-auto col-lg-10 px-4" style=" padding-top: 90px;">
        <div class="text-light hover">
            <h1>Admin DashBoard</h1>
        </div>
    </div>
    <div class="col-md-10 ml-sm-auto col-lg-10 px-4" style=" padding-top: 90px;">
        <div class="text-light hover">
            @yield('content')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>

     //Delete Artist Function 

    function destroy(url){
              $.ajax(
                  {
                      type: "POST",
                      url: url,
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      data: {
                          '_method': 'DELETE'
                      },
                      success: function (data) {
                          $('#dataTableBuilder').DataTable().ajax.reload();
                      }
                  }
              ).done(function (data) {
                  if(data.success){
                    toastr.info(  
                             'Deleted!',
                            data.message,
                            'success'); 
                  }else{
                        toastr.error(  
                             'Deleted!',
                            data.message,
                            'success'); 
                    }
              });
          }

        //block inspact Element
       
    //     $(document).bind("contextmenu",function(e) {
    //           e.preventDefault();
    //     });
    //    document.onkeydown = function(e) {
    //         if(event.keyCode == 123) {
    //             return false;
    //         }
    //         if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
    //             return false;
    //         }
    //         if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
    //             return false;
    //         }
    //         if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
    //             return false;
    //         }
    //     }

  </script>
    @stack('script')
</body>
  
</html>