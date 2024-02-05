<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\File;
use App\Models\Logo;
use App\Models\News;
use App\Models\Page;
use App\Models\Event;
use App\Models\Favor;
use App\Models\Iblue;
use App\Models\Value;
use App\Models\Branch;
use App\Models\Igroup;
use App\Models\Molhem;
use App\Models\Slider;
use App\Models\Campain;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Mail\FavorEmail;
use App\Models\Investor;
use App\Mail\ContactMail;
use App\Models\Form;
use App\Models\FormData;
use App\Models\Management;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Services\SocialShareService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Services\SlugRedirectorService;
use Illuminate\Support\Facades\Validator;
use App\Services\SEO\SEOToolsFrontService;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    protected $set;
    public function __construct()
    {
        $this->set = Cache::get('set');
    }

    public function changeLocale($locale = null)
    {
        // $lang = (string)session()->get('locale') == 'ar' ? 'en' : 'ar';
        $lang = LaravelLocalization::getCurrentLocale();
        session()->put('locale', $locale ?? $lang);
        return back();
    }

    public function getCampain($slug)
    {
        if (in_array($slug, ['sakenah-residence', 'alsoliman-contact', 'alsoliman-contact2', 'alsoliman-contact3'])) {
            if ($slug == 'sakenah-residence') {
                return redirect(route('sresidence'), 301);
            } elseif ($slug == 'alsoliman-contact') {
                return redirect(route('campain-contact'), 301);
            } elseif ($slug == 'alsoliman-contact2') {
                return redirect(route('campain-contact2'), 301);
            } elseif ($slug == 'alsoliman-contact') {
                return redirect(route('campain-contact3'), 301);
            }
        }
        $campain = Campain::where('slug', $slug)->orWhere('slug_ar', clean($slug))->where('active', true)->firstOrFail();
        return view('theme.campain', ['campain' => $campain]);
    }

    public function getForm($slug)
    {
        if (in_array($slug, ['sakenah-residence', 'alsoliman-contact', 'alsoliman-contact2', 'alsoliman-contact3'])) {
            if ($slug == 'sakenah-residence') {
                return redirect(route('sresidence'), 301);
            } elseif ($slug == 'alsoliman-contact') {
                return redirect(route('campain-contact'), 301);
            } elseif ($slug == 'alsoliman-contact2') {
                return redirect(route('campain-contact2'), 301);
            } elseif ($slug == 'alsoliman-contact') {
                return redirect(route('campain-contact3'), 301);
            }
        }
        $form = Form::where('slug', $slug)->orWhere('slug_ar', clean($slug))->where('active', true)->firstOrFail();
        return view('theme.form', ['form' => $form]);
    }

    public function saveFormData(Request $request)
    {
       $form = Form::findOrFail($request->form_id);
       FormData::create([
        "name" => $request->name,
        "phone" => $request->phone,
        "email" => $request->email,
        "form_id" => $request->form_id,
        "product_id" => $form->product_id,
       ]);
       $projectName = ($form->product?->name?->ar) ?? "بلو دار";

       $t_title = 'مهتم بالشراء في '  .$projectName;

       send_crm([
        "name" => $request->name,
        "phone" => $request->phone,
        "email" => $request->email,
        "msg" =>  $t_title,
       ]);
    //    $queryUrl = 'https://alsoliman.bitrix24.com/rest/119161/qrrw1df122f2049p/crm.lead.add.json';
    //    $queryData = http_build_query(array(
    //        'fields' => array(
    //            "TITLE" => $t_title,
    //            "NAME" => $request->name,
    //            "EMAIL" => $request->email,
    //            "PHONE" => $request->phone
    //        ),
    //        'params' => array("REGISTER_SONET_EVENT" => "Y")
    //    ));
    //    $queryData = http_build_query(array(
    //        'fields' => array(
    //            "TITLE" => $t_title,
    //            "NAME" => $request->name,
    //            "PHONE" => array(array("VALUE" => $request->phone, "VALUE_TYPE" => "Home"))
    //        ),
    //        'params' => array("REGISTER_SONET_EVENT" => "Y")
    //    ));

    //    // Execute the API call
    //    $curl = curl_init();
    //    curl_setopt_array($curl, array(
    //        CURLOPT_SSL_VERIFYPEER => 0,
    //        CURLOPT_POST => 1,
    //        CURLOPT_HEADER => 0,
    //        CURLOPT_RETURNTRANSFER => 1,
    //        CURLOPT_URL => $queryUrl,
    //        CURLOPT_POSTFIELDS => $queryData,
    //    ));

    //    $result = curl_exec($curl);
    //    curl_close($curl);

       $msg = 'تم تسجيل اهتمامك في مشروع '.$projectName.'، سيتم التواصل معك من موظفي المبيعات باقرب وقت ممكن.';
       $msg = 'شكرا لك تم تسجيل اهتمامك، سيتم التواصل معك بأسرع وقت ممكن';
       //    dd($msg);
       $number = $request->phone;
       $data1 = [
           "text" => $msg,
           "numbers" => $number ,
           "number_iso" => "SA",
           "sender" => "AlsolimanCo"
       ];

       $s = curl_post2("https://api-sms.4jawaly.com/api/v1/account/area/sms/send", $data1);
       return response()->json([], Response::HTTP_OK);
    }


    public function home()
    {
        $services = Service::select('title')->get();
        $logos = Logo::all();
        $sliders = Slider::all();

        (new SEOToolsFrontService)->renderSeoPage('home');

        return view('theme.index', [
            'backstat' => true,
            'backbg' => @$this->set->homebg,
            'page_img' => url('uploads') . '/' . @$this->set->homebg,
            'backtitle' => @$this->set->mtitle,
            'logos' => $logos,
            'services' => $services,
            'sliders' => $sliders,
            'page_title2' => 'الرئيسية',
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function about()
    {
        $values = Value::all();
        $managements = Management::all();

        (new SEOToolsFrontService)->renderSeoPage('about_us');

        return view('theme.about', [
            'backstat' => true,
            'backbg' => @$this->set->about_image,
            'page_img' => url('uploads') . '/' . @$this->set->about_image,
            'backtitle' => @$this->set->about_title,
            'values' => $values,
            'managements' => $managements,
            'inside' => true,
            'page_title2' => 'من نحن',
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function contact()
    {
        (new SEOToolsFrontService)->renderSeoPage('contact');

        return view('theme.contact', [
            'backstat' => true,
            'backbg' => @$this->set->contact_image,
            'page_img' => url('uploads') . '/' . @$this->set->contact_image,
            'backtitle' => @$this->set->contact_title,
            'inside' => true,
            'page_title2' => 'اتصل  بنا',
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function contactPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ], [], [
            'name' => __('site.contact.name'),
            'email' => __('site.address.email'),
            'message' => __('site.contact.message'),
        ]);
        if ($validator->fails()) {
            return redirect('contact#contact')->withErrors($validator)->withInput();
        }
        try {
            $set = Cache::get('set');
            Mail::to(@$set->email)->send(new ContactMail($request->all()));
            session()->flash('success', __('site.success'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => [__('site.fail')],
            ]);
        }
        return back();
    }

    public function events()
    {
        $events = Event::orderBy('dt', 'desc')->paginate(10);

        (new SEOToolsFrontService)->renderSeoPage('events');

        return view('theme.events', [
            'backstat' => true,
            'backbg' => @$this->set->media_image,
            'page_img' => url('uploads') . '/' . @$this->set->media_image,
            'backtitle' => @$this->set->media_title,
            'events' => $events,
            'inside' => true,
            'page_title2' => 'الفعاليات',
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function event($slug)
    {


        /**
         * First of all check resource is exists
         */
        $event = Event::where('slug', clean($slug))->orWhere('slug_ar', clean($slug))->first();
        abort_if(empty($event), 404);

        $returnedValue = (new SlugRedirectorService($event, $slug, 'event'))->rectify();
        if ($returnedValue instanceof \Illuminate\Http\RedirectResponse) return $returnedValue;

        (new SEOToolsFrontService($event))->render();

        return view('theme.event', [
            'event' => $event,
            'inside' => true,
            'eventc' => true,
            'page_img' => (!empty($img = @$event->image)) ? url('uploads/events') . '/' . $img : '',
            'page_title' => @$event->title,
            'hasSeotools' => $event->seotool,
        ]);
    }

    public function files()
    {
        $files = File::all();

        (new SEOToolsFrontService)->renderSeoPage('files');

        return view('theme.files', [
            'backstat' => true,
            'backbg' => @$this->set->media_image,
            'page_img' => url('uploads') . '/' . @$this->set->media_image,
            'backtitle' => @$this->set->media_title,
            'files' => $files,
            'inside' => true,
            'page_title2' => 'الهوية البصرية',
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function investors()
    {
        $groups = Igroup::all();
        $ilist = Investor::all();
        $ilist = $ilist->where('parent', 0)->map(function ($item) use ($ilist) {
            $item = $item;
            $item->childs = $ilist->where('parent', $item->id);
            return $item;
        });
        $groups = $groups->map(function ($group) use ($ilist) {
            $group = $group;
            $group->childs = $ilist->where('group', $group->id);
            return $group;
        });

        (new SEOToolsFrontService)->renderSeoPage('investors_relation');

        return view('theme.investor', [
            'groups' => $groups,
            'backstat' => true,
            'backbg' => @$this->set->investor_image,
            'page_img' => url('uploads') . '/' . @$this->set->investor_image,
            'backtitle' => @$this->set->investor_title,
            'inside' => true,
            'page_title2' => 'علاقات المستثمرين',
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function news()
    {
        $news = News::orderBy('dt', 'desc')->paginate(10);

        (new SEOToolsFrontService)->renderSeoPage('news');

        return view('theme.news', [
            'backstat' => true,
            'backbg' => @$this->set->media_image,
            'backtitle' => @$this->set->media_title,
            'news' => $news,
            'inside' => true,
            'page_title2' => 'الأخبار',
            'page_img' => url('uploads') . '/' . @$this->set->media_image,
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function newsBySlug($slug)
    {
        $post = News::where('slug', clean($slug))->orWhere('slug_ar', clean($slug))->first();
        abort_if(empty($post), 404);

        // $returnedValue = (new SlugRedirectorService($post, $slug, 'newsBySlug'))->rectify();
        // if($returnedValue instanceof \Illuminate\Http\RedirectResponse ) return $returnedValue;

        $news = News::take(3)->inRandomOrder()->get();

        (new SEOToolsFrontService($post))->render();

        return view('theme.post', [
            'backstat' => true,
            'backbg' => @$this->set->media_image,
            'backtitle' => @$this->set->media_title,
            'page_img' => (!empty($img = @$post->image)) ? url('uploads/news') . '/' . $img : '',
            'page_title' => @$post->title,
            'post' => $post,
            'news' => $news,
            'inside' => true,
            'nohead' => true,
            'eventc' => true,
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function pageBySlug($slug)
    {
        $page = Page::where('slug', clean($slug))->orWhere('slug_ar', clean($slug))->first();
        abort_if(empty($page), 404);

        $returnedValue = (new SlugRedirectorService($page, $slug, 'pageBySlug'))->rectify();
        if ($returnedValue instanceof \Illuminate\Http\RedirectResponse) return $returnedValue;

        return view('theme.page', [
            'backstat' => true,
            'backbg' => @$this->set->media_image,
            'backtitle' => @$this->set->media_title,
            'page_img' => url('uploads') . '/' . @$this->set->media_image,
            'page_title' => @$page->title,
            'page' => $page,
        ]);
    }

    public function product($slug)
    {
        /**
         * First of all check resource is exists
         */
        $product = Product::where('slug', clean($slug))->orWhere('slug_ar', clean($slug))->first();
        abort_if(empty($product), 404);

        $returnedValue = (new SlugRedirectorService($product, $slug, 'product'))->rectify();
        if ($returnedValue instanceof \Illuminate\Http\RedirectResponse) return $returnedValue;

        $rproducts = Product::select('id', 'title', 'slug', 'breif', 'image', 'by_ocoda_dev')->where('id', '!=', $product->id)->inRandomOrder()->take(4)->get();
        // $lang = (string)session()->get('locale') == 'en' ? 'en' : 'ar';
        $lang = LaravelLocalization::getCurrentLocale();

        if ($product->by_ocoda_dev == true) {

            $page_img = url($product->getImagePath('image', $lang)) instanceof  \Illuminate\Routing\UrlGenerator ? url($product->getImagePath('image', $lang))->full() : url($product->getImagePath('image', $lang));
            $backbg = $product->getImagePath('image', $lang);
        } else {
            if (!empty(@$img = $product->image)) {
                $page_img = url('uploads/products') . '/' . $img;
                $backbg = 'products/' . $product->image;
            } else {
                $page_img = '';
                $backbg = '';
            }
        }

        (new SEOToolsFrontService($product))->render();

        $shareButtons = (new SocialShareService($product))->render($product->title->$lang);

        return view('theme.product', [
            'backstat' => true,
            'backbg' => $backbg,
            'backtitle' => @$product->title,
            'page_img' => $page_img,
            'page_title' => @$product->title,
            'product' => $product,
            'rproducts' => $rproducts,
            'inside' => true,
            'hasSeotools' => $product->seotool,
            'shareButtons' => $shareButtons,
            'hideTitle' => true,
        ]);
    }

    public function project($slug)
    {
        $project = Project::where('slug', clean($slug))->orWhere('slug_ar', clean($slug))->first();
        abort_if(empty($project), 404);

        $returnedValue = (new SlugRedirectorService($project, $slug, 'project'))->rectify();
        if ($returnedValue instanceof \Illuminate\Http\RedirectResponse) return $returnedValue;

        $rprojects = Project::select('id', 'title', 'slug', 'breif', 'image', 'by_ocoda_dev')->where('id', '!=', $project->id)->inRandomOrder()->take(4)->get();
        // $lang = (string)session()->get('locale') == 'en' ? 'en' : 'ar';
        $lang = LaravelLocalization::getCurrentLocale();

        if ($project->by_ocoda_dev == true) {

            $page_img = url($project->getImagePath('image', $lang)) instanceof  \Illuminate\Routing\UrlGenerator ? url($project->getImagePath('image', $lang))->full() : url($project->getImagePath('image', $lang));
            $backbg = $project->getImagePath('image', $lang);
        } else {
            if (!empty(@$img = $project->image)) {
                $page_img = url('uploads/products') . '/' . $img;
                $backbg = 'products/' . $project->image;
            } else {
                $page_img = '';
                $backbg = '';
            }
        }

        (new SEOToolsFrontService($project))->render();

        $shareButtons = (new SocialShareService($project))->render($project->title->$lang);

        return view('theme.project', [
            'backstat' => true,
            'backbg' => $backbg,
            'backtitle' => @$project->title,
            'page_img' => $page_img,
            'page_title' => @$project->title,
            'project' => $project,
            'rprojects' => $rprojects,
            'inside' => true,
            'hasSeotools' => $project->seotool,
            'shareButtons' => $shareButtons,
            'hideTitle' => true,
        ]);
    }

    public function projectBlueDar()
    {

        if (LaravelLocalization::getCurrentLocale() == 'ar') return redirect()->route('project.bluedar.ar');

        (new SEOToolsFrontService)->renderSeoPage('bluedar');

        return view('theme.bluedar-project', [
            'backbg2' => url('/theme/images/blue/bg5.jpg'),
            'backbgpos' => '73% center',
            'backtitle' => 'BlueDar',
            'page_title' => 'BlueDar',
            'backstat' => true,
            'inside' => true,
            'blue' => 'blue',
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function projectBlueDarAr()
    {
        if (LaravelLocalization::getCurrentLocale() == 'en') return redirect()->route('project.bluedar');

        (new SEOToolsFrontService)->renderSeoPage('bluedar');

        return view('theme.bluedar-project', [
            'backbg2' => url('/theme/images/blue/bg5.jpg'),
            'backbgpos' => '73% center',
            'backtitle' => 'BlueDar',
            'page_title' => 'BlueDar',
            'backstat' => true,
            'inside' => true,
            'blue' => 'blue',
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function blueDarPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required',
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'msg' => __('site.newsletter.fail')
            ];
        }

        $new = new Iblue;
        $new->name = $request->name;
        $new->phone = $request->phone;
        $new->email = $request->email;
        $new->save();


        /****/

        // Set up the parameters for the API call
        $t_title = 'مهتم بالشراء في بلو دار  ';
        send_crm([
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "msg" =>  $t_title,
           ]);
        // $queryUrl = 'https://alsoliman.bitrix24.com/rest/119161/qrrw1df122f2049p/crm.lead.add.json';
        // $queryData = http_build_query(array(
        //     'fields' => array(
        //         "TITLE" => $t_title,
        //         "NAME" => $request->name,
        //         "EMAIL" => $request->email,
        //         "PHONE" => $request->phone
        //     ),
        //     'params' => array("REGISTER_SONET_EVENT" => "Y")
        // ));
        // $queryData = http_build_query(array(
        //     'fields' => array(
        //         "TITLE" => $t_title,
        //         "NAME" => $request->name,
        //         "PHONE" => array(array("VALUE" => $request->phone, "VALUE_TYPE" => "Home"))
        //     ),
        //     'params' => array("REGISTER_SONET_EVENT" => "Y")
        // ));

        // // Execute the API call
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_SSL_VERIFYPEER => 0,
        //     CURLOPT_POST => 1,
        //     CURLOPT_HEADER => 0,
        //     CURLOPT_RETURNTRANSFER => 1,
        //     CURLOPT_URL => $queryUrl,
        //     CURLOPT_POSTFIELDS => $queryData,
        // ));

        // $result = curl_exec($curl);
        // curl_close($curl);


        $msg = 'تم تسجيل اهتمامك في مشروع بلودار ، سيتم التواصل معك من موظفي المبيعات باقرب وقت ممكن.';
        $number = $request->phone;
        $data1 = [
            "text" => $msg,
            "numbers" => $number,
            "number_iso" => "SA",
            "sender" => "AlsolimanCo"
        ];

        $s = curl_post2("https://api-sms.4jawaly.com/api/v1/account/area/sms/send", $data1);

        // Decode the response and get the lead ID
        //        $result = json_decode($s, 1);
        //        //dd($result);
        //        $leadId = $result['result'];
        /*****/


        return [
            'status' => 'success',
            'content' => view('theme.selling.popup.success')->render(),
            'msg' => __('site.newsletter.success')
        ];
    }

    public function molhem()
    {
        $i = 0;
        $posts = Molhem::orderBy('id', 'desc')->paginate(10);

        (new SEOToolsFrontService)->renderSeoPage('molhem');

        return view('theme.molhem', [
            'posts' => $posts,
            'inside' => true,
            'eventc' => true,
            'page_title2' => 'ملهم',
            'hasSeotools' => true,
            'hideTitle' => true,
        ]);
    }

    public function smolhem($slug)
    {
        $post = Molhem::where('slug', clean($slug))->orWhere('slug_ar', clean($slug))->first();

        abort_if(empty($post), 404);

        $returnedValue = (new SlugRedirectorService($post, $slug, 'smolhem'))->rectify();
        if ($returnedValue instanceof \Illuminate\Http\RedirectResponse) return $returnedValue;

        // $lang = (string)session()->get('locale') == 'en' ? 'en' : 'ar';
        $lang = LaravelLocalization::getCurrentLocale();

        if ($post->by_ocoda_dev == true) {

            $page_img = url($post->getImagePath('image', $lang)) instanceof  \Illuminate\Routing\UrlGenerator ? url($post->getImagePath('image', $lang))->full() : url($post->getImagePath('image', $lang));
            $backbg = $post->getImagePath('image', $lang);
        } else {
            if (!empty(@$img = $post->image)) {
                $page_img = url('uploads/molhem') . '/' . $img;
                $backbg = 'molhem/' . $post->image;
            } else {
                $page_img = '';
                $backbg = '';
            }
        }

        (new SEOToolsFrontService($post))->render();

        $shareButtons = (new SocialShareService($post))->render();



        return view('theme.smolhem', [
            'backstat' => true,
            'molhem' => true,
            'backbg' => $backbg,
            'page_img' => $page_img,
            'page_title' => $post->title,
            'post' => $post,
            'inside' => true,
            'hasSeotools' => $post->seotool,
            'shareButtons' => $shareButtons,

        ]);
    }

    public function newsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ], [], [
            'email' => 'Email'
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'msg' => __('site.newsletter.fail')
            ];
        }
        $check = Newsletter::where('email', $request->email)->first();
        if (!empty($check)) {
            return [
                'status' => 'fail',
                'msg' => __('site.newsletter.unique')
            ];
        }
        $new = new Newsletter;
        $new->email = $request->email;
        $new->save();
        return [
            'status' => 'success',
            'msg' => __('site.newsletter.success')
        ];
    }

    public function registerProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ], [], [
            'name' => __('site.contact.name'),
            'phone' => __('site.contact.mobile'),
            'project' => __('site.contact.project'),
            'email' => __('site.address.email'),
            'message' => __('site.contact.message'),
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'fail',
                'msg' => __('site.newsletter.fail'),
                'errors' => $validator->errors()
            ];
        }
        try {
            $set = Cache::get('set');
            Mail::to(@$set->favor_email)->send(new FavorEmail($request->all()));
            return [
                'status' => 'success',
                'msg' => __('site.newsletter.success'),
            ];
        } catch (Exception $e) {
            return [
                'status' => 'fail',
                'error' => true,
                'msg' => __('site.newsletter.fail'),
            ];
        }
    }

    public function sakenahResidence()
    {
        return view('theme.sresidence');
    }

    public function alsolimanContact()
    {
        return view('theme.campain1');
    }

    public function alsolimanContact2()
    {
        return view('theme.campain2');
    }

    public function alsolimanContact3()
    {
        return view('theme.campain3');
    }
}
