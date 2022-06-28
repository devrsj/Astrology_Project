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
          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
         
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add SubUnderCategory</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('subundercategory.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">


                  <div class="form-group">
                    <label for="heading">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="subcategory name" value="{{ old('name')}} ">
                  </div>

                  <div class="form-group">
                  <label>Category Name</label>
                  <select class="form-control select2bs4" name="category_id" style="width: 100%;" id="category_id">
                  <option value="0">select category</option>

                  @php
            
            $categories=App\Models\Category::where('position','navbar')->get();
               @endphp
               @foreach($categories as $category)
            
             
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                 
                 @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label>SubCategory Name</label>
                  <select class="form-control select2bs4" name="subcategory_id" style="width: 100%;" id="subct">

                    </select>
                </div>
                  
                

                 
<div id="subcat">

</div>


              
                
          

                <div class="form-group">
                  <label>Short Description</label>
 <textarea  name="short_description" value="{{ old('short_description') }}" rows="10" style="width:100%"> {{ old('short_description') }}</textarea>
                </div>



                <div class="form-group">
  <label>Description</label>
<textarea id="summernote" name="description">
  {{ old('description') }}
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
</div>
       
                  <div class="form-group">
                    <label for="exampleInputFile">Banner</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="banner" value="">    
                    </div>
                    </div>
                    </div>

      

                 <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="image" value="">    
                    </div>
                    </div>
                    </div>

                 
                      <div class="form-group" id="price">
                    <label for="">Price</label>
                    <input type="number" name="price" class="form-control"  placeholder="" value="{{ old('price') }}">
                   </div>






                   <div class="form-group" id="stock">
                    <label for="">Meta  title</label>
                    <input type="text" name="meta_title" class="form-control"  placeholder="" value="{{ old('meta_title') }}">
                   </div>



                 
                <div class="form-group">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="{{ old('meta_description') }}" rows="10" style="width:100%"> {{ old('meta_description') }}</textarea>

                </div>

                <div class="form-group">
                  <label>Publish Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;" id="status">
                    <option value="1" @if (old('status') == '1') selected="selected" @endif >Active</option>
                    <option value="0" @if (old('status') == '0') selected="selected" @endif>DeActive</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ old('weight') }}" name="weight" class="form-control" min="1">
                  </div>
                </div>

                

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                 
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
$("#category_id").change(function(){
 
    $catgeory_id=$(this).val();
  
  
    if($catgeory_id==2){
    
    $("#price").hide();
    $("#stock").hide();
      }else{ 
     $("#price").show();
     $("#stock").show();
      }


    $.ajax({ 
 method:'GET',
 url:'{{ url("/admin/subcategoryid") }}'+"/"+$catgeory_id,
 success: function(data){
     console.log(data);
 
    $("#subct").html(data);
 }
});

 
});

 


});
</script>

  @endsection
  