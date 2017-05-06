<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvSocactivity extends Model {

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }

    public function scopeNotEmpty($query)
    {
        return $query->where('socactivity_name', '!=', '');
    }
}
