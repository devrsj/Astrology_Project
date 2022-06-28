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
    @php
$ask_questions=App\Models\CustomerQuestion::where('orderquestion_id',$order_question->id)->get();
 @endphp
            
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reply AskQuestion::{{ $order_question->order_code }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form   method="post" action="{{ url('/admin/ask_question/reply',$order_question->id) }}" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                
                <div class="card-body">

                <div class="row">
    
                @foreach($ask_questions as $ask_question)
                 <div class="col-sm-6">
                 <div class="form-group">
                 <label>Ask Question By {{ $order_question->name }} </label>
                 <textarea placeholder="Message" class="form-control"  readonly="readonly" name="question[]" rows="7" multiple="multiple">{{ $ask_question->question }}</textarea>
                 </div>
                 </div>

                 <div class="col-sm-6">
                 <div class="form-group">
                 <label>Relply Question By {{ Auth()->user()->name }} </label>
                 <textarea placeholder="Reply Section" class="form-control" name="reply[]" rows="7" multiple="multiple"></textarea> 
                 </div>
                 </div>
                 <input type="hidden" value="reply" name="status">

 @endforeach

                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="width:100%">Reply</button>
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
  