<table border="1">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>Running for</th>
                <th>No. of votes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($candidates as $candidate)
            <tr>
            <td>{{ucfirst($candidate->studentInfo->lastname) }} , {{ucfirst($candidate->studentInfo->firstname)}} {{ucfirst(substr($candidate->studentInfo->middlename,0,1))}}.</td>
            <td>{{ucfirst($candidate->position['name'])}}</td>
            <td>{{$candidate->votes->count()}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    