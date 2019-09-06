<?php

namespace App\Http\Controllers\Apps;

use App\Models\Regency;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegencyCollection;

class RegencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Province $province)
    {
        $this->authorize('viewAny', Regency::class);

        return new RegencyCollection(
            $province->regencies()->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Province $province)
    {
        $this->authorize('create', Regency::class);

        $this->validate($request, [
            //
        ]);

        return Regency::storeRecord($request, $province);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province, Regency $regency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province, Regency $regency)
    {
        $this->authorize('update', $regency);

        $this->validate($request, [
            //
        ]);

        return Regency::updateRecord($request, $regency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province, Regency $regency)
    {
        $this->authorize('delete', $regency);

        return Regency::destroyRecord($regency);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Regency::class);
        
        return Regency::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request, Province $province)
    {
        return $province->regencies()->fetchCombo($request);
    }
}
