<?php

namespace App\Http\Controllers\Apps;

use App\Models\Pricelist;
use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PricelistCollection;
use App\Http\Resources\PricelistCombo;

class PricelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Venue $venue)
    {
        $this->authorize('viewAny', Pricelist::class);

        return new PricelistCollection(
            $venue->pricelists()->filterOn($request)->paginate($request->itemsPerPage)
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
        $this->authorize('create', Pricelist::class);

        $this->validate($request, [
            //
        ]);

        return Pricelist::storeRecord($request, $venue);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @param  \App\Models\Pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue, Pricelist $pricelist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venue  $venue
     * @param  \App\Models\Pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue, Pricelist $pricelist)
    {
        $this->authorize('update', $pricelist);

        $this->validate($request, [
            //
        ]);

        return Pricelist::updateRecord($request, $pricelist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue  $venue
     * @param  \App\Models\Pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue, Pricelist $pricelist)
    {
        $this->authorize('delete', $pricelist);

        return Pricelist::destroyRecord($pricelist);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Pricelist::class);
        
        return Pricelist::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Pricelist::fetchCombo($request);
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
            PricelistCombo::collection(
                $venue->pricelists()->whereRaw("segment_id = {$request->segment} AND type = '{$request->type}'")->get()
            )
        );
    }
}
