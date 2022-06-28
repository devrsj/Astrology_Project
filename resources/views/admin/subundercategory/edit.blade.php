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
                <h3 class="card-title"></h3>Edit SubUnderCategory</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('subundercategory.update',$subundercategory->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">


                  
                  <div class="form-group">
                    <label for="heading">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="subcategory name" value="{{ $subundercategory->name }} ">
                  </div>


                  <div class="form-group">
                  <label>Category Name</label>
                  <select class="form-control select2bs4" name="category_id" style="width: 100%;" id="category_id">
                  <option value="0">select category</option>
                  @php
            
            $categories=App\Models\Category::where('position','navbar')->get();
               @endphp
               @foreach($categories as $category)
               <option value="{{ $category->id }}"  @if($category->id===$subundercategory->subcategory_id) selected='selected' @endif >{{ $category->name }}</option> 
                   
                 @endforeach
                    </select>
                </div>



                <div class="form-group">
                  <label>SubCategory Name</label>
                  <select class="form-control select2bs4" name="subcategory_id" style="width: 100%;" id="subct">
               
               @foreach(App\Models\SubCategory::all() as $subcategory )
                  <option value="{{ $subcategory->id }}"  @if($subcategory->id===$subundercategory->subundercategory_id) selected='selected' @endif >{{ $subcategory->name }}</option> 
                   
                   @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label>Short Description</label>
 <textarea  name="short_description" value="{{ old('short_description') }}" rows="10" style="width:100%"> {{ $subundercategory->short_description }}</textarea>
                </div>



                <div class="form-group">
  <label>Description</label>
<textarea id="summernote" name="description">
  {{ $subundercategory->description }}
             
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

<img src="{{ url('/') }}/storage/posts/{{  $subundercategory->banner }}" height="50px" width="50px">
</div>
      

      <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="image" value="">    
                    </div>
                    </div>
                    </div>

                    <div class="form-group">

<img src="{{ url('/') }}/storage/posts/{{  $subundercategory->image  }}" height="50px" width="50px">
</div>
      

                   <div class="form-group" id="price">
                    <label for="">Price</label>
   <input type="number" name="price" class="form-control"  placeholder="" value="{{ $subundercategory->sp }}">
                   </div>

         
           
                      <div class="form-group">
                    <label for="meta_title">Meta title</label>
                    <input type="text" name="meta_title" class="form-control"  placeholder="Enter the meta title" value="{{ $subundercategory->meta_title }}">
              
</div>
                 
                <div class="form-group">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="{{ old('meta_description') }}" rows="10" style="width:100%"> {{ $subundercategory->meta_description }}</textarea>

                </div>

               

                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ $subundercategory->weight }}" name="weight" class="form-control" min="1">
                  </div>
                

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" value="{{ $subundercategory->slug }}" name="slug" class="form-control">
                  </div>

                  <div class="form-group">
                  <label>Publish Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;" id="status">
  
                    <option value="1" @if ($subcategory->status == '1') selected="selected" @endif>Active</option>
                    <option value="0" @if ($subcategory->status == '0') selected="selected" @endif>DeActive</option>
                   
                   
                    </select>
                </div>
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

$("#category_id").change(function(){
    $catgeory_id=$(this).val();
    alert($catgeory_id);
  
    
if($catgeory_id==4){  
  alert('hello');
  $("#price").hide();
    }else{ 
      alert('success');
   $("#price").show();
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


 if(@if(!empty($subundercategory->category)) {{ $subundercategory->category->id==4 }} ) @endif{  
  $("#price").hide();
    }else{ 
      alert('success');
   $("#price").show();
    }
 

});
</script>

  @endsection
  