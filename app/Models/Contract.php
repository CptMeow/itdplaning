<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

/**
 * @property int    $contract_id
 * @property int    $contract_number
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $deleted_at
 * @property string $contract_name
 * @property string $contract_year
 * @property string $contract_description
 * @property string $contract_type
 * @property string $contract_status
 */
class Contract extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contracts';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'contract_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contract_name', 'contract_number', 'contract_year', 'contract_description', 'contract_type', 'contract_status', 'contract_start_date', 'contract_end_date', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'contract_id' => 'int', 'contract_name' => 'string', 'contract_number' => 'string', 'contract_year' => 'string', 'contract_description' => 'string', 'contract_type' => 'string', 'contract_status' => 'string', 'contract_start_date' => 'timestamp', 'contract_end_date' => 'timestamp', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'deleted_at' => 'timestamp',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'contract_start_date', 'contract_end_date', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...
    public function getHashidAttribute($value)
    {
        return Hashids::encode($this->getKey());
    }

    // Relations ...
    public function task()
    {
        return $this->hasManyThrough(
            'App\Models\ContractHasTask',
            'App\Models\Task',
            'contract_id',
            'task_id',
            'contract_id',
            'task_id',
        );
    }
}
