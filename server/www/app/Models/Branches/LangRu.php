<?php namespace App\Models\Branches;

use Illuminate\Database\Eloquent\Model;

class LangRu extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches_lang_ru';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['branch_id', 'name', 'description', 'about'];
}