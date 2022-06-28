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
                <h3 class="card-title">View Single Page Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
        

<form action="{{ route('page.update',$page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Select page name" value="{{ $page->name }}" disabled>
                  </div>

                   <div class="form-group">
                  <label>Position</label>
                  <select class="form-control select2bs4" name="position" style="width: 100%;" id="position" disabled="">
                    <option  value="select position type"
 @if ( $page->position == 'select position type') selected="selected" @endif }}


                    >Select position type</option>
                    <option value="header" @if ($page->position == 'header') selected="selected" @endif >Header</option>
                    <option value="middle" @if ($page->position == 'middle') selected="selected" @endif >Middle</option>
                   
                    <option value="footer" @if ($page->position== 'footer') selected="selected" @endif>Footer</option>
                    </select>
                </div>


                      <div class="form-group">
                  <label>Page Type</label>
          <select class="form-control select2bs4" id="page_type" name="type" style="width: 100%;" disabled>
                    <option  value="select page type" @if ($page->type == 'select page type') selected="selected" @endif >Select page type</option>
                    <option value="content"  @if ($page->type == 'content') selected="selected" @endif>Content</option>
                    <option value="link" @if ($page->type == 'link') selected="selected" @endif >Link</option>
                    </select>
                </div>

                <div class="form-group">
                  <label>Short description</label>
 <textarea  name="short_description" value="" rows="10" style="width:100%" disabled> {{ $page->short_description }}</textarea>

                </div>

<div class="form-group" id="description" >
  <label>Description</label>
<textarea id="summernote" name="description" disabled>
  {{ $page->description }}
            
              </textarea>
</div>

<div class="form-group" id="link">
  <label>Link</label>
  <input type="text" name="link" class="form-control" id="link" placeholder="Select the link" value="{{ $page->link }}" disabled>

</div>

   <div class="form-group">
                  <label>Parent name</label>
                  <select class="form-control select2bs4" id="parent_id" name="parent_id" style="width: 100%;" disabled>
                    <option  value="0" @if ($page->parent_id == '0') selected="selected" @endif>Select parent name</option>
                    
                    @foreach(App\Models\Page::all() as $pagee)
                    <option  value="{{ $pagee->id }}" @if($pagee->id==$page->parent_id) selected='selected' @endif >{{ $pagee->name }}</option>
                    @endforeach

                    
                                        </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Banner</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="image" disabled>
                        
                      </div>
                     
                    </div>
                    
                   
                  </div>

                  <div class="form-group" id="image_show">
                     @if($page->banner==null)
                     <label><strong>No images</strong></label>
                     @else
                  <img src="{{ url('/') }}/storage/posts/{{  $page->banner  }}" height="50px" width="50px"> 
                   @endif </div>

                   <div class="form-group">
                  <label>Display</label>
                  <select class="form-control select2bs4" name="display_type" style="width: 100%;" id="display_type" disabled>
                    <option  value="select display type"
 @if ($page->display_type == 'select display type') selected="selected" @endif 


                    >Select display type</option>
                    <option value="tabs" @if ($page->display_type == 'tabs') selected="selected" @endif >Tabs</option>
                    <option value="accordion" @if ($page->display_type == 'accordion') selected="selected" @endif>Accordion</option>
                    </select>
                </div>
         

            
            <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ $page->weight }}" name="weight" class="form-control" min="5" disabled>
                  </div>


                <div class="form-group">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="" rows="10" style="width:100%" disabled> {!! $page->meta_description !!}</textarea>

                </div>

                  <div class="form-group">
                    <label for="meta_title">Meta title</label>
                    <input type="text" name="meta_title" class="form-control"  placeholder="Enter the meta title" value="{{ $page->meta_title }}" disabled>
              
</div>
                  <div class="form-group">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control" value="{{ $page->meta_keyword }}"  placeholder="Enter the meta keyword" disabled>
                  </div>

                 
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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

$description=$("#description").val();
$link=$("#link").val();
$page_type=$("#page_type").val();


if($page_type=="content"){
  $("#description").show();
   $("#link").hide();

}else if($page_type=="link"){
$("#link").show();
$("#description").hide();

}else{

   $("#description").show();
   $("#link").show();
}




$("#page_type").change(function(){

$page_type=$(this).val();
$link=$("#link").val();
if($page_type=="content"){
    $("#description").show();
   $("#link").hide();
}else if($page_type=="link"){
 $("#link").show();
$("#description").hide();
}else{
   $("#description").show();
   $("#link").show();
}

});


});
</script>
  

  @endsection
  