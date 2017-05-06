<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OfferLogo extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offer_logos';

    public $timestamps = false;

    protected $fillable = ['deleted'];

    public static $imageConfig = array(
        'md' => array('width'=>200, 'height'=>140),
        'sm' => array('width'=>100, 'height'=>60),
        //'xs' => array('width'=>50, 'height'=>50),
    );

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }

    public static function getUploadPath($absolute=true)
    {
        return ($absolute) ? public_path() . '/uploads/offers/logos/' : '/uploads/offers/logos/';
    }

    public function getPhotoUploadPath($absolute=true)
    {
        $dir = self::getUploadPath($absolute) . $this->offer_id . '/';

        if ($absolute && !file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        return $dir;
    }

    public function upload($file)
    {
        $filename = self::slugFilename($file);

        $dir = $this->getPhotoUploadPath();

        $img = \Image::make($file->getRealPath());

        foreach (self::$imageConfig as $size => $c)
        {
            $img->resize($c['width'], $c['height'], function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($dir . $size . '-' . $filename);
        }

        $this->filename = $filename;

        $this->save();
    }

    public static function getBase64Logo($file)
    {
        $filename = time() . self::slugFilename($file);

        $dir = self::getUploadPath();
        $img = \Image::make($file->getRealPath());
        $img->resize(self::$imageConfig['md']['width'], self::$imageConfig['md']['height'], function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($dir.$filename);

        return 'data:image/'.$file->getClientOriginalExtension().';base64,'.
            base64_encode(file_get_contents(self::getUploadPath().$filename));
    }

    public function delete()
    {
        $dir = $this->getPhotoUploadPath();

        $files = [];
        foreach (self::$imageConfig as $size => $c) {
            $files[] = $dir . $size . '-' . $this->filename;
        }

        \File::delete($files);

        parent::delete();

        return true;
    }

    private static function slugFilename($file)
    {
        return Str::slug(basename($file->getClientOriginalName(), $file->getClientOriginalExtension()), '_').'.'.$file->getClientOriginalExtension();
    }

    public function getRelativeLogoMdAttribute()
    {
        $dir = $this->getPhotoUploadPath(false);

        return $dir . 'md-' . $this->filename;
    }

    public function getRelativeLogoSmAttribute()
    {
        $dir = $this->getPhotoUploadPath(false);

        return $dir . 'sm-' . $this->filename;
    }
}
