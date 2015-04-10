<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['photo', 'request', 'rating', 'user_id', 'published', 'deleted', 'viewed',
        'deleted_at', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];
}