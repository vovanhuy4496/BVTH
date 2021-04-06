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
use App\Models\Consultation;
use App\Models\JobDescription;
use App\Models\RecruitmentArticles;
use App\Models\ContactDescription;
use App\Models\ContactWe;
use App\Models\WriteComment;
use App\Models\EmailTemplate;
use App\Models\MedicalAppointment;

use Mail;
use URL;

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

    public function news_catology($id, $title)
    {
        // $categories = CatalogNewspaper::where('status', 1)->orderBy('sort')->get();
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
            $url = stripVN($item->title);
            $url = preg_replace("/\s+/", '-', $url);
            $url = URL::to("/tin-tuc").'/chi-tiet'.'/'.$item->id.'/'.$url;
            $item->url = $url;
        }
        $catalog = CatalogNewspaper::where('status', 1)->where('id', $id)->first();

        return view('onepage.news_catology', [
            'news' => $news,
            // 'categories' => $categories,
            'catalog' => $catalog
        ]);
    }

    public function news_detail($id, $title)
    {
        $categories = CatalogNewspaper::where('status', 1)->orderBy('sort')->get();

        $new = Newspaper::find($id);
        $catalogues = $new->catalogues;
        $related = Newspaper::whereRaw('json_contains(catalogues, \'' . $catalogues . '\')')->where('status', 1)->orderBy('created_at', 'DESC')->get();

        foreach($related as $item) {
            $url = stripVN($item->title);
            $url = preg_replace("/\s+/", '-', $url);
            $url = URL::to("/tin-tuc").'/chi-tiet'.'/'.$item->id.'/'.$url;
            $item->url = $url;
        }

        foreach($categories as $item) {
            $url = stripVN($item->name);
            $url = preg_replace("/\s+/", '-', $url);
            $url = URL::to("/tin-tuc").'/danh-muc'.'/'.$item->id.'/'.$url;
            $item->url = $url;
        }

        return view('onepage.news_detail', [
            'new' => $new,
            'related' => $related,
            'categories' => $categories,
        ]);
    }

    public function consultation()
    {
        $consultations = Consultation::where('status', 1)->orderBy('sort')->paginate(12);
        $departments = Department::where('status', 1)->orderBy('sort', 'DESC')->get();

        foreach($consultations as $item) {
            $department = Department::find($item->department);
            if (!empty($department->name)) {
                $item->department = $department->name;
            }

            $doctor = DoctorBvth::find($item->doctor);
            if (!empty($doctor->name)) {
                $item->doctor = $doctor->name;
                $item->position = $doctor->position;
                $item->specialized = $doctor->specialized;
                $item->image_file_name = $doctor->image_file_name;
            }
        }

        return view('onepage.consultation', [
            'consultations' => $consultations,
            'departments' => $departments
        ]);
    }

    public function recruitment()
    {
        $description = JobDescription::where('status', 1)->orderBy('sort')->take(1)->first();
        $lists = RecruitmentArticles::where('status', 1)->orderBy('sort', 'DESC')->get();

        return view('onepage.recruitment', [
            'lists' => $lists,
            'description' => $description
        ]);
    }

    public function contact()
    {
        $description = ContactDescription::where('status', 1)->orderBy('sort')->take(1)->first();
        $lists = RecruitmentArticles::where('status', 1)->orderBy('sort', 'DESC')->get();

        return view('onepage.contact', [
            'lists' => $lists,
            'description' => $description
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContact(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $content = $request->get('content');

        $checkStatus = ContactWe::where('status', 0)
                                        ->where('content', $content)
                                        ->where('name', $name)
                                        ->where('phone', $phone)
                                        ->first();
        if ($checkStatus) {
            return response()->json('Quý khách đã gửi Lời nhắn, yêu cầu này cho chúng tôi rồi. Vui lòng gửi Lời nhắn, yêu cầu khác ! Xin cảm ơn !');
        }

        $sort = ContactWe::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        $item = new ContactWe();
        $item->name = $name;
        $item->phone = $phone;
        $item->email = $email;
        $item->content = $content;
        $item->status = 0;
        $item->sort = $sort;
        $item->save();

        return response()->json('Success');
        // return response()->json('Cảm ơn Quý khách đã gửi thông tin liên hệ đến Bệnh viện đa khoa Tân Hưng. Xin cảm ơn !');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAppointment(Request $request)
    {
        $name = $request->get('cus_name');
        $email = $request->get('cus_email');
        $describe_symptoms = $request->get('describe_symptoms');
        $phone = $request->get('cus_phone');
        $birth = $request->get('cus_birth');
        $gender = $request->get('cus_gender');
        $doctor = $request->get('doctor');
        $department = $request->get('department');
        $appointmentDate = $request->get('appointment-date');

        // status: 0 da dang ky, 1 dang kham, 2 da kham xong
        if (!empty($doctor) || !empty($department)) {
            $checkStatus = MedicalAppointment::where('status', 0)
                                            ->where('doctor', $doctor)
                                            ->where('department', $department)
                                            ->where('appointment_date', $appointmentDate)
                                            ->first();
            if ($checkStatus) {
                $doctor = DoctorBvth::find($doctor);

                return response()->json('Bác sĩ "'.$doctor->name.'" đã có lịch khám vào lúc "'.$appointmentDate.'". Bạn vui lòng chọn khung giờ khác ! Xin cảm ơn !');
            }
        }
        $checkStatus = MedicalAppointment::where('status', 0)
                                        ->where('phone', $phone)
                                        ->where('name', $name)
                                        ->where('appointment_date', $appointmentDate)
                                        ->first();
        if ($checkStatus) {
            return response()->json('Bạn đã có lịch khám vào lúc "'.$appointmentDate.'". Vui lòng chọn khung giờ khác ! Xin cảm ơn !');
        }

        $sort = MedicalAppointment::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        $medicalAppointment = new MedicalAppointment();
        $medicalAppointment->name = $name;
        $medicalAppointment->email = $email;
        $medicalAppointment->describe_symptoms = $describe_symptoms;
        $medicalAppointment->phone = $phone;
        $medicalAppointment->birth = $birth;
        $medicalAppointment->gender = $gender;
        $medicalAppointment->doctor = $doctor;
        $medicalAppointment->department = $department;
        $medicalAppointment->appointment_date = $appointmentDate;
        $medicalAppointment->status = 0;
        $medicalAppointment->sort = $sort;
        $medicalAppointment->save();

        $template = EmailTemplate::find(2);

        if ($template) {
            $content = $template->content;

            // thong tin benh nha
            $patient_information = '<div class="thong-tin-benh-nhan">'.'<p>'.'Họ tên: '.$name.'</p>';
            $patient_information = $patient_information.'<p>'.'Ngày sinh: '.$birth.'</p>';
            $patient_information = $patient_information.'<p>'.'Giới tính: '.$gender.'</p>';
            $patient_information = $patient_information.'<p>'.'Điện thoại: '.$phone.'</p>';
            $patient_information = $patient_information.'<p>'.'Email: '.$email.'</p>';
    
            $department = Department::find($department);
            $doctor = DoctorBvth::find($doctor);
    
            // thong tin dat hen
            $appointment_information = '<div class="thong-tin-dat-hen">'.'<p>'.'Họ tên: '.$name.'</p>';
            $appointment_information = $appointment_information.'<p>'.'Chuyên khoa: '.$department->name.'</p>';
            $appointment_information = $appointment_information.'<p>'.'Bác sĩ: '.$doctor->name.'</p>';
            $appointment_information = $appointment_information.'<p>'.'Mô tả triệu chứng: '.$describe_symptoms.'</p>';
            $appointment_information = $appointment_information.'<p>'.'Thời gian khám bệnh: '.$appointmentDate.'</p>';
    
            $content = str_replace('<div class="thong-tin-benh-nhan">', $patient_information, $content);
            $content = str_replace('<div class="thong-tin-dat-hen">', $appointment_information, $content);
    
            Mail::send([], [], function ($message) use ($template, $email, $content, $appointmentDate)
            {
                $message->to($email);
                $message->subject($template->subject. ' Ngày: '.$appointmentDate);
                $message->setBody($content,'text/html');
            });

            $emailBVTH = 'huyhuyad4496@gmail.com';
            Mail::send([], [], function ($message) use ($template, $emailBVTH, $content)
            {
                $message->to($emailBVTH);
                $message->subject($template->subject);
                $message->setBody($content,'text/html');
            });
        }
        return response()->json('Success');
        // return response()->json('Bạn đã đăng ký khám tại bệnh viện Tân Hưng thành công !');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComments(Request $request)
    {
        $name = $request->get('name');
        $content = $request->get('content');

        $checkStatus = WriteComment::where('status', 0)
                                        ->where('content', $content)
                                        ->where('name', $name)
                                        ->first();
        if ($checkStatus) {
            return response()->json('Bạn đã thêm bình luận này rồi.Vui lòng nhập bình luận khác ! Xin cảm ơn !');
        }

        $sort = WriteComment::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        $writeComment = new WriteComment();
        $writeComment->name = $name;
        $writeComment->content = $content;
        $writeComment->status = 0;
        $writeComment->sort = $sort;
        $writeComment->save();

        return response()->json('Bình luận của bạn đã được ghi nhận ! Xin cảm ơn !');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeConsultation(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $content = $request->get('content');
        $department = $request->get('department');

        $checkStatus = Consultation::where('status', 0)
                                        ->where('content', $content)
                                        ->where('name', $name)
                                        ->where('phone', $phone)
                                        ->first();
        if ($checkStatus) {
            return response()->json('Bạn đã đặt câu hỏi này rồi ! Vui lòng đặt câu hỏi khác ! Xin cảm ơn !');
        }

        $sort = Consultation::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        $consultation = new Consultation();
        $consultation->name = $name;
        $consultation->phone = $phone;
        $consultation->email = $email;
        $consultation->content = $content;
        $consultation->department = $department;
        $consultation->status = 0;
        $consultation->sort = $sort;
        $consultation->save();

        return response()->json('Câu hỏi của bạn đã được ghi nhận ! Xin cảm ơn !');
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