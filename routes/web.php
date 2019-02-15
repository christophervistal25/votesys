<?php
use App\Candidate;

$router->group(['prefix' => 'admin'] , function () use ($router) {

    $router->get('dashboard', ['uses' => 'Admin\AdminController@index', 'as' => 'dashboard']);
    

    
    $router->post('dashboard', ['uses' => 'Admin\VoteStatusController@update', 'as' => 'votestatus.update']);

    $router->get('candidates', ['uses' => 'Admin\CandidateController@index', 'as' => 'candidate.index']);
    $router->get('candidate/create', ['uses' => 'Admin\CandidateController@create', 'as' => 'candidate.create']);
    $router->post('candidate/create', ['uses' => 'Admin\CandidateController@store', 'as' => 'candidate.store']);

    $router->get('positions', ['uses' => 'Admin\PositionController@index', 'as' => 'position.index']);
    $router->get('position/create', ['uses' => 'Admin\PositionController@create', 'as' => 'position.create']);
    $router->get('position/edit/{id}', ['uses' => 'Admin\PositionController@edit', 'as' => 'position.edit']);
    $router->post('position/create', ['uses' => 'Admin\PositionController@store', 'as' => 'position.store']);
    $router->get('position/destroy/{id}',['uses' => 'Admin\PositionController@destroy', 'as' => 'position.destroy']);



    $router->get('voting', ['uses' => 'Admin\VotingController@index', 'as' => 'voting.index']);
});

$router->get('/', ['uses' => 'Admin\AuthController@showLogin', 'as' => 'login']);
$router->post('/', ['uses' => 'Admin\AuthController@checkUser', 'as' => 'submit.login']);


$router->post('/student/login', ['uses' => 'Student\AuthController@login', 'as' => 'student.login']);





