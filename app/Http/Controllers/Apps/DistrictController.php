<?php

namespace App\Http\Controllers\Apps;

use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictCollection;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Regency $regency)
    {
        $this->authorize('viewAny', District::class);

        return new DistrictCollection(
            $regency->districts()->withCount('customers')->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Regency $regency)
    {
        $this->authorize('create', District::class);

        $this->validate($request, [
            //
        ]);

        return District::storeRecord($request, $regency);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Regency  $regency
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(Regency $regency, District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Regency  $regency
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regency $regency, District $district)
    {
        $this->authorize('update', $district);

        $this->validate($request, [
            //
        ]);

        return District::updateRecord($request, $district);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Regency  $regency
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regency $regency, District $district)
    {
        $this->authorize('delete', $district);

        return District::destroyRecord($district);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', District::class);
        
        return District::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request, Regency $regency)
    {
        return $regency->districts()->fetchCombo($request);
    }
}
