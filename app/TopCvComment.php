<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TopCvComment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'top_cv_comments';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cv()
    {
        return $this->belongsTo('App\topCv', 'cv_id');
    }
}
