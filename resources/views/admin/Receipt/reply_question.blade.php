
<html>
<body>


@php

$ask_questions=App\Models\CustomerQuestion::where('orderquestion_id',$question_id)->get();
$i=1;
$oquestion=App\Models\ReplyQuestion::where('orderquestion_id',$question_id)->OrderBy('id','desc')->first();

$cname=App\Models\OrderAskQuestion::where('id',$question_id)->first();
 @endphp


  
<div class="row">
<p>Ask Question By {{ $cname->name }} </p>
@foreach(json_decode($oquestion->question) as $q)

<div class="col-sm-6">
<textarea placeholder="Message" class="form-control"  readonly="readonly" name="question[]" rows="7" >{{ $q }}</textarea>
</div>

@endforeach
@php

$admin=App\Models\User::where('is_admin',1)->first();
@endphp
<p style="float:right">Reply Question By  {{ $admin->name }} </p>
@foreach(json_decode($oquestion->answer) as $a)
<div class="col-sm-6" style="float:right">
<textarea placeholder="Message" class="form-control"  readonly="readonly" name="question[]" rows="7">{{ $a }}</textarea>
</div>
@endforeach

</div>
<p>Thank you</p>




   </body>
   </html>