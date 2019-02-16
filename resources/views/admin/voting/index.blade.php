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
                            <div class="icon"><i class="fa fa-check-square-o"></i></div>
                            <div class="count">{{ $candidate->votes->count() }}</div>
                            <div class="count">{{ucfirst($candidate->studentInfo->lastname) }} , {{ucfirst($candidate->studentInfo->firstname)}} {{ucfirst(substr($candidate->studentInfo->middlename,0,1))}}.</div>
                            {{-- <small>Platforms : {{ $candidate->platforms }}</small> --}}
                        </div>
                    </div>
                @endif
            @endforeach
    </div>
    <hr>
    @endforeach
</div>
@endsection
