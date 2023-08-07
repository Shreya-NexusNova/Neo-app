  
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')

<?php

    $qry=DB::Table('issue')->where('id',$_GET['id'])->first();

if(Auth::user()->role=='admin'){

}
else{
    if($qry->user_id!=Auth::id()){
        echo "You dont have access";
        exit;
    }
}

 ?>

          <!-- Main Container -->
            <main id="main-container">
                <div class="bg-header-dark">
                    <div class="content content-full">
                        <div class="row pt-3">
                            <div class="col-md py-3 d-md-flex align-items-md-center text-center">
                                <h1 class="text-white mb-0">
                                    <span class="font-w300">Log Issue</span>
                                     
                                </h1>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="bg-white">
                    <div class="content content-full">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt bg-light px-4 push">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">Home</a>
                                </li>
                              <li class="breadcrumb-item">
                                    <a href="{{url('/my-issues')}}">My Issue</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add New Issue  </li>
                            </ol>
                        </nav>
                        <!-- END Breadcrumb -->

             
                    <!-- New Post -->
                    <form action="{{url('update-issue')}}" class="js-validation" method="POST" enctype="multipart/form-data"  >
                        @csrf
                        <input type="hidden" name="id" value="{{$_GET['id']}}">

                                             <!-- People -->
                                <div class="block block-rounded block-bordered block-mode-loading-refresh">
                                    <div class="block-header border-bottom">
                                        <h3 class="block-title">Log Issue</h3>
                                        <div class="block-options">
                                           
                                        </div>
                                    </div>
                                    <div class="block-content">
                          
                                <div class="row justify-content-  push">
 
							<div class="col-sm-12 m-auto" >
										<div class="  row">
                                            <label class="col-sm-3 col-form-label" for="example-hf-email">Location</label>
                                          
                                            <div class="col-sm-6 form-group">
                                            	 <select type="text" class="form-control select2" id="location"  value="{{$qry->location}}" name="location" placeholder="Name"  >
                                                    <option value="">Select Location</option>
                                                    <?php $location=DB::Table('location')->where('is_deleted',0)->get();?>
                                                    @foreach($location as $q)
                                                    <option value="{{$q->id}}" {{$qry->location==$q->id?'selected':''}}>{{$q->location_name}}</option>
                                                    @endforeach
                                                    </select>
                                            </div>
                                   
                                        </div>
                                        <div class="  row">
                                            <label class="col-sm-3 col-form-label" for="example-hf-email">Staff</label>
                                          
                                            <div class="col-sm-3 form-group">
                                                 <input type="text" class="form-control  " id="staff_firstname"  value="{{$qry->staff_firstname}}" name="staff_firstname" placeholder="Firstname"  >
                                            
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                 <input type="text" class="form-control " id="staff_lastname"  value="{{$qry->staff_lastname}}" name="staff_lastname" placeholder="Lastname"  >
                                            
                                            </div>
                                   
                                        </div>

 
 							    <div class="  row">
                                            <label class="col-sm-3 col-form-label" for="example-hf-email">Staff Role</label>
                                          
                                            <div class="col-sm-6 form-group">
                                                 <select type="text" class="form-control  select2" id="staff_role"  value="{{$qry->staff_role}}" name="staff_role"    >
                                                    <option value="">Select Role</option> 
                                                    <?php $staff_role=DB::Table('staff_role')->where('is_deleted',0)->get();?>
                                                    @foreach($staff_role as $q)
                                                    <option value="{{$q->id}}" {{$q->id==$qry->staff_role?'selected':''}}>{{$q->staff_role_name}}</option>
                                                    @endforeach
                                                        </select>
                                            </div>
                                   
                                        </div>
                                     
                                              <div class="  row">
                                            <label class="col-sm-3 col-form-label" for="example-hf-email">Email</label>
                                          
                                            <div class="col-sm-6 form-group">
                                                 <input type="text" class="form-control  " id="email"  value="{{$qry->email}}" name="email" placeholder="Email"  >
                                            
                                            </div>
                                        
                                        </div>
                                               <div class="  row">
                                            <label class="col-sm-3 col-form-label" for="example-hf-email">Phone</label>
                                          
                                            <div class="col-sm-6 form-group">
                                                 <input type="text" class="form-control  " id="phone"  value="{{$qry->phone}}" name="phone" placeholder="Phone"  >
                                            
                                            </div>
                                        
                                        </div>
                                              <div class="  row">
                                            <label class="col-sm-3 col-form-label" for="example-hf-email">Upload A File(Optional)</label>
                                          
                                            <div class="col-sm-6 form-group">
                                                   <div class="custom-file">
                                               
                                         
                                                <input type="file" class="custom-file-input" data-toggle="custom-file-input"  name="file" id="file"    >
                                                <label class="custom-file-label" for="file">Choose file</label>
                                                <input type="hidden" name="hidden_file" value="{{$qry->file}}">
                                                    
                                            </div>
                                        </div>
                                            <div class="col-sm-3">
                                                @if($qry->file!='')
                                                    <a class=" " href="{{asset('public/uploads')}}/{{$qry->file}}" target="_blank">View Attachment</a>
                                                    @endif
                                                </div>
                         
                                             
                                        
                                        </div>
                                             
 										  <div class="  row">
                                            <label class="col-sm-3 col-form-label" for="example-hf-email">Issue Type</label>
                                          
                                            <div class="col-sm-6 form-group">
                                                 <select type="text" class="form-control select2" id="issue_type_id"  value="{{$qry->issue_type_id}}" name="issue_type_id" placeholder="Name"  >
                                                    <option value="">Select Issue Type</option>
                                                    <?php $issue_type=DB::Table('issue_type')->where('is_deleted',0)->get();?>
                                                    @foreach($issue_type as $q)
                                                    <option value="{{$q->id}}" {{$qry->issue_type_id==$q->id?'selected':''}}>{{$q->type_name}}</option>
                                                    @endforeach
                                                    </select>
                                            </div>
                                   
                                        </div>

       <?php $issue_sub=DB::table('issue_type_detail')->wherE('issue_type_id',$qry->issue_type_id)->get(); ?>
                                          <div class="      row">
                                             <label class="col-sm-3  IssueLabel" for="example-hf-email">


                                             </label>
                                          
                                            <div class="col-sm-9  IssueTypeDiv form-group">
                                         
                                                @if(sizeof($issue_sub)>0)
                                                @foreach($issue_sub as $key=>$i)
                                                            <div class="custom-control custom-radio custom-control-inline custom-control-warning mb-1">
                                                <input type="radio" class="custom-control-input"  value="{{$i->id}}" id="issue_sub_id{{$key}}" name="issue_sub_id"   {{$qry->issue_sub_id==$i->id?'checked':''}} >
                                                <label class="custom-control-label" for="issue_sub_id{{$key}}">{{$i->type_detail_name}}</label>
                                            </div>
                                            @endforeach
                                            @endif
                                            </div>
                                   
                                        </div>
                                                <div class="  row">
                                            <label class="col-sm-3 col-form-label" for="example-hf-email">Issue Details</label>
                                          
                                            <div class="col-sm-6 form-group">
                                                 <textarea type="text" class="form-control  " id="issue_detail"  value="{{$qry->issue_detail}}" name="issue_detail" placeholder="Issue Detail"  >{{$qry->issue_detail}}</textarea>
                                            
                                            </div>
                                        
                                        </div>

                                <div class="  row">
                                            <label class="col-sm-3 col-form-label" for="example-hf-email">Status</label>
                                          
                                            <div class="col-sm-9 form-group">
                                              <div class="custom-control custom-radio custom-control-inline custom-control-warning mb-1">
                                                <input type="radio" class="custom-control-input"  value="Resolved"  id="status1" name="status"  {{$qry->status=='Resolved'?'checked':''}}  >
                                                <label class="custom-control-label" for="status1">Resolved  </label>
                                            </div>
                                             <div class="custom-control custom-radio custom-control-inline custom-control-warning mb-1">
                                                <input type="radio" class="custom-control-input"  value="Unresolved"  id="status2" {{$qry->status=='Unresolved'?'checked':''}} name="status"    >
                                                <label class="custom-control-label" for="status2">Unresolved  </label>
                                            </div>
                                            </div>
                                   
                                        </div>

                                </div>
                            </div>
                        </div>
                            <div class="block-content bg-body-light">
                                <div class="row justify-content-center push">
                                    <div class="col-md-10">
                                    <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-fw fa-check ml-1"></i> Save
                                        </button>
                                        
                                            <a href="{{url('my-issues')}}" type="reset" class="btn btn-alt-danger">
                                            <i class="fa fa-fw fa-times  "></i> Cancel

                                        </a>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END New Post -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
 
  

        <!-- Page JS Helpers (BS Datepicker + BS Colorpicker plugins) -->
        <script>jQuery(function(){Dashmix.helpers(['datepicker', 'colorpicker']);});</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script type="text/javascript">
 	
 	$(function(){
 		  @if(Session::has('success'))
             Swal.fire({
  title: '{{Session::get('success')}}',
 
 
  confirmButtonText: 'Ok'
})
             @endif

 
 
 		    // Init Form Validation
        jQuery('.js-validation').validate({
            ignore: [],



 
 
 



            rules: {
                







                'location': {
                    required: true,
                  
                },
                 'staff_firstname': {
                    required: true,
                  
                },
              
               'staff_lastname': {
                    required: true,
                  
                },
              
               'staff_role': {
                    required: true,
                  
                },
              
               'email': {
                    required: true,
                  
                },
              
               'phone': {
                    required: true,
                  
                },
              
               'issue_type_id': {
                    required: true,
                  
                },
              
               'issue_detail': {
                    required: true,
                  
                },
              
              
             
           
            },
         
        });

        // Init Validation on Select2 change
        jQuery('.js-select2').on('change', e => {
            jQuery(e.currentTarget).valid();
        });





$('#issue_type_id').change(function() {
    var id=$(this).val();
     var text=$('option:selected',$(this)).text();
     $('.IssueTypeDiv').html('');
       $('.IssueLabel').html('');

    $.ajax({
        type:'get',
        data:{id:id},
        url:"{{url('get-issue-detail')}}",
        async:false,
        success:function(res) {
            var sno=0;
                    var html='';
                    if(res.length>0){
                        for(var i=0;i<res.length;i++){
                        sno++;
                        $('.IssueLabel').html(text+' Issues');

                            
                        html+='<div class="custom-control custom-radio custom-control-inline custom-control-warning mb-1">'+
                                                '<input type="radio" class="custom-control-input"  value="'+res[i].id+'" '+(sno==1?'checked':'')+'  id="issue_sub_id'+sno+'" name="issue_sub_id"    >'+
                                                '<label class="custom-control-label" for="issue_sub_id'+sno+'">'+res[i].type_detail_name+'  </label>'+
                                            '</div>';
                                        }
                    }
                    
$('.IssueTypeDiv').html(html);

        }
    })
})

 		 
 	})
 </script>
  @endsection('content')
