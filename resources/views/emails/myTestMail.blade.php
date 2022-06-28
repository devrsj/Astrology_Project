@php

$admin=App\Models\User::where('is_admin',1)->first();
@endphp

<div class="col-sm-5" style="float:right">

Reply Preferred date By: {{ $admin->name }}
<input type="text" class="form-control" name="first_date" value="{{ $reply_date }}" disaled>

Reply Preferred time By: {{ $admin->name }}
<input type="text" class="form-control" name="first_date" value="{{ $reply_time }}" disabled>


</div>
