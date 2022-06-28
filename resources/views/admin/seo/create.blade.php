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
                <h3 class="card-title">Add seo information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form   method="post" action="{{ route('seo.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                <div class="form-group">
                    <label for="webmaster">Web Master:</label>
                    <input type="text" name="webmaster" class="form-control" id="" placeholder="Web Master" value="">
                  </div>

                <div class="form-group">
                    <label for="yandex">Yandex:</label>
                    <input type="text" name="yandex" class="form-control" id="" placeholder="Yandex" value="">
                  </div>

                <div class="form-group">
                    <label for="analaytic">Analaytic:</label>
                    <input type="text" name="analaytic" class="form-control" id="" placeholder="Analaytic" value="">
                  </div>

                <div class="form-group">
                    <label for="geo_tag">Geo Tag:</label>
                    <input type="text" name="geo_tag" class="form-control" id="" placeholder="Geo Tag" value="">
                  </div>




                <div class="form-group" id="image">
                    <label for="">Favicon</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" id="" name="favicon">   
                      </div>
                    </div>
                  </div>
                 


              <!--<div class="form-group" id="image">-->
              <!--      <label for="">Logo</label>-->
              <!--      <div class="input-group">-->
              <!--        <div class="custom-file">-->
              <!--          <input type="file" class="form-control" id="" name="logo">   -->
              <!--        </div>-->
              <!--      </div>-->
              <!--    </div>-->
                   
              


                 


                   
                <div class="form-group">
                    <label for="meta_title">Meta Title:</label>
                    <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="Meta Title" value="">
                  </div>


                   <div class="form-group">
                    <label for="meta_keyword">Meta Keyword:</label>
                    <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="Meta Keyword" value="">
                  </div>

               

                  
<div class="form-group">
                  <label>Meta description</label>
 <textarea  name="meta_description" value="{{ old('meta_description') }}" rows="10" style="width:100%"> {{ old('meta_description') }}</textarea>

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
  