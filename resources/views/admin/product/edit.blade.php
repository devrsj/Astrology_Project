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
              <h3 class="card-title" style="text-align:center">Add Products</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">


<div class="row">
<div class="col-sm-4">

                <div class="form-group">
                    <label for="heading">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="subcategory name" value="{{ $product->name }} ">
                  </div>
</div>

<div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputFile">Banner</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="banner" value="">    
                    </div>
                    </div>
                    </div>

                    <div class="form-group">       
                  <img src="{{ url('/') }}/storage/posts/{{  $product->banner  }}" height="50px" width="50px">  
                    </div>


</div>

<div class="col-sm-4">

@php

$category_products=App\Models\Category::where('position','product')->get();
@endphp

<div class="form-group">
                  <label>Category type</label>
                  <select class="form-control select2bs4" name="category_id" style="width: 100%;" id="position">
           
           @foreach($category_products as $category)
         
                    <option value="{{ $category->id }}"  @if($category->id===$product->category_id) selected='selected' @endif >{{ $category->name }}</option>

                    @endforeach

                    </select>
                </div>



</div>
</div>

<div class="row">
<div class="col-sm-4">


     <div class="form-group">
                    <label for="">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
          <input type="file" class="form-control" id="" name="image" value="{{ old('image') }}">    
                    </div>
                    </div>


                   
                    </div>

                    <div class="form-group">       
                  <img src="{{ url('/') }}/storage/posts/{{  $product->image  }}" height="50px" width="50px">  
                    </div>

  
</div>
<div class="col-sm-4">
  <div class="form-group">
                    <label for="">Image1</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="image1" value="{{ old('image1') }}">    
                    </div>
                    </div>


                    </div>
                    
                    <div class="form-group">       
                  <img src="{{ url('/') }}/storage/posts/{{  $product->image1  }}" height="50px" width="50px">  
                    </div>
</div>
<div class="col-sm-4">
  <div class="form-group">
                    <label for="">Image2</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="image2" value="{{ old('image2') }}">    
                    </div>
                    </div>

</div>

<div class="form-group">       
                  <img src="{{ url('/') }}/storage/posts/{{  $product->image2  }}" height="50px" width="50px">  
                    </div>
                    </div>
</div>

<div class="row">
<div class="col-sm-4">



<div class="form-group">
                    <label for="">Image3</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="image3" value="{{ old('image3') }}">    
                    </div>
                    </div>


                    </div>
  <div class="form-group">       
                  <img src="{{ url('/') }}/storage/posts/{{  $product->image3  }}" height="50px" width="50px">  
                    </div>




    
</div>
<div class="col-sm-4">

<div class="form-group">
      <label for="mp">Marked price</label>
     <input type="number" name="mp" class="form-control"  placeholder="" value="{{ $product->mp }}" min="1">             
</div> 



    
</div>
<div class="col-sm-4">

<div class="form-group">
                    <label for="sp">Selling price</label>
                    <input type="number" name="sp" class="form-control"  placeholder="Enter the meta title" value="{{ $product->sp }}" min="1">
</div>



    

</div>
</div>

<div class="row">
<div class="col-sm-4">

<div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control"  placeholder="" value="{{ $product->quantity }}" min="1">
</div>



                
</div>

<div class="col-sm-4">


<div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ $product->weight }}" name="weight" class="form-control" min="1">
                  </div>



                
  </div>

<div class="col-sm-4">

<div class="form-group">
                  <label>Publish Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;" id="status">
                 
                    <option value="1" @if ($product->status == '1') selected="selected" @endif>Active</option>
                    <option value="0" @if ($product->status == '0') selected="selected" @endif>DeActive</option>  
                    </select>
                </div>


  
                  </div>
</div>

                  

                 


             

                <div class="form-group">
                  <label>Short Description</label>
 <textarea  name="short_description" value="{{ old('short_description') }}" rows="10" style="width:100%"> {{ $product->short_description }}</textarea>
                </div>



                <div class="form-group">
  <label>Description</label>
<textarea id="summernote" name="description">
  {{ $product->description }}
            
              </textarea>
</div>
       
                 
      

   
                 

              
               
                  <div class="form-group">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="meta title" value="{{ $product->meta_title }}">
                  </div>
                    
            
                 
                <div class="form-group">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="{{ old('meta_description') }}" rows="10" style="width:100%"> {{ $product->meta_description }}</textarea>

                </div>


                
                <div class="form-group">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="" value="{{ $product->slug }}">
                  </div>
                    
            
                

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                 
                </div>
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
  