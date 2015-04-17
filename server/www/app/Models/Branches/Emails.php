<?php namespace App\Models\Branches;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches_emails';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email_priority', 'email'];

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