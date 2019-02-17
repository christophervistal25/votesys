@extends('admin.templates.master' , [
'title'        => 'Votes',
'voting_state' => getCurrentStateOfVote(),
'admin'        => getAdminInfo()
])
@section('content')
<div id="votes">
    @foreach ($positions as $keys => $position)
    <div class="row top_tiles">
        <h3 style="margin-left : 1vw;">{{ $position->name }}</h3>
            @foreach ($candidates as $candidate)
                @if ($position->id === $candidate->position_id)
                    <div class="flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">

                        <div class="tile-stats">
                            <div class="text-center">
                                <img src="{{ URL::asset('images/' .  $candidate->profile ) }}" alt="..." class="img-circle img-responsive profile_img text-center">
                            </div>
                            <div class="clearfix"></div>
                            <div class="text-center  count">{{ $candidate->votes->count() }}</div>
                            <div class="count text-center">{{ucfirst($candidate->studentInfo->lastname) }} , {{ucfirst($candidate->studentInfo->firstname)}} {{ucfirst(substr($candidate->studentInfo->middlename,0,1))}}.</div>
                        </div>
                    </div>
                @endif
            @endforeach
    </div>
    <hr>
    @endforeach
</div>
@endsection
