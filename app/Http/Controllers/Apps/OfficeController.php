<?php

namespace App\Http\Controllers\Apps;

use App\Models\Employee;
use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Venue $venue)
    {
        $this->authorize('viewAny', Employee::class);

        return new EmployeeCollection(
            $venue->employees()->filterOn($request)->paginate($request->itemsPerPage)
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
        $this->authorize('create', Employee::class);

        $this->validate($request, [
            //
        ]);

        return Employee::storeRecord($request, $venue);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue, Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venue  $venue
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue, Employee $employee)
    {
        $this->authorize('update', $employee);

        $this->validate($request, [
            //
        ]);

        return Employee::updateRecord($request, $employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue  $venue
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue, Employee $employee)
    {
        $this->authorize('delete', $employee);

        return Employee::destroyRecord($employee);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Employee::class);
        
        return Employee::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Employee::fetchCombo($request);
    }
}
