<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CvPhoto extends Model {

    protected $cv;

    public static $imageConfig = array(
        'lg' => array('width'=>240, 'height'=>300),
        'md' => array('width'=>120, 'height'=>150),
        'sm' => array('width'=>80, 'height'=>100, 'defaultMale'=>'/assets/img/default-male.png',  'defaultFemale'=>'/assets/img/default-female.png'),
        'xs' => array('width'=>50, 'height'=>50),
    );

    public function __construct(CV $cv)
    {
        $this->cv = $cv;
    }

    public function getName($size='')
    {
        if ($size)
        {
            return $size.'_'.$this->name;
        }

        return $this->name;
    }

    public static function getUploadPath($absolute=true)
    {
        return ($absolute) ? public_path() . '/uploads/cv/' : '/uploads/cv/';
    }

    public function getPhotoUploadPath($absolute=true)
    {
        if ($this->cv->id)
        {
            $dir = self::getUploadPath($absolute) . floor($this->cv->id/500) . '/' . $this->cv->id . '/';

            if ($absolute && !file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }

            return $dir;
        }

        return false;
    }

    public function uploadPhoto($file)
    {
        $filename = $this->slugFilename($file);

        $dir = $this->getPhotoUploadPath();

        $img = \Image::make($file->getRealPath());
        $img->save($dir.$filename);

        foreach (self::$imageConfig as $size => $c)
        {
            $img->fit($c['width'], $c['height'])->save($dir . $size . '-' . $filename);
        }

        return $filename;
    }

    public function getPhoto($size='sm')
    {
        $dir = $this->getPhotoUploadPath(false);

        if (empty($this->cv->photo))
        {
            if ($this->cv->gender == 'M')
            {
                return self::$imageConfig[$size]['defaultMale'];
            }

            if ($this->cv->gender == 'F')
            {
                return self::$imageConfig[$size]['defaultFemale'];
            }

            return null;
        }

        return $dir . $size . '-' . $this->cv->photo;
    }

    public function getPhotos()
    {
        $photos = array();

        foreach (self::$imageConfig as $size => $c)
        {
            $p = $this->getPhoto($size);
            if ($p)
                $photos[$size] = $this->getPhoto($size);
        }

        return $photos;
    }

    public function delete()
    {
        $dir = $this->getPhotoUploadPath();

        $files = array($dir . $this->cv->photo);
        foreach (self::$imageConfig as $size => $c)
        {
            $files[] = $dir . $size . '-' . $this->cv->photo;
        }

        \File::delete($files);
    }

    private function slugFilename($file)
    {
        return Str::slug(basename($file->getClientOriginalName(), $file->getClientOriginalExtension()), '_').'.'.$file->getClientOriginalExtension();
    }
}
