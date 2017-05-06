<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CvDocument extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cv_documents';

    public $timestamps = false;

    public function __construct($cv=null)
    {
        if ($cv) {
            $this->cv_id = $cv->id;
        }
    }

    public function getUploadPath($absolute=true)
    {
        $dir = ($absolute) ? public_path() . '/uploads/cv/' : '/uploads/cv/';

        if ($this->cv_id)
        {
            $dir = $dir . floor($this->cv_id/500) . '/' . $this->cv_id . '/files/';

            if ($absolute && !file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }

            return $dir;
        }

        return false;
    }

    public function upload($file)
    {
        if ($file && $file->isValid()) {
            $filename = time() . '_' . $this->slugFilename($file);

            $dir = $this->getUploadPath();

            $file->move($dir, $filename);

            $this->name = $filename;

            return $this->save();
        }

        return null;
    }

    public function delete()
    {
        $dir = $this->getUploadPath();

        \File::delete($dir.$this->name);

        parent::delete();
    }

    public function getFullpathAttribute()
    {
        $dir = $this->getUploadPath(false);

        return asset($dir . $this->attributes['name']);
    }

    public function getFilenameAttribute()
    {
        $dir = $this->getUploadPath(false);

        return substr(strstr($this->attributes['name'], '_'), 1);
    }

    private function slugFilename($file)
    {
        return Str::slug(basename($file->getClientOriginalName(), $file->getClientOriginalExtension()), '_').'.'.$file->getClientOriginalExtension();
    }
}
