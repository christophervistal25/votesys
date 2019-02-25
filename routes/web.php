<?php

$router->group(['prefix' => 'admin' ,'middleware' => 'admin.auth'] , function () use ($router) {

$router->get('dashboard', ['uses' => 'Admin\AdminController@index', 'as' => 'admin.dashboard']);
$router->get('students', ['uses' => 'Admin\StudentController@index', 'as' => 'admin.students']);
$router->get('logout', ['uses' => 'Admin\AuthController@logout', 'as' => 'admin.logout']);

$router->get('profile', ['uses' => 'Admin\AdminController@show', 'as' => 'profile.show']);
$router->post('profile', ['uses' => 'Admin\AdminController@update', 'as' => 'profile.update']);

$router->get('students/import', ['uses' => 'Admin\StudentController@import', 'as' => 'student.import']);
$router->post('students/import', ['uses' => 'Admin\StudentController@process_import', 'as' => 'student.process.import']);

$router->group(['middleware' => 'is_there_candidate'] , function () use ($router) {
        $router->get('candidates', [ 'uses' => 'Admin\CandidateController@index', 'as' => 'candidate.index']);
        $router->get('candidates/rank' , ['uses' => 'Admin\CandidateController@ranks' , 'as' => 'candidate.ranks']);
        $router->post('dashboard', ['uses' => 'Admin\VoteStatusController@update', 'as' => 'votestatus.update']);
});


$router->get('position/create', ['uses' => 'Admin\PositionController@create', 'as' => 'position.create']);
$router->post('position/create', ['uses' => 'Admin\PositionController@store', 'as' => 'position.store']);

$router->group(['middleware' => 'is_there_position'] , function () use ($router) {
    $router->get('candidate/create', ['uses' => 'Admin\CandidateController@create', 'as' => 'candidate.create']);
    $router->post('candidate/create', ['uses' => 'Admin\CandidateController@store', 'as' => 'candidate.store']);
    $router->get('positions', ['uses' => 'Admin\PositionController@index', 'as' => 'position.index']);
    $router->get('position/edit/{id}', ['uses' => 'Admin\PositionController@edit', 'as' => 'position.edit']);
    $router->post('position/update/{id}', ['uses' => 'Admin\PositionController@update', 'as' => 'position.update']);
    $router->get('position/destroy/{id}',['uses' => 'Admin\PositionController@destroy', 'as' => 'position.destroy']);
});




    $router->post('latestvotes', ['uses' => 'Admin\VotingController@getLatestVotes', 'as' => 'voting.show']);
    $router->get('voting', ['middleware' => 'is_voting_open','uses' => 'Admin\VotingController@index', 'as' => 'voting.index']);
    $router->get('newvotes', ['uses' => 'Admin\VotingController@getNewVotes', 'as' => 'voting.show']);
});

$router->get('/', ['uses' => 'Admin\AuthController@showLogin' , 'as' => 'login']);
$router->post('/', ['uses' => 'Admin\AuthController@checkUser', 'as' => 'submit.login']);





$router->group(['prefix' => 'api'] , function () use ($router) {
    //in production add the student/login routers to is_voting_middleware
    $router->post('/student/login', ['uses' => 'Student\AuthController@login', 'as' => 'student.login']);
    $router->get('/student/{id}',['uses' => 'Student\InfoController@show', 'as' => 'student.info']);
    $router->post('/student/changepassword',['uses' => 'Student\InfoController@changePassword','as' => 'student.changepassword']);
    $router->post('/student/register', ['uses' => 'Student\AuthController@register', 'as' => 'student.register']);
    $router->post('/check/mac',['uses' => 'Student\AddressController@check' , 'as' => 'student.checkmac']);

    $router->group(['middleware' => 'is_voting_open'] , function () use ($router) {
        $router->get('/positions',['uses' => 'Student\PositionController@list' , 'as' => 'positions.list']);
        $router->get('/candidates',['uses' => 'Student\CandidatesController@candidates' , 'as' => 'candidates.list']);
        $router->get('/candidates/{id}',['uses' => 'Student\CandidatesController@candidateInAPosition' , 'as' => 'candidates.in_position.list']);
        $router->post('/student/vote/',['middleware' => 'is_this_student_can_vote','uses' => 'Student\VoteController@vote', 'as' => 'student.vote']);


    });



        $router->group(['prefix' => 'mobile','middleware' => 'is_voting_open'] , function () use ($router) {
            $router->get('/candidates/{name}/{voter}',['uses' => 'Student\CandidatesController@candidatesByPositionName']);
        });

});











