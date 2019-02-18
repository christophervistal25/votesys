@extends('admin.templates.master' , [
    'title'        => 'Edit Position',
    'voting_state' => getCurrentStateOfVote(),
    'admin'        => getAdminInfo()
])
@section('content')
@if (hasMessage('errors'))
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong style="color:#fff;">{{ getFlashMessage('errors') }}</strong>
  </div>
  @php
    flushMessage('errors');
  @endphp
@endif
<form method="POST" action="/admin/position/update/{{$position->id}}" autocomplete="off">
       <div class="row">
           <div class="col-md-12"><label>Position : </label>
            <input name="name" type="text" class="form-control" value="{{$position->name}}" >
            </div>
       </div>

        <div class="row">
           <div class="col-md-12" style="margin-top : 1vw;"><label >No. of can run</label>
              <input name="limit" type="number" class="form-control" id="formGroupExampleInput2" value={{$position->limit}}>
            </div>
       </div>

       <div class="row">
           <div class="col-md-12" style="margin-top : 1vw;"><label >Students can vote :</label>
              <input name="student_can_vote" type="number" class="form-control" id="formGroupExampleInput2" value={{$position->student_can_vote}}>
            </div>
       </div>
        <div style="margin-top: 1vw;" class="pull-right">
            <input type="submit" value="update position" class="text-capitalize btn btn-success">
        </div>
    </form>

@endsection
