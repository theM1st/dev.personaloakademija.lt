<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvSave extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cv_saves';

    protected $fillable = ['cv_id', 'user_id'];

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }
}
