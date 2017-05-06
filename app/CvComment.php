<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvComment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cv_comments';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }
}
