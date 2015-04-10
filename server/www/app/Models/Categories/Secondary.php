<?php namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class Secondary extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories_secondary';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'name_us', 'name_ua', 'name_ru'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];
}