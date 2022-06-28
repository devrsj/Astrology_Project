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
                <h3 class="card-title">Edit blogs information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  method="post" action="{{ route('blog.update',$blog->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
               
                <div class="card-body">


             
                  <div class="form-group">
                    <label for="heading">Heading</label>
                    <input type="text" name="heading" class="form-control" id="heading" placeholder="Select Heading" value="{{ $blog->heading }} ">
                  </div>

                 


                   

 <!--               <div class="form-group">-->
 <!--                 <label>Short description</label>-->
 <!--<textarea  name="short_description" value="" rows="10" style="width:100%"> {{ $blog->short_description }}</textarea>-->
 <!--               </div>-->
                
                

<div class="form-group">
  <label>Description</label>
<textarea id="summernote" name="description">
  {{ $blog->description }}
              </textarea>
</div>

   
                   <div class="form-group">
                    <label for="exampleInputFile">Banner</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="banner">
                     
                    </div>   
                  </div>


                </div> 
                <div class="form-group">
                  @if($blog->banner==null)
                      <label>No images</label>
                  @else
                  <img src="{{ url('/') }}/storage/posts/{{  $blog->banner  }}" height="50px" width="50px">
                  @endif
                </div>


                <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="icon">
                     
                    </div>   
                  </div>


                </div> 
                <div class="form-group">
                  @if($blog->image==null)
                      <label>No images</label>
                  @else
                  <img src="{{ url('/') }}/storage/posts/{{  $blog->image  }}" height="50px" width="50px">
                  @endif
                </div>

                <!--<div class="form-group">-->
                <!--    <label for="published_by">Published by</label>-->
                <!--    <input type="text" name="published_by" class="form-control" id="published_by" placeholder="Select published by" value="{{ $blog->published_by }} ">-->
                <!--  </div>-->

                 
                <!-- <div class="form-group">-->
                <!--    <label for="author">Author</label>-->
                <!--    <input type="text" name="author" class="form-control" id="author" placeholder="Select Heading" value="{{ $blog->author }} ">-->
                <!--  </div>-->



                  <div class="form-group">
                  <label>Category Name</label>
                  <select class="form-control select2bs4" name="category_id" style="width: 100%;" id="">
           
           @foreach(App\Models\BlogCategory::all() as $blog_category)
           <option value="{{ $blog_category->id }}"  @if($blog_category->id===$blog->category_id) selected='selected' @endif >{{ $blog_category->name }}</option>
          
             @endforeach
                    </select>
                </div>



         
         <div class="form-group">
                  <label>Tag</label>
                  <div class="select2-purple">
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" name="tags[]" style="width: 100%;">
                      @foreach(App\Models\Tag::all() as $tag)
                      <option value="{{ $tag->id }}" 
                   
                         @if($blog->hasTag($tag->id))
                         selected
                      
                         @endif>{{ $tag->name }}
                         

                       </option>
                      @endforeach
                      
                    </select>
                  </div>
                </div>

              
              
            
            <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ $blog->weight }}" name="weight" class="form-control" min="1">
                  </div>

                      <div class="form-group">
                    <label for="meta_title">Meta title</label>
                    <input type="text" name="meta_title" class="form-control"  placeholder="Enter the meta title" value="{{ $blog->meta_title }}">
              
</div>
                 
                <div class="form-group">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="" rows="10" style="width:100%">  {{ $blog->meta_description }}</textarea>

                </div>

              
                  <div class="form-group">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control" value="{{ $blog->meta_keyword }}"  placeholder="Enter the meta keyword">
                  </div>

                             <div class="form-group">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="form-control"  placeholder="Enter the meta title" value="{{ $blog->slug }}">
              
</div>

                   
           <div class="form-group">
                  <label>Publish Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;" id="status">
                 
                    <option value="1" @if ($blog->status == '1') selected="selected" @endif>Active</option>
                    <option value="0" @if ($blog->status == '0') selected="selected" @endif>DeActive</option>  
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
  
  

  @endsection
  