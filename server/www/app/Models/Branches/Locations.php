<?php namespace App\Models\Branches;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model {
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'branches_locations';
    public $timestamps = false;
    protected $primaryKey = 'branch_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['city_id', 'zip_id', 'address_us', 'address_ua', 'address_ru', 'latitude', 'longitude'];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = ['branch_id'];

    /**
     * The relations method
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch() {
        return $this->belongsTo('App\Models\Branches', 'branch_id');
    }
}