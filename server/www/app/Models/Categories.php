<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_us', 'name_ua', 'name_ru'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];
}