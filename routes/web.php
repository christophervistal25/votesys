<?php
use App\Candidate;

$router->group(['prefix' => 'admin'] , function () use ($router) {

$router->get('dashboard', ['uses' => 'Admin\AdminController@index', 'as' => 'admin.dashboard']);
$router->post('dashboard', ['uses' => 'Admin\VoteStatusController@update', 'as' => 'votestatus.update']);
$router->get('students', ['uses' => 'Admin\StudentController@index', 'as' => 'admin.students']);
$router->get('profile', ['uses' => 'Admin\AdminController@show', 'as' => 'profile.show']);
$router->post('profile', ['uses' => 'Admin\AdminController@update', 'as' => 'profile.update']);

$router->group(['middleware' => 'is_there_candidate'] , function () use ($router) {
        $router->get('candidates', [ 'uses' => 'Admin\CandidateController@index', 'as' => 'candidate.index']);
        $router->get('candidates/rank' , ['uses' => 'Admin\CandidateController@ranks' , 'as' => 'candidate.ranks']);
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

$router->get('/', ['uses' => 'Admin\AuthController@showLogin', 'as' => 'login']);
$router->post('/', ['uses' => 'Admin\AuthController@checkUser', 'as' => 'submit.login']);





$router->group(['prefix' => 'api'] , function () use ($router) {
    $router->post('/student/login', ['uses' => 'Student\AuthController@login', 'as' => 'student.login']);
    $router->post('/student/register', ['uses' => 'Student\AuthController@register', 'as' => 'student.register']);
    $router->post('/check/mac',['uses' => 'Student\AddressController@check' , 'as' => 'student.checkmac']);

    $router->get('/candidates',['uses' => 'Student\CandidatesController@candidates' , 'as' => 'candidates.list']);
    $router->post('/student/vote/',['uses' => 'Student\VoteController@vote', 'as' => 'student.vote']);
});





