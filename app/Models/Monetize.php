<?php

namespace App\Models;

// use App\Traits\HasMetaField;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MonetizeResource;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Monetize extends Model
{
    // use HasMetaField, SoftDeletes;
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    /**
     * Undocumented function
     *
     * @return void
     */
    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    /**
     * Scope for combo
     */
    public function scopeFetchCombo($query)
    {
        return $query->select(
            'name AS text', 'id AS value'
        )->get();
    }

    /**
     * Scope for filter
     */
    public function scopeFilterOn($query, $request)
    {
        $sortaz = $request->sortDesc === 'true' ? 'desc' : 'asc';
        $sortby = $request->has('sortBy') ? $request->sortBy : null;
        $search = $request->has('search') ? strtolower($request->search) : null;

        $mixquery = $query;

        if ($search) {
            $mixquery = $mixquery->whereRaw("LOWER(name) LIKE '%{$search}%'");
        }

        if ($sortby) {
            $mixquery = $mixquery->orderBy($sortby, $sortaz);
        }

        return $mixquery;
    }

    /**
     * Undocumented function
     *
     * @param [type] $query
     * @return void
     */
    public function scopeItemOnly($query)
    {
        return $query->where('type', 'item')->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $query
     * @return void
     */
    public function scopePackageOnly($query)
    {
        return $query->where('type', 'package')->get();
    }

    /**
     * Store
     */
    public static function storeRecord($request, $parent)
    {
        DB::beginTransaction();

        try {
            $model = new static;
            $model->type = $request->type;
            $model->operational = $request->operational;
            $model->facility = $request->facility;
            $model->salary = $request->salary;
            $model->margin = $request->margin;
            $model->discount = $request->discount;
            $model->commission = $request->commission;
            $model->marketfee = $request->marketfee;
            $model->managerfee = $request->managerfee;
            $model->venuefee = $request->venuefee;
            $model->segment_id = $request->segment['value'];

            $parent->monetizes()->save($model);

            DB::commit();

            return new MonetizeResource($model);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    /**
     * Update
     */
    public static function updateRecord($request, $model)
    {
        DB::beginTransaction();

        try {
            // ...
            $model->save();

            DB::commit();

            return new MonetizeResource($model);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    /**
     * Destroy
     */
    public static function destroyRecord($model)
    {
        DB::beginTransaction();

        try {
            $model->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    /**
     * Bulks
     */
    public static function bulkDelete($request, $model = null)
    {
        DB::beginTransaction();

        try {
            $bulks = array_column($request->all(), 'id');
            $rests = (new static)->whereIn('id', $bulks)->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }
}
