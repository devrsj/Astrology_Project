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
                <h3 class="card-title">Edit AskQuestion</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form   method="post" action="{{ route('ask_question.update',$ask_question->id) }}" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                
                <div class="card-body">

  
                <div class="form-group" id="question">
                  <label>Question type</label>
                  <select class="form-control select2bs4" name="category_id" style="width: 100%;">
             @php
            $categories=App\Models\Category::where('position','question')->get();
             @endphp
             @foreach($categories as $category)

             <option value="{{ $category->id }}"  @if($category->id===$ask_question->category_id) selected='selected' @endif >{{ $category->name }}</option>
        
                    @endforeach         
                    </select>
                </div>

                  <div class="form-group">
                    <label for="client_name">Question:</label>
                    <input type="text" name="question" class="form-control" id="question" placeholder="Question" value="{{ $ask_question->question }} ">
                  </div>
                
                <div class="form-group">
                    <label for="client_post">Price:</label>
                    <input type="number" name="price" class="form-control" id="icon" placeholder="Price" value="{{ $ask_question->price }}">
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
  