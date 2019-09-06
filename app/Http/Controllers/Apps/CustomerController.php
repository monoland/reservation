<?php

namespace App\Http\Controllers\Apps;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerCollection;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Customer::class);

        if ($request->user()->isMarketing()) {
            $customers = $request->user()->userable->customers()->with(
                'segment', 'marketing', 'province', 'regency', 'district'
            )->filterOn($request)->paginate($request->itemsPerPage);
        } else {
            $customers = Customer::with(
                'segment', 'marketing', 'province', 'regency', 'district'
            )->filterOn($request)->paginate($request->itemsPerPage);
        }
        
        return new CustomerCollection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Customer::class);

        $this->validate($request, [
            //
        ]);

        return Customer::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $this->validate($request, [
            //
        ]);

        return Customer::updateRecord($request, $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        return Customer::destroyRecord($customer);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Customer::class);

        return Customer::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Customer::fetchCombo($request);
    }
}
