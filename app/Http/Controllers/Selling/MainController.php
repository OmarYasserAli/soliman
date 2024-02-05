<?php

namespace App\Http\Controllers\Selling;

use App\Models\Type;
use App\Models\Unit;
use App\Models\Leads;
use App\Models\SProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Services\SEO\SEOToolsFrontService;

class MainController extends Controller
{
    protected $set;
    protected $spg = 9;

    public function __construct()
    {
        $this->set = Cache::get('set');
    }

    public function home()
    {
        $projects = SProject::with(['city', 'area','units'])->orderby('original_id', 'desc')->where('active', true)->paginate($this->spg);
        $set = Cache::get('set');
        (new SEOToolsFrontService)->renderSeoPage('booking_system');

        return view('theme.selling.index', [
            'backstat' => true,
            'backbg' => @$this->set->selling_image,
            'page_img' => url('uploads') . '/' . @$this->set->selling_image,
            'backtitle' => @$set->selling_title,
            'sprojects' => $projects,
            'inside' => true,
            'showmore' => $projects->total() > $this->spg,
            'page_title2' => 'منصة الحجز',
            'hasSeotools' => true,
        ]);
    }
    public function city($slug)
    {
        $projects = SProject::with(['city', 'area'])->orderby('original_id', 'desc')->where('city_id',$slug)->where('active', true)->paginate($this->spg);
        $set = Cache::get('set');
        return view('theme.selling.index', [
            'backstat' => true,
            'backbg' => @$this->set->selling_image,
            'page_img' => url('uploads') . '/' . @$this->set->selling_image,
            'backtitle' => @$set->selling_title,
            'sprojects' => $projects,
            'inside' => true,
            'showmore' => $projects->total() > $this->spg,
            'page_title2' => 'منصة الحجز'
        ]);
    }
    public function area($slug)
    {
        $projects = SProject::with(['city', 'area'])->orderby('original_id', 'desc')->where('area_id',$slug)->where('active', true)->paginate($this->spg);
        $set = Cache::get('set');
        return view('theme.selling.index', [
            'backstat' => true,
            'backbg' => @$this->set->selling_image,
            'page_img' => url('uploads') . '/' . @$this->set->selling_image,
            'backtitle' => @$set->selling_title,
            'sprojects' => $projects,
            'inside' => true,
            'showmore' => $projects->total() > $this->spg,
            'page_title2' => 'منصة الحجز'
        ]);
    }

    public function projectsLoad(Request $request)
    {
        $projects = SProject::with(['city', 'area'])->orderby('original_id', 'desc')->where('active', true)->paginate($this->spg);
        $sm = $projects->hasMorePages() ? true : false;
        $list = '';
        foreach ($projects as $project) {
            $list .= view('theme.selling.box.project_item', ['sproject' => $project])->render();
        }
        return response()->json([
            'status' => true,
            'showmore' => $sm,
            'page' => $projects->currentPage() + 1,
            'list' => $list,
        ]);
    }

    public function projectLoad(Request $request)
    {
        if ($request->type == 'unit') {
            return $this->projectUnit($request);
        } else {
            return $this->projectType($request);
        }
    }

    public function projectUnit($request)
    {
        $unit = Unit::with(['type', 'floor'])->find((int)$request->id);
        if (empty($unit)) {
            return response()->json([
                'status' => false,
            ]);
        }
        $content = view('theme.selling.popup.project_info', ['unit' => $unit])->render();
        return response()->json([
            'status' => true,
            'content' => $content
        ]);
    }

    public function projectType($request)
    {
        $type = Type::with(['units', 'project'])->where('project_id', (int)$request->id)->find((int)$request->typeid);
        if (empty($type)) {
            return response()->json([
                'status' => false,
            ]);
        }

        $content = view('theme.selling.popup.building_info', ['type' => $type])->render();
        return response()->json([
            'status' => true,
            'content' => $content
        ]);
    }

    public function project($slug)
    {
        $project = SProject::with(['city', 'area'])->where('slug', $slug)->firstorFail();


        $types = Type::where('project_id', $project->id)->get();
        $units = Unit::with(['floor', 'type'])->where('project_id', $project->id)->orderBy('name', 'asc')->get();
        /* if($units->isEmpty()){
            abort(404);
        } */
        $status = [];
        $floors = [];
        $rooms = [];
        $lang = lng();
        foreach ($units as $unit) {
            // dd($unit->price);
            $unit->price_class = (float)$unit->price < 1000000 ? 'price_min' : 'price_max';
            //Status
            $status[$unit->status] = [
                'ar' => statusar($unit->status),
                'en' => status($unit->status),
                'value' => '.status-' . $unit->status
            ];
            //Floors
            if (!empty($unit->floor)) {
                $floors[$unit->floor_id] = [
                    'en' => $unit->floor->name->en,
                    'ar' => $unit->floor->name->ar,
                    'value' => '.floors-' . $unit->floor_id
                ];
            }
            //Rooms
            $rooms[$unit->rooms] = [
                'ar' => $unit->rooms . ' غرف',
                'en' => $unit->rooms . ' Room',
                'value' => '.rooms-' . $unit->rooms,
            ];

        }
        ksort($floors);
        ksort($rooms);
        return view('theme.selling.project', [
            'backstat' => true,
            'backbg' => 'sprojects/' . $project->cover,
            'page_img' => url('uploads/sprojects/' . $project->cover),
            'inside' => true,
            'sproject' => $project,
            'types' => $types,
            'units' => $units,
            'filters' => [
                'status' => $status,
                'floors' => $floors,
                'rooms' => $rooms,
            ],
            'selling' => 'selling',
            'page_title2' => $project->name->en
        ]);
    }

    public function unitRequest(Request $request)
    {

        // try{
        $result = submit_lead($request);
        $result_j = json_decode($result);
        $lead = new Leads;
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->title = $request->title;
        $lead->success = !isset($result_j->error);
        $lead->resp = $result;
        $lead->save();

        $msg = msg_handle2($request->ulang, $request->project_type, $request->project_name . '(' . $request->project_id . ')', $request->type, $request->unit);

        $number = $request->phone;
//            $s = curl_post("https://api.smsgo.ws/api.php?send_sms&username=966555765674&password=A@b321456&&numbers={$number}&sender=AlsolimanCo&message=".urlencode($msg));
        $data1 =[
                "text" => $msg,
                "numbers" =>  $number ,
                "number_iso" => "SA",
                "sender" => "AlsolimanCo"
            ] ;

        $s = curl_post2("https://api-sms.4jawaly.com/api/v1/account/area/sms/send",$data1);
        /****/
        $t_title = 'مهتم بالشراء في بلو دار  ';
        send_crm([
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "msg" =>  $request->title,
           ]);
        // Set up the parameters for the API call
//         $queryUrl = 'https://alsoliman.bitrix24.com/rest/119161/qrrw1df122f2049p/crm.lead.add.json';
//         $queryData = http_build_query(array(
//             'fields' => array(
//                 "TITLE" => $request->title,
//                 "NAME" => $request->name,
//                 "EMAIL" => $request->email,
//                 "PHONE" => $request->phone
//             ),
//             'params' => array("REGISTER_SONET_EVENT" => "Y")
//         ));
//         $queryData = http_build_query(array(
//             'fields' => array(
//                 "TITLE" => $request->title,
//                 "NAME" => $request->name,
//                 "PHONE" => array(array("VALUE" => $request->phone, "VALUE_TYPE" => "Home"))
//             ),
//             'params' => array("REGISTER_SONET_EVENT" => "Y")
//         ));

// // Execute the API call
//         $curl = curl_init();
//         curl_setopt_array($curl, array(
//             CURLOPT_SSL_VERIFYPEER => 0,
//             CURLOPT_POST => 1,
//             CURLOPT_HEADER => 0,
//             CURLOPT_RETURNTRANSFER => 1,
//             CURLOPT_URL => $queryUrl,
//             CURLOPT_POSTFIELDS => $queryData,
//         ));

//         $result = curl_exec($curl);
//         curl_close($curl);

// Decode the response and get the lead ID
        // $result = json_decode($result, 1);
        //dd($result);
        // $leadId = $result['result'];
        /*****/

        return response()->json([
            'status' => true,
            // 'sms' => $s,
//                'leadId' => $leadId,
            'content' => view('theme.selling.popup.success')->render()
        ]);
        // }catch(Exception$e){
        //     return response()->json([
        //         'status' => false,
        //     ]);
        // }
    }



}
