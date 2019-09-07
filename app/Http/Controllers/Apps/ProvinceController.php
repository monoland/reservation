<?php

namespace App\Http\Controllers\Apps;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Resources\ProvinceCollection;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Province::class);
        
        return new ProvinceCollection(
            Province::withCount('customers', 'regencies')->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Province::class);

        $this->validate($request, [
            //
        ]);

        return Province::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $this->authorize('update', $province);

        $this->validate($request, [
            //
        ]);

        return Province::updateRecord($request, $province);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        $this->authorize('delete', $province);

        return Province::destroyRecord($province);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Province::class);

        return Province::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Province::fetchCombo($request);
    }
}
