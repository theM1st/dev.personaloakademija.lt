<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'banners';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['banner_name', 'banner_image', 'banner_link', 'banner_zone', 'banner_order'];

    public static function getUploadPath($absolute=true)
    {
        return ($absolute) ? public_path() . '/uploads/banners/' : '/uploads/banners/';
    }

    public function getImage()
    {
        if (!$this->banner_image) {
            return null;
        }

        $dir = $this->getUploadPath(false);

        return $dir . $this->banner_image;
    }

    public function upload($file)
    {
        if ($file->isValid()) {
            $filename = md5_file($file->getRealPath()).'.'.$file->getClientOriginalExtension();

            $dir = $this->getUploadPath();

            $img = \Image::make($file->getRealPath());

            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $dir . $filename);
            }
            else {
                $img->save($dir . $filename);
            }

            return $filename;
        }

        return null;
    }

    public function moveup() {
        $prev = Banner::where('banner_order', '<', $this->banner_order)
            ->where('banner_zone', $this->banner_zone)->orderBy('banner_order', 'desc')
            ->first();

        $position = $this->banner_order;

        $this->banner_order = $prev->banner_order;
        $this->save();

        $prev->banner_order = $position;
        $prev->save();
    }

    public function movedown() {
        $next = Banner::where('banner_order', '>', $this->banner_order)
            ->where('banner_zone', $this->banner_zone)->orderBy('banner_order')
            ->first();

        $position = $this->banner_order;

        $this->banner_order = $next->banner_order;
        $this->save();

        $next->banner_order = $position;
        $next->save();
    }
}
