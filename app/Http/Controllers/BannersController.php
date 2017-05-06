<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Banner;

class BannersController extends Controller
{
    public function index() {
        $leftBanners = Banner::orderBy('banner_zone')->where('banner_zone', 'left')->orderBy('banner_order')->get();
        $rightBanners = Banner::orderBy('banner_zone')->where('banner_zone', 'right')->orderBy('banner_order')->get();


        return view('banners.index', ['leftBanners' => $leftBanners, 'rightBanners' => $rightBanners]);
    }

    public function create() {
        $banner = new Banner;

        return view('banners.create', ['banner' => $banner]);
    }

    public function store(CreateBannerRequest $request) {
        $data = $request->all();

        $banner = new Banner;
        $data['banner_image'] = $banner->upload($request->file('banner_image'));

        $data['banner_order'] = Banner::where('banner_zone', $data['banner_zone'])->max('banner_order')+1;

        $banner->create($data);

        return redirect()->action('BannersController@index');
    }

    public function edit($id) {
        $banner = Banner::findOrFail($id);

        return view('banners.edit', ['banner' => $banner]);
    }

    public function update($id, UpdateBannerRequest $request)
    {
        $banner = Banner::findOrFail($id);

        $banner->update($request->all());

        return redirect()->action('BannersController@index');
    }

    public function move($id, $direction) {
        $banner = Banner::findOrFail($id);

        if ($direction == 'up') {
            $banner->moveup();
        }

        if ($direction == 'down') {
            $banner->movedown();
        }

        return redirect()->back();
    }

    public function destroy($id) {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->back();
    }
}
