<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutBVTH;
use App\Models\AdBannerFooter;
use App\Models\DoctorBvth;
use App\Models\Department;
use App\Models\AdBannerMain;
use App\Models\VideoBvth;
use App\Models\AlbumsBVTH;
use App\Models\PhotoCatalogBvth;
use App\Models\InfrastructureBvth;
use App\Models\CatalogDepartments;
use App\Models\PackageHealthcare;
use App\Models\Healthcare;
use App\Models\PriceTechnicalService;
use App\Models\Newspaper;
use App\Models\CatalogNewspaper;
use Illuminate\Support\Facades\Log;

class OnePageController extends Controller
{
    public function about()
    {
        $footerSlider = AdBannerFooter::where('status', 1)->orderBy('sort')->get();
        $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();

        $aboutBVTH = AboutBVTH::where('status', 1)->orderBy('sort')->take(1)->first();
        return view('onepage.aboutBVTH', [
            'aboutBVTH' => $aboutBVTH, 
            'footerSlider' => $footerSlider, 
            'mainSlider' => $mainSlider,
        ]);
    }

    public function about_doctor()
    {
        $footerSlider = AdBannerFooter::where('status', 1)->orderBy('sort')->get();
        $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();

        $doctors = DoctorBvth::where('status', 1)->orderBy('sort', 'DESC')->get();
        foreach($doctors as $item) {
            $departments = json_decode($item->departments);
            $new_departments = array();
            foreach ($departments as $id) {
                $department = Department::where('status', 1)->where('id', $id)->first();
                if (!empty($department->name)) {
                    array_push($new_departments, $department->name);
                }
            }
            $item->departments_name = json_encode($new_departments);
        }
        $departments = Department::where('status', 1)->orderBy('sort', 'DESC')->get();

        return view('onepage.about-doctor', [
            'doctors' => $doctors,
            'departments' => $departments,
            'footerSlider' => $footerSlider,
            'mainSlider' => $mainSlider,
        ]);
    }

    public function photos_videos()
    {
        $footerSlider = AdBannerFooter::where('status', 1)->orderBy('sort')->get();
        $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();

        $category = PhotoCatalogBvth::where('status', 1)->orderBy('sort')->get();
        $photos = AlbumsBVTH::where('status', 1)->orderBy('sort')->get();
        $videos = VideoBvth::where('status', 1)->orderBy('sort')->get();

        return view('onepage.photos_videos', [
            'category' => $category, 
            'photos' => $photos, 
            'videos' => $videos, 
            'footerSlider' => $footerSlider, 
            'mainSlider' => $mainSlider,
        ]);
    }

    public function get_photos_videos(Request $request)
    {
        $id = $request->get('dataId');
        $type = $request->get('dataType');
        if ($type == 'videos') {
            $data = VideoBvth::find($id);
            $data->elems = json_decode($data->videos);
            $data->type = 'videos';
        } else {
            $data = AlbumsBVTH::find($id);
            $data->elems = json_decode($data->images);
            $data->type = 'photos';
        }

        return response()->json($data);
    }

    public function infrastructure()
    {
        $footerSlider = AdBannerFooter::where('status', 1)->orderBy('sort')->get();
        $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();

        $infrastructures = InfrastructureBvth::where('status', 1)->orderBy('sort')->paginate(12);
        return view('onepage.infrastructure', [
            'infrastructures' => $infrastructures, 
            'footerSlider' => $footerSlider, 
            'mainSlider' => $mainSlider,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function infrastructure_detail($id, $title)
    {
        $infrastructure = InfrastructureBvth::find($id);

        $footerSlider = AdBannerFooter::where('status', 1)->orderBy('sort')->get();
        $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();

        return view('onepage.infrastructure_detail', [
            'infrastructure' => $infrastructure, 
            'footerSlider' => $footerSlider, 
            'mainSlider' => $mainSlider,
        ]);
    }

    public function department($id, $title)
    {
        $department = CatalogDepartments::find($id);

        $footerSlider = AdBannerFooter::where('status', 1)->orderBy('sort')->get();
        $mainSlider = AdBannerMain::where('status', 1)->orderBy('sort')->get();

        return view('onepage.department', [
            'department' => $department, 
            'footerSlider' => $footerSlider, 
            'mainSlider' => $mainSlider,
        ]);
    }

    public function healthcare()
    {
        $healthcare = Healthcare::where('status', 1)->orderBy('sort')->take(1)->first();
        return view('onepage.healthcare', [
            'healthcare' => $healthcare, 
        ]);
    }

    public function health_package()
    {
        $healthcare = PackageHealthcare::where('status', 1)->orderBy('sort')->take(1)->first();
        return view('onepage.health_package', [
            'healthcare' => $healthcare, 
        ]);
    }

    public function service_price()
    {
        $lists = PriceTechnicalService::where('status', 1)->orderBy('group', 'ASC')->get();
        return view('onepage.service_price', [
            'lists' => $lists, 
        ]);
    }

    public function news()
    {
        // 4 bai dang moi nhat
        $news = Newspaper::where('status', 1)->orderBy('created_at', 'DESC')->take(4)->get();
        foreach($news as $item) {
            $catalogues = json_decode($item->catalogues);
            $new_catalogues = array();
            foreach ($catalogues as $id) {
                $catalog = CatalogNewspaper::where('status', 1)->where('id', $id)->first();
                if (!empty($catalog->name)) {
                    array_push($new_catalogues, $catalog->name);
                }
            }
            $item->catalogues_name = json_encode($new_catalogues);
        }
        $categories = CatalogNewspaper::where('status', 1)->orderBy('sort')->get();
        foreach($categories as $category) {
            $new = Newspaper::whereRaw('json_contains(catalogues, \'["' . $category->id . '"]\')')->where('status', 1)->orderBy('created_at', 'DESC')->take(3)->get();
            // Log::info(Newspaper::whereRaw('json_contains(catalogues, \'["' . $category->id . '"]\')')->where('status', 1)->orderBy('created_at', 'DESC')->take(3)->toSql());
            $_new = array();
            foreach($new as $item) {
                $_new[$item->id]['new_id'] = $item->id;
                $_new[$item->id]['new_title'] = $item->title;
                $_new[$item->id]['new_describe'] = $item->describe;
                $_new[$item->id]['new_image_file_name'] = $item->image_file_name;
                $_new[$item->id]['new_created_at'] = $item->created_at->format('d/m/Y');
            }
            $category->new = json_encode($_new);
        }
        return view('onepage.news', [
            'news' => $news,
            'categories' => $categories,
        ]);
    }

    public function news_detail($id, $title)
    {
        $categories = CatalogNewspaper::where('status', 1)->orderBy('sort')->get();
        $news = Newspaper::whereRaw('json_contains(catalogues, \'["' . $id . '"]\')')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(10);
        foreach($news as $item) {
            $catalogues = json_decode($item->catalogues);
            $new_catalogues = array();
            foreach ($catalogues as $id) {
                $catalog = CatalogNewspaper::where('status', 1)->where('id', $id)->first();
                if (!empty($catalog->name)) {
                    array_push($new_catalogues, $catalog->name);
                }
            }
            $item->catalogues_name = json_encode($new_catalogues);
        }
        $catalog = CatalogNewspaper::where('status', 1)->where('id', $id)->first();

        return view('onepage.news_detail', [
            'news' => $news,
            'categories' => $categories,
            'catalog' => $catalog
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}