<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['state_id', 'name_us', 'name_ua', 'name_ru', 'latitude', 'longitude'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];
}