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
                <h3 class="card-title">Add blogs information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form   method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">


               
                  <div class="form-group">
                    <label for="heading">Heading</label>
                    <input type="text" name="heading" class="form-control" id="heading" placeholder="Select Heading" value="{{ old('heading')}} ">
                  </div>

               
  <!--              <div class="form-group">-->
  <!--                <label>Short description</label>-->
  <!--<textarea  name="short_description" value="" rows="10" style="width:100%"> {{ old('short_description') }}</textarea>-->
  <!--              </div>-->

<div class="form-group">
  <label>Description</label>
<textarea id="summernote" name="description">
  {{ old('description') }}
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
</div>

   <div class="form-group">
                    <label for="">Banner</label>
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
                        <input type="file" class="form-control" id="" name="icon" value="">
                    </div>                    
                  </div>
                </div> 




                <!--<div class="form-group">-->
                <!--    <label for="published_by">Published by</label>-->
                <!--    <input type="text" name="published_by" class="form-control" id="published_by" placeholder="Select Heading" value="{{ old('heading')}} ">-->
                <!--  </div>-->

                 
                <!-- <div class="form-group">-->
                <!--    <label for="author">Author</label>-->
                <!--    <input type="text" name="author" class="form-control" id="author" placeholder="Select Heading" value="{{ old('author')}} ">-->
                <!--  </div>-->

                  <div class="form-group">
                  <label>Category Name</label>
                  <select class="form-control select2bs4" name="category_id" style="width: 100%;" id="">
           
           @foreach(App\Models\BlogCategory::all() as $blog_category)
                    <option value="{{ $blog_category->id }}">{{ $blog_category->name }}</option>
             @endforeach
                    </select>
                </div>



                 




         
              <div class="form-group">
                  <label>Tags</label>
                  <div class="select2-purple">
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" name="tags[]" style="width: 100%;">
                      @foreach(App\Models\Tag::all() as $tag)
                      <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                      @endforeach
                      
                    </select>
                  </div>
                </div>

                
              
            
            <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" value="{{ old('weight') }}" name="weight" class="form-control" min="1">
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
  
  

  @endsection
  