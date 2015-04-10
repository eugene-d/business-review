<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type_id', 'email_notifications', 'is_active', 'email', 'password', 'code',
        'first_name', 'last_name', 'photo', 'phone', 'website', 'registered_at', 'last_login_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];
}