<?php

namespace App\Http\Controllers\Selling;

use App\Models\Set;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function home()
    {
        return view('selling.home');
    }

    public function setting()
    {
        return view('selling.setting');
    }

    public function settingPost(Request $request)
    {
        $keys = ['selling_image', 'sms_msg', 'sms_msg2', 'selling_title'];
        foreach($keys as $k){
            if($request->$k){
                if($k == 'selling_image'){
                    $val = upload($request, 'selling_image');
                }else if(in_array($k, ['selling_title', 'sms_msg', 'sms_msg2'])){
                    $val = json_encode($request->$k);
                }else{
                    $val = $request->$k;
                }
                $key = Set::where('key', $k)->first();
                if(!empty($key)){
                    $key->value = $val;
                    $key->update();
                }else{
                    Set::insert([
                        'key' => $k,
                        'value' => $val
                    ]);
                }
                Cache::forget('set');
            }
        }
        session()->flash('success', 'Updated Successfully.');
        return back();
    }
}
