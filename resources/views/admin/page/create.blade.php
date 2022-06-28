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
                <h3 class="card-title">Add pages information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form   method="post" action="{{ route('page.store') }}" enctype="multipart/form-data">
                @csrf


                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Select page name" value="{{ old('name')}} ">
                  </div>

                   <div class="form-group">
                  <label>Position</label>
                  <select class="form-control select2bs4" name="position_type" style="width: 100%;" id="position">
                    <option  value="select position type"
 @if (old('position') == 'select position type') selected="selected" @endif }}


                    >Select position type</option>
                    <option value="header" @if (old('position') == 'header') selected="selected" @endif >Navbar</option>
                    <option value="middle" @if (old('position') == 'middle') selected="selected" @endif>Middle</option>
                    <option value="footer" @if (old('position') == 'footer') selected="selected" @endif>Footer</option>
                   
                    <option value="bottom" @if (old('position') == 'footer') selected="selected" @endif>Bottom Footer</option>
                    </select>

                </div>


                      <div class="form-group">
                  <label>Page Type</label>
                  <select class="form-control select2bs4" name="page_type" style="width: 100%;"  id="page_type">

                    <option  value="select page type" @if (old('page_type') == 'select page type') selected="selected" @endif >Select page type</option>
                    <option value="content"  @if (old('page_type') == 'content') selected="selected" @endif>Content</option>
                    <option value="link" @if (old('page_type') == 'link') selected="selected" @endif >Link</option>
                    </select>
                </div>

                <div class="form-group" id="short_description">
                  <label>Short description</label>
 <textarea  name="short_description" value="" rows="10" style="width:100%"> {{ old('short_description') }}</textarea>

                </div>

<div class="form-group" id="description">
  <label>Description</label>
<textarea id="summernote" name="description">
  {{ old('description') }}
            
</textarea>
</div>

<div class="form-group" id="link">
  <label>Link</label>
  <input type="text" name="link" class="form-control" id="link" placeholder="Select the link" value="{{ old('link')}} ">

</div>





                <div class="form-group">
                  <label>Parent name</label>
                  <select class="form-control select2bs4" id="parent_id" name="parent_id" style="width: 100%;">
                    <option  value="0" @if (old('parent_id') == '0') selected="selected" @endif>Select parent name</option>
                    
 @foreach(App\Models\Page::all() as $page)
                    <option  value="{{ $page->id }}">{{ $page->name }}</option>
                    @endforeach
                                        </select>
                </div>


                   <div class="form-group">
                    <label for="">Banner</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="banner">
                      </div>
                    </div>      
                  </div>




                <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="thumbnail">
                      </div>
                    </div>        
                  </div>
         
               

               
         <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ old('weight') }}" name="weight" class="form-control" min="1">
                  </div>            
           
                
         
               <div class="checkbox">
    <label><input type="checkbox" name="service"> Latest Service</label>
       </div>

   
   
       <div class="checkbox">
       <label><input type="checkbox" name="product"> Latest Products</label>
       </div>
       
       <div class="checkbox">
       <label><input type="checkbox" name="customer_section"> Customer Section</label>
       </div>
    
             
                  <div class="form-group">
                    <label for="meta_title">Meta title</label>
                    <input type="text" name="meta_title" class="form-control"  placeholder="Enter the meta title" value="{{ old('meta_title') }}">
                        </div>
                        
                        

                <div class="form-group">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="{{ old('meta_description') }}" rows="10" style="width:100%"> {{ old('meta_description') }}</textarea>
                </div>

                
                  <div class="form-group">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword') }}"  placeholder="Enter the meta keyword">
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





});
</script>

  @endsection
  