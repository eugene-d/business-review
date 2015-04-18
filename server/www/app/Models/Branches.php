<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model {
    /**
     * Set calculated default attributes
     * @param array $attributes
     */
    public function __construct(array $attributes = array()) {
        $this->setRawAttributes(array(
            'updated_at' => Carbon::now()->toDateTimeString()
        ), true);
        parent::__construct($attributes);
    }

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
    protected $fillable = ['photo', 'request', 'rating', 'user_id', 'published', 'deleted', 'viewed', 'deleted_at',
        'created_at', 'updated_at', 'name_us', 'name_ua', 'name_ru'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];

    /**
     * The relations method
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function email() {
        return $this->hasMany('App\Models\Branches\Emails', 'branch_id', 'id');
    }

    /**
     * The relations method
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phone() {
        return $this->hasMany('App\Models\Branches\Phones', 'branch_id', 'id');
    }

    /**
     * The relations method
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function site() {
        return $this->hasMany('App\Models\Branches\Sites', 'branch_id', 'id');
    }

    /**
     * The relations method
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function description() {
        return $this->hasOne('App\Models\Branches\Descriptions', 'branch_id', 'id');
    }

    /**
     * The relations method
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location() {
        return $this->hasOne('App\Models\Branches\Locations', 'branch_id', 'id');
    }
}