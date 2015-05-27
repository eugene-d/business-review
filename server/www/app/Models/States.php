<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'name_us', 'name_ua', 'name_ru', 'code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];
}