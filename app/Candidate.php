<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model {
    protected $table = 'offer_candidates';

    protected $fillable = ['offer_id','cv_id'];

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }
}