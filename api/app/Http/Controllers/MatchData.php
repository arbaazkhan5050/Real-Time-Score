<?php

namespace App\Http\Controllers;

use App\Events\MatchDataCheck;
use App\Round;
use App\Transformers\MatchTransformer;
use Illuminate\Http\Request;

/**
 * Class MatchData
 * @group Matches
 * @package App\Http\Controllers
 */
class MatchData extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get Match Data by Round ID
     *
     * Finds a round, and fetches all match data related to it
     * @param $id
     * @return \Dingo\Api\Http\Response|void
     */
    public function getByRoundId($id)
    {
        $round = Round::find($id);

        if(! $round )
        {
            return $this->response->errorNotFound();
        }
        else
        {
            $matches = $round->matches;
            event(new MatchDataCheck($matches));
            return $this->response->collection($matches, new MatchTransformer());
        }
    }
}
