<?php namespace App\Models\Branches;

use Illuminate\Database\Eloquent\Model;

class Descriptions extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches_descriptions';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description_us', 'about_us', 'description_ua', 'about_ua', 'description_ru', 'about_ru'];

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