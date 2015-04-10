<?php namespace App\Models\Branches;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches_locations';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['branch_id', 'city_id', 'zip_id', 'address_us', 'address_ua', 'address_ru',
        'latitude', 'longitude'
    ];
}