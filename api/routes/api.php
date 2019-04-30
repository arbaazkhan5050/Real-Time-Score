<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the RESTful API.
| The API uses Dingo API and JWT Tokens.
|
*/
$api = app('Dingo\Api\Routing\Router'); // we're using Dingo API
$api_namespace = 'App\Http\Controllers';

$api->version('v1', function ($api) use($api_namespace) {

//    $api->post('login', ['as'   =>  'login',    'uses'  =>  $api_namespace . '\AuthController@login']);

    // Teams (with players)
    $api->get('teams', ['as'   =>  'teams.index',    'uses'  =>  $api_namespace . '\Teams@index']);

    // players
//    $api->get('players', ['as'   =>  'players.index',    'uses'  =>  $api_namespace . '\players@index']);

    // Rounds
    $api->post('rounds', $api_namespace . '\Rounds@store');

    // Matches and Match Data
    $api->get('round/{id}/matches', $api_namespace . '\MatchData@getByRoundId');
});
