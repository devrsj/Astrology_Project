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
                <h3 class="card-title">Edit media information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <form action="{{ route('media.update',$media->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

                <div class="card-body">

              <div class="form-group">
                  <label>Gallery type</label>
                  <select class="form-control select2bs4" name="gallery_type" style="width: 100%;" id="gallery_type" disabled>
                    <option  value="select media type" @if ($media->gallery_type == 'select media type') selected="selected" @endif }} >Select media type</option>

                    <option value="image" @if ($media->gallery_type == 'image') selected="selected" @endif >image</option>
                    <option value="brand" @if ($media->gallery_type == 'brand') selected="selected" @endif>Brand</option>
                      <option value="slider" @if ($media->gallery_type== 'slider') selected="selected" @endif>Slider</option>
                     
                      <option value="logistic" @if ($media->gallery_type== 'logistic') selected="selected" @endif>Logistic</option>
                      <option value="video" @if ($media->gallery_type == 'video') selected="selected" @endif>Video</option>
                    

                    </select>
                </div>

                <div class="form-group" id="image">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="image" disabled>
                      
                    </div>
<br>
                    
</div>                  </div>
<div class="form-group" id="image_show">
                     @if($media->image==null)
                     <label><strong>No images</strong></label>
                     @else
                  <img src="{{ url('/') }}/storage/{{  $media->image  }}" height="50px" width="50px">
                   
                   @endif </div>

                  <div class="form-group" id="image_name">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Select page name" value="{{ $media->name }}" disabled>
                  </div>

                    <div class="form-group" id="image_link">
                    <label for="">Image link</label>
                    <input type="text" name="image_link" class="form-control" id="" placeholder="Select image link" value="{{ $media->image_link }}" disabled>
                  </div>

                   <div class="form-group" id="video_url">
                    <label for="">Video url</label>
                    <input type="text" name="video_url" class="form-control" id="" placeholder="Select video url" value="{{ $media->video_url }}" disabled>
                  </div>





<div class="form-group" id="caption">
  <label>Caption</label>
<textarea id="summernote" name="caption" disabled>
  {{ $media->caption }}
             
              </textarea>
</div>

   

                
         

              
            
            <div class="form-group" id="weight">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ $media->weight }}" name="weight" class="form-control" min="5" disabled>
                  </div>


                <div class="form-group" id="meta_description">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="" rows="10" style="width:100%" disabled> {{ $media->meta_description }}</textarea>
                </div>

                  <div class="form-group" id="meta_title">
                    <label for="meta_title">Meta title</label>
                    <input type="text" name="meta_title" class="form-control"  placeholder="Enter the meta title" value="{{ $media->meta_title }}" disabled>
              
</div>
                  <div class="form-group" id="meta_keyword">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control" value="{{ $media->meta_keyword }}"  placeholder="Enter the meta keyword" disabled>
                  </div>
                  
                </div>
                <!-- /.card-body -->
               
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


$gallery=$("#gallery_type").val();


$("#gallery_type").change(function(){
 $gallery=$(this).val();


 if($gallery=="logistic"){

$("#image").show();
$("#image_name").show();
$("#caption").show();
$("#video_url").hide();
$("#meta_description").show();
$("#meta_title").show();
$("#weight").show();
$("#meta_keyword").show();

}else if($gallery=="image"){

$("#image").show();
$("#image_name").show();
$("#caption").show();
  $("#video_url").hide();
  $("#meta_description").show();

$("#meta_title").show();

$("#weight").show();
$("#meta_keyword").show();

 }else if($gallery=="slider"){

  $("#image").show();
$("#image_name").show();
$("#caption").show();
$("#video_url").hide();
$("#meta_description").show();
$("#meta_title").show();

$("#weight").show();
$("#meta_keyword").show();

 }else if($gallery=="brand"){
 $("#image").show();
$("#video_url").hide();
$("#image_name").hide();
$("#caption").hide();
$("#image_name").show();
$("#meta_description").hide();
$("#meta_title").hide();
$("#meta_keyword").hide();


 }else if($gallery=="video"){

$("#video_url").show();
$("#image").hide();
$("#image_name").hide();
$("#image_link").hide();
$("#caption").hide();
$("#meta_description").hide();
$("#meta_title").hide();
$("#meta_keyword").hide();
$("#image_show").hide();

 }else  if(gallery=="logistic"){
  $("#image").show();
$("#image_name").show();
$("#caption").show();
$("#video_url").hide();
$("#meta_description").show();
$("#meta_title").show();

$("#weight").show();
$("#meta_keyword").show();

   }else{
$("#video_url").show();
$("#image").show();
$("#image_name").show();
$("#caption").show();
$("#meta_description").show();
$("#meta_title").show();
$("#meta_keyword").show();
$("#image_link").show();
$("#image_show").show();


 }
});


if($gallery="logistic"){

$("#image").show();
$("#image_name").show();
$("#caption").show();
$("#video_url").hide();
$("#meta_description").show();
$("#meta_title").show();
$("#weight").show();
$("#meta_keyword").show();

}else if($gallery=="image"){
 $("#image").show();
 $("#image_name").show();
 $("#caption").show();
   $("#video_url").hide();
   $("#meta_description").show();

 $("#meta_title").show();

 $("#weight").show();
 $("#meta_keyword").show();

  }else if($gallery=="slider"){

   $("#image").show();
 $("#image_name").show();
 $("#caption").show();
 $("#video_url").hide();
 $("#meta_description").show();
 $("#meta_title").show();

 $("#weight").show();
 $("#meta_keyword").show();

  }else if($gallery=="brand"){
  $("#image").show();
 $("#video_url").hide();
 $("#image_name").hide();
 $("#caption").hide();
 $("#image_name").show();
 $("#meta_description").hide();
 $("#meta_title").hide();
 $("#meta_keyword").hide();


  }else if($gallery=="video"){

 $("#video_url").show();
 $("#image").hide();
 $("#image_name").hide();
 $("#image_link").hide();
 $("#caption").hide();
 $("#meta_description").hide();
 $("#meta_title").hide();
 $("#meta_keyword").hide();
 $("#image_show").hide();

  }else if($gallery=="logistic"){
    $("#image").show();
$("#image_name").show();
$("#caption").show();
$("#video_url").hide();
$("#meta_description").show();
$("#meta_title").show();

$("#weight").show();
$("#meta_keyword").show();
  }else{
 $("#video_url").show();
 $("#image").show();
 $("#image_name").show();
 $("#caption").show();
 $("#meta_description").show();
 $("#meta_title").show();
 $("#meta_keyword").show();
 $("#image_link").show();
 $("#image_show").show();


  }


});
</script>

  @endsection
  