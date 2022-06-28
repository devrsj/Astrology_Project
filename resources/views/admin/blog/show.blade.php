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
                <h3 class="card-title">Edit blogs information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  method="post" action="" enctype="multipart/form-data">
                
                <div class="card-body">


               
                  <div class="form-group">
                    <label for="heading">Heading</label>
                    <input type="text" name="heading" class="form-control" id="heading" placeholder="Select Heading" value="{{ $blog->heading }}" disabled>
                  </div>

                 


                   

                <div class="form-group">
                  <label>Short description</label>
 <textarea  name="short_description" value="" rows="10" style="width:100%" disabled> {{ $blog->short_description }}</textarea>

                </div>

<div class="form-group">
  <label>Description</label>
<textarea id="summernote" name="description" disabled>
  {{ $blog->description }}
              </textarea>
</div>

   


                <div class="form-group">
                    <label for="exampleInputFile">Banner</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="banner" disabled>
                     
                    </div>   
                  </div>


                </div> 
                <div class="form-group">
                  @if($blog->banner==null)
                      <label>No images</label>
                  @else
                  <img src="{{ url('/') }}/storage/{{  $blog->banner  }}" height="50px" width="50px">
                  @endif
                </div>



                <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="icon" disabled>
                     
                    </div>   
                  </div>


                </div> 
                <div class="form-group">
                  @if($blog->image==null)
                      <label>No images</label>
                  @else
                  <img src="{{ url('/') }}/storage/{{  $blog->image  }}" height="50px" width="50px">
                  @endif
                </div>

                <div class="form-group">
                    <label for="published_by">Published by</label>
                    <input type="text" name="published_by" class="form-control" id="published_by" placeholder="Select published by" value="{{ $blog->published_by }}" disabled>
                  </div>

                 
                 <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" name="author" class="form-control" id="author" placeholder="Select Heading" value="{{ $blog->author }}" disabled>
                  </div>

                 
         
         <div class="form-group">
                  <label>Tag</label>
                  <div class="select2-purple">
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" name="tags[]" style="width: 100%;" disabled>
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
                    <input type="number" value="{{ $blog->weight }}" name="weight" class="form-control" min="5" disabled>
                  </div>

                      <div class="form-group">
                    <label for="meta_title">Meta title</label>
                    <input type="text" name="meta_title" class="form-control"  placeholder="Enter the meta title" value="{{ $blog->meta_title }}" disabled>
              
</div>
                 
                <div class="form-group">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="" rows="10" style="width:100%" disabled>  {{ $blog->meta_description }}</textarea>

                </div>

              
                  <div class="form-group">
                    <label for="meta_keyword">Meta Keyword</label>
                    <input type="text" name="meta_keyword" class="form-control" value="{{ $blog->meta_keyword }}"  placeholder="Enter the meta keyword" disabled>
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
  