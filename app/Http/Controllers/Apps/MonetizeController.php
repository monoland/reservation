<?php

namespace App\Http\Controllers\Apps;

use App\Models\Monetize;
use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MonetizeCollection;
use App\Models\Segment;

class MonetizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Venue $venue)
    {
        $this->authorize('viewAny', Monetize::class);

        return new MonetizeCollection(
            $venue->monetizes()->with('segment')->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Venue $venue)
    {
        $this->authorize('create', Monetize::class);

        $this->validate($request, [
            //
        ]);

        return Monetize::storeRecord($request, $venue);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @param  \App\Models\Monetize  $monetize
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue, Monetize $monetize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venue  $venue
     * @param  \App\Models\Monetize  $monetize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue, Monetize $monetize)
    {
        $this->authorize('update', $monetize);

        $this->validate($request, [
            //
        ]);

        return Monetize::updateRecord($request, $monetize);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue  $venue
     * @param  \App\Models\Monetize  $monetize
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue, Monetize $monetize)
    {
        $this->authorize('delete', $monetize);

        return Monetize::destroyRecord($monetize);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Monetize  $monetize
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Monetize::class);
        
        return Monetize::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Monetize::fetchCombo($request);
    }

    /**
     * Undocumented function
     *
     * @param Venue $venue
     * @param Request $request
     * @return void
     */
    public function fetch(Venue $venue, Request $request)
    {
        return response()->json(
            $venue->monetizes()->whereRaw("segment_id = {$request->segment} AND type = '{$request->type}'")->first()
        );
    }
}
