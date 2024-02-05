<?php

namespace App\Http\Controllers\Admin;

use App\Models\Set;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Iblue;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }

    public function bluedarInterestList()
    {
        $results = Iblue::paginate(20);
        return view('admin.bluedar', [
            'results' => $results
        ]);
    }

    public function createSetting($key, $val)
    {
        $val = is_array($val) ? json_encode($val) : $val;
        Set::insert([
            'key' => $key,
            'value' => $val
        ]);
    }

    public function updateSetting($key, $val)
    {
        if ($key == '') {
        }
        Set::where('key', $key)->update([
            'value' => $val
        ]);
    }

    public function settings(Request $request)
    {
        $rkeys = [
            'name', 'tagline', 'desc', 'mtitle', 'about_title', 'amtitle', 'breif', 'vision', 'mission', 'contact_title',
            'phone', 'email', 'map', 'twitter', 'instagram', 'linkedin', 'youtube', 'whatsapp', 'investor_title', 'media_title', 'address_headquarters', 'address_dhahran', 'address_medina',
            'homebg', 'about_image', 'media_image', 'investor_image', 'contact_image', 'investor_image', 'media_image', 'profile',
            'privecy_page', 'terms_page',
            'home_phone', 'home_whatsapp', 'project_phone', 'project_whatsapp', 'product_phone', 'product_whatsapp', 'favor_email', 'head',
            'campain_whatsapp', 'campain_phone', 'campain_map', 'campain_info', 'campain_title',
            'bluedar_image', 'bluedar_title', 'bluedar_breif', 'bluedar_logo', 'bluedar_about_image', 'bluedar_gallery', 'bluedar_gallery_title',
            'bluedar_map_image', 'bluedar_map_title', 'bluedar_map_link', 'bluedar_interesting_image', 'bluedar_interesting_title', 'bluedar_gallery_image', 'footer_script', 'robots_file'
        ];

        $keys = Set::pluck('key')->toArray();

        foreach ($rkeys as $key) {
            if ($request->has($key)) {
                $val = $request->$key;

                if (in_array($key, ['homebg', 'about_image', 'media_image', 'investor_image', 'contact_image', 'investor_image', 'media_image', 'bluedar_image', 'bluedar_logo', 'bluedar_about_image', 'bluedar_map_image', 'bluedar_interesting_image', 'bluedar_gallery_image'])) {
                    $val = upload($request, $key);
                } elseif (in_array($key, ['profile'])) {

                    if ($request->profile) {
                        $nn = str_replace(' ', '-', $request->profile->getClientOriginalName());
                        $imageName = time() . $nn; //.'.'.$request->profile_file->extension()
                        $request->profile->move(public_path('uploads/site/'), $imageName);
                        $val =   asset('uploads/site/' . $imageName);
                    }
                } elseif (in_array($key, ['bluedar_gallery'])) {
                    $f_array = [];
                    if (@$request->bluedar_gallery['old']) {
                        foreach ($request->bluedar_gallery['old'] as $file_old) {
                            $f_array[] = $file_old;
                        }
                    }
                    if (@$request->bluedar_gallery['new']) {

                        foreach ($request->bluedar_gallery['new'] as $file_) {
                            $nn = str_replace(' ', '-', $file_->getClientOriginalName());
                            $imageName = time() . $nn;
                            $file_->move(public_path('uploads/site/'), $imageName);
                            $f_array[] = $imageName;
                        }
                    }
                    $val = json_encode($f_array);
                }
                //                elseif(in_array($key, ['bluedar_image'])){
                //
                //                    if($request->bluedar_image){
                //                        $nn = str_replace(' ', '-', $request->bluedar_image->getClientOriginalName());
                //                        $imageName = time().$nn ;
                //                        $request->bluedar_image->move(public_path('uploads/site/'), $imageName);
                //                        $val =   asset('uploads/site/'.$imageName);
                //                    }
                //
                //                }
                elseif (in_array($key, ['head', 'phone', 'email', 'twitter', 'instagram', 'linkedin', 'youtube', 'profile', 'map', 'whatsapp', 'home_phone', 'favor_email', 'home_whatsapp', 'project_phone', 'project_whatsapp', 'product_phone', 'product_whatsapp', 'campain_whatsapp', 'campain_phone', 'campain_map', 'campain_info', 'campain_title', 'footer_script'])) {
                    $val = $request->$key;
                } elseif (in_array($key, ['privecy_page', 'terms_page'])) {
                    $val = (int)$request->$key;
                } else {
                    $val = json_encode($request->$key);
                }
                if (in_array($key, $keys)) {
                    $this->updateSetting($key, $val);
                } else {
                    $this->createSetting($key, $val);
                }

                if($request->hasFile('robots_file') && $key == 'robots_file') {
                    $robotsFile = $request->file('robots_file');
                    $robotsFile->move(public_path(), $robotsFile->getClientOriginalName());
                }
            }
        }

        Cache::forget('set');
        session()->flash('success', 'Updated Successfully.');
        return back();
    }

    public function settingsFrom()
    {
        return view('admin.settings.general');
    }

    public function pagesFrom()
    {
        $pages = Page::select('id', 'title')->get();
        return view('admin.settings.pages', [
            'pages' => $pages
        ]);
    }

    public function contactFrom()
    {
        return view('admin.settings.contact');
    }

    public function aboutFrom()
    {
        return view('admin.settings.about');
    }

    public function investorFrom()
    {
        return view('admin.settings.investor', [
            'name' => 'investor'
        ]);
    }

    public function blueDarForm()
    {
        return view('admin.settings.bludarform', [
            'name' => 'bluedar'
        ]);
    }

    public function mediaFrom()
    {
        return view('admin.settings.media', [
            'name' => 'media'
        ]);
    }

    public function numbersFrom()
    {
        return view('admin.settings.numbers');
    }

    public function campainsFrom()
    {
        return view('admin.settings.campain');
    }
}
