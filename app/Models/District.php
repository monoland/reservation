<?php

namespace App\Models;

// use App\Traits\HasMetaField;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DistrictResource;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
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
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
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
     * Store
     */
    public static function storeRecord($request)
    {
        DB::beginTransaction();

        try {
            $model = new static;
            // ...
            $model->save();

            DB::commit();

            return new DistrictResource($model);
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

            return new DistrictResource($model);
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
