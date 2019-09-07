<?php

namespace App\Http\Controllers\Apps;

use App\Models\Marketing;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MarketingCollection;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Employee $employee)
    {
        $this->authorize('viewAny', Marketing::class);

        return new MarketingCollection(
            $employee->marketings()->withCount('customers')->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employee $employee)
    {
        $this->authorize('create', Marketing::class);

        $this->validate($request, [
            //
        ]);

        return Marketing::storeRecord($request, $employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, Marketing $marketing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee, Marketing $marketing)
    {
        $this->authorize('update', $marketing);

        $this->validate($request, [
            //
        ]);

        return Marketing::updateRecord($request, $marketing);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, Marketing $marketing)
    {
        $this->authorize('delete', $marketing);

        return Marketing::destroyRecord($marketing);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Marketing::class);
        
        return Marketing::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Marketing::fetchCombo($request);
    }
}
