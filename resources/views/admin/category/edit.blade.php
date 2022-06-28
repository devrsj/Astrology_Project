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
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
              </div>

      
              <!-- /.card-header -->
              <!-- form start -->
              <form   method="post" action="{{ route('category.update',$category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">


                  
                  <div class="form-group">
                    <label for="heading">name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="category name" value="{{ $category->name }} ">
                  </div>


                  <div class="form-group">
                  <label>Category type</label>
                  <select class="form-control select2bs4" name="position" style="width: 100%;" id="position">
           
                    <option value="product" @if ($category->position == 'product') selected="selected" @endif>For Product</option>
                    <option value="question" @if ($category->position == 'question') selected="selected" @endif>For Ask Question</option>
                    <option value="navbar"  @if ($category->position == 'navbar') selected="selected" @endif>For Navbar </option>
                    <option value="gallery" @if ($category->position == 'gallery') selected="selected" @endif>For Gallery </option>
                    </select>
                </div>

                

                  <div class="form-group">
                    <label for="exampleInputFile">Banner</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="banner" value="">    
                    </div>
                    </div>
                    </div>
                    @if($category->banner==null)No images
                     @else 
                    <div class="form-group">
                    <img src="{{ url('/') }}/storage/posts/{{$category->banner  }}" height="50px" width="50px">
                    </div>
                         @endif

                    <div class="form-group" id="thumbnail">
                    <label for="exampleInputFile">Thumbnail</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="thumbnail" value="">    
                    </div>
                    </div>
                    </div>
                 
                    <div class="form-group" id="sho">
                           @if($category->thumbnail==null)No images 
                    @else
                    <img src="{{ url('/') }}/storage/posts/{{  $category->thumbnail  }}" height="50px" width="50px">
                     @endif
                    </div>
     

<div class="form-group">
  <label>Description</label>
<textarea id="summernote" name="description">
  {{ $category->description }}
             
              </textarea>
</div>
       
              
                

                    <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ $category->weight }}" name="weight" class="form-control" min="1">
                  </div>
            
      
                

                      <div class="form-group">
                    <label for="meta_title">Meta title</label>
                    <input type="text" name="meta_title" class="form-control"  placeholder="Enter the meta title" value="{{ $category->meta_title }}">
              
</div>

<div class="form-group">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control"  placeholder="Enter the meta keyword" value="{{ $category->meta_keyword }}">
              
</div>
             
                 
                <div class="form-group">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="{{ old('meta_description') }}" rows="10" style="width:100%"> {{ $category->meta_description }}</textarea>

                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control"  placeholder="slug" value="{{ $category->slug }}">
              
</div>


                <div class="form-group">
                  <label>Publish Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;" id="status">
                 
                    <option value="1" @if ($category->status == '1') selected="selected" @endif>Active</option>
                    <option value="0" @if ($category->status == '0') selected="selected" @endif>DeActive</option>  
                    </select>
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
    $("#position").change(function(){
      $position=$(this).val();
      if($position=="question"){
        $("#thumbnail").hide();

      }else if($position=="product"){
        $("#thumbnail").hide();
        }else{
        $("#thumbnail").show();
      }  
    });

    $position=$("#position").val();
      if($position=="question"){
        $("#thumbnail").hide();

      }else if($position=="product"){
        $("#thumbnail").hide();
         $("#sho").hide();
        }else{
        $("#thumbnail").show();
      }  
    });
  
    </script>
  @endsection
  