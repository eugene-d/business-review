<?php namespace App\Models\Branches;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches_sites';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['site_priority', 'site'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id', 'branch_id'];

    /**
     * The relations method
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch() {
        return $this->belongsTo('App\Models\Branches', 'branch_id');
    }
}