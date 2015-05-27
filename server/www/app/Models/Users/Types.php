<?php namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Types extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_types';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];
}