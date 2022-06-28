@extends('admin.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
 
    <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Testimonal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form   method="post" action="{{ route('people.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">



            <div class="form-group">
                  <label>Testimonal Type</label>
                  <select class="form-control select2bs4" name="people_type" style="width: 100%;" id="people_type">
                    <option  value="select testimonal type"
 @if (old('people_type') == 'select testimonal type') selected="selected" @endif }} >Select testimonal type</option>
                    <option value="text" @if (old('text') == 'text') selected="selected" @endif >Text</option>
                    <option value="video" @if (old('video') == 'video') selected="selected" @endif>Video</option>
                    </select>
                </div>
                  <div class="form-group" id="name">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter the  name" value="{{ old('name')}} ">
                  </div>
                
                <div class="form-group" id="post">
                    <label for="client_post">Post:</label>
                    <input type="text" name="post" class="form-control" id="post" placeholder="Select the client post" value="{{ old('post')}} ">
                  </div>

               
                <div class="form-group" id="description">
                  <label>Description</label>
  <textarea  name="description" value="" rows="10" style="width:100%"> {{ old('description') }}</textarea>
                </div>

                <div class="form-group" id="image">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="image" value="">
                     
                    </div>                    
                  </div>
                </div> 

                
               
                 
          <div class="form-group" id="video_url">
                    <label for="">Video url</label>
                    <input type="text" name="video_url" class="form-control" id="" placeholder="Select video url" value="{{ old('video_url')}} ">
                  </div>

            
                
              
            
            <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ old('weight') }}" name="weight" class="form-control" min="1">
                  </div>

                 
                  <div class="form-group">
                  <label>Publish Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;" id="blog_type">
           
                    <option value="1" @if (old('status') == '1') selected="selected" @endif >Active</option>
                    <option value="0" @if (old('status') == '0') selected="selected" @endif>DeActive</option>
                    </select>
                </div>
            

              
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
      
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content -->
  
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){ 

$people_type=$("#people_type").val();


$("#people_type").change(function(){
 
 $people_type=$(this).val();


if($people_type=="text"){
$("#name").show();
$("#post").show();

$("#description").show();
$("#image").show();
$("#weight").show();
 $("#video_url").hide();

}else if($people_type=="video"){
$("#name").hide();
$("#post").hide();

$("#description").hide();
$("#image").hide();
$("#weight").hide();
 $("#video_url").show();

 
 }else{
$("#name").show();
$("#post").show();

$("#description").show();
$("#image").show();
$("#weight").show();
 $("#video_url").show();

 }
});

if($people_type=="text"){
  $("#name").show();
$("#post").show();
$("#description").show();
$("#image").show();
$("#weight").show();
 $("#video_url").hide();


}else if($people_type=="video"){


$("#name").hide();
$("#post").hide();

$("#description").hide();
$("#image").hide();
$("#weight").hide();
 $("#video_url").show();

  
  }else{
 $("#name").show();
$("#post").show();
$("#description").show();
$("#image").show();
$("#weight").show();
 $("#video_url").show();


  }


});
</script>

  @endsection
  