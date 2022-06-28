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
                <h3 class="card-title">Add AskQuestion</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form   method="post" action="{{ route('ask_question.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

  
                <div class="form-group" id="question">
                  <label>Question type</label>
                  <select class="form-control select2bs4" name="category_id" style="width: 100%;">
             @php
            $categories=App\Models\Category::where('position','question')->get();
             @endphp
             @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach         
                    </select>
                </div>

                  <div class="form-group">
                    <label for="client_name">Question:</label>
                    <input type="text" name="question" class="form-control" id="question" placeholder="Question" value="{{ old('question')}} ">
                  </div>
                
                <div class="form-group">
                    <label for="client_post">Price:</label>
                    <input type="number" name="price" class="form-control" id="icon" placeholder="Price" value="{{ old('price')}} ">
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
  