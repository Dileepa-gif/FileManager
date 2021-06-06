@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
<style>
.Bc-color-body{
    background-image: linear-gradient(to bottom,  #3385ff , 	 #ccffff);
}
.btn-lg-sqr{
    width:150px;
    height:150px;
}
.headline-fnt{
    font-size:15px;
    color:black;
    font-weight:600;
    font-family:sans-serif;
}
.icon-dec{
    font-size:50px;
    color:white;
     padding-top:30px;  
}
.topic {
  position: absolute;
  font-size:45px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.contain {
  position: relative;
  text-align: center;
  color: white;
}
</style>
<body b >
@section('content')
<div class="container-fluid ">
    <div class="row contain">
       
         <img  src="{{asset('images/img02.jpg')}}"style="width:100%;height:250px;object-fit: cover">
       
             <p class="topic">Welcome To The Video Conference Unit</p>
         
    </div>
    <div class="row" style="padding-top:70px">
        <div class="col-lg-4 col-md-4 col-sm-12 text-center"style="padding-top:40px">
                <a href="/meetingSheduler" class="btn btn-info btn-lg-sqr"style="padding-top:50px;"><i class="bi bi-pen-fill icon-dec"></i>
                </a></br><p class="headline-fnt">Create Meetings</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 text-center"style="padding-top:40px">
               <a href="/view-sheduledMeetings" class="btn btn-info btn-lg-sqr"style="padding-top:50px;"><i class="bi bi-people-fill icon-dec"></i>
               </a></br><p class="headline-fnt">View Meetings</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 text-center"style="padding-top:40px">
               <a href="/recordings" class="btn btn-info btn-lg-sqr "style="padding-top:50px;">
               <i class="bi bi-film icon-dec"></i>    
               </a></br><p class="headline-fnt">Recordings</p>
        </div>
        
    </div>
</div>
</div>         
</div>

@endsection
</body>
