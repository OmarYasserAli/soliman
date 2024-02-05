<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function ver($key){
    // $lang = (string)session()->get('locale') == 'ar' ? 'ar' : 'en';
    $lang = LaravelLocalization::getCurrentLocale();
    return $key[$lang];
}

function enc($key)
{
    return json_encode($key);
}

function clean($data)
{
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);
    return $data;
}

function sluger($text, $seprator = '-'){
    $text = str_ireplace(['&', '?', '"', "'", '#','@','%','*','(',')', '|', ' '], '-', strtolower(trim($text)));
    return $text;
}

function upload($request, $key, $folder='uploads', $model=null){
    if($request->$key){
        $imageName = microtime().'.'.$request->$key->extension();
        $request->$key->move(public_path($folder), $imageName);
        if($model){
            @unlink(public_path($folder.'/'.$model->$key));
        }
        return $imageName;
    }
    return null;
}


function upload2($file, $folder='uploads'){
    if($file){
        $imageName = microtime().'.'.$file->extension();
        $file->move(public_path($folder), $imageName);
        return $imageName;
    }
    return null;
}

function upload_gallery($glist, $folder='uploads'){
    $list = [];
    if(!empty($glist1 = (array)@$glist['new'])){
        foreach($glist1 as $gallery){
            $item = upload2($gallery, $folder);
            $list[] = $item;
        }
    }
    //dd((array)@$glist['old']);
    return array_unique(array_merge($list, (array)@$glist['old']), SORT_REGULAR);
}

function render($text=null){
    return nl2br($text);
}

function status($id=-1, $lang='en'){
    $list =[
        0 => $lang=='en' ? 'Sale' : 'للبيع',
        1 => $lang=='en' ? 'Booked' : 'محجوز',
        2 => $lang=='en' ? 'Sold' : 'مباعة',
        3 => $lang=='en' ? 'Soon' : 'قريباً',
    ];
    return @$list[$id];
}

function statusar($id=-1){
    $list =[
        0 => 'للبيع',
        1 => 'محجوز',
        2 => 'مباعة',
        3 => 'قريباً',
    ];
    return @$list[$id];
}

function img_err(){
    return 'onerror=this.src="'.url('theme/images/placeholder.jpg').'"';
}

function curl_post($url){
    // echo $url;die;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($curl);
    curl_close($curl);
    // $resp = json_decode($resp);
    return $resp;
}
function curl_post2($url,$data1){

    $curl = curl_init();
    $app_id = "gu8qKthmbgkINtuv6CAvqHnWvtHhio1miYExtFBC";
    $app_sec = "9WGvf84WG0qzXEuUVlZljWDxtJsWwfg14DZOUlZiqTwPzzbuB0cQltidGdECUVl6y8hA41Zc53HOmfexnM9WloP4hRkOw2imIFur";
    $app_hash  = base64_encode("$app_id:$app_sec");
    $messages = [];
    $messages["messages"] = [];
    $messages["messages"][0]["text"] = $data1['text'];
    $messages["messages"][0]["numbers"][] = $data1['numbers'];
    $messages["messages"][0]["sender"] = $data1['sender'];
    $messages["messages"][0]["number_iso"] = $data1['number_iso'];

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api-sms.4jawaly.com/api/v1/account/area/sms/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>json_encode($messages),
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Basic '.$app_hash
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);


    return $response;
}

function checkemail($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

function submit_lead($request){
    $title = $request->title;
    $name = $request->name;
    $email = checkemail($request->email) ? $request->email : 'invalid@alsoliman.com';
    $phone = $request->phone;
    $result = curl_post("https://alsoliman.bitrix24.com/rest/118643/sagqu012vkxbohjw/crm.lead.add.json?FIELDS[NAME]={$name}&FIELDS[EMAIL][0][VALUE]={$email}&FIELDS[PHONE][0][VALUE]={$phone}&FIELDS[TITLE]=".urlencode($title));
    //dd($result);
    return $result;
}

function msg_handle($lang, $type, $project, $model, $unit){
    $set = cache()->get('set');
    $text = $type == 0 ? @$set->sms_msg : @$set->sms_msg2;
    $text = $lang == 'en' ? @$text->en : @$text->ar;
    $text = str_ireplace('{PROJECT}', $project, $text);
    $text = str_ireplace('{MODEL}', $model, $text);
    $text = str_ireplace('{UNIT}', $unit, $text);
    return $text;
}
function msg_handle2($lang, $type, $project, $model, $unit){
    $set = cache()->get('set');
    $text =   @$set->sms_msg2;
    $text = $lang == 'en' ? @$text->en : @$text->ar;
    $text = str_ireplace('{PROJECT}', $project, $text);
    $text = str_ireplace('{MODEL}', $model, $text);
    $text = str_ireplace('{UNIT}', $unit, $text);
    return $text;
}

function ptitle($item,$lang='en'){
    /*if($item->project->type == 0){
        if($lang == 'en'){
            return "Interested of Unit {$item->name->en}, Type ".@$item->type->name->en.", Project No ".$item->project->original_id;
        }
        return "مهتم بشراء الوحدة رقم {$item->name->ar}} ، نموذج {@$item->type->name->en} بمشروع رقم {$item->project->original_id}";
    }*/
    if($lang == 'en'){
        return "Interested of Unit {$item->name}, Project No ".$item->project->original_id;
    }
    return "مهتم بشراء الوحدة رقم {$item->name} بمشروع رقم {$item->project->original_id}";
}


function  curl_get( $url){

    $command = "curl $url";
    $response = shell_exec($command);
    return $response;
}

// function send_crm($data){
//     $name = $data['name'];
//     $phone = $data['phone'];
//     $email = $data['email'];
//     $msg = $data['msg'];

//     $link = "https://alsoliman.bitrix24.com/rest/78/q7p4czkokirvykqh/crm.lead.add.json" .
//     "?FIELDS[NAME]=" . urlencode($name) .
//     "&FIELDS[PHONE][0][VALUE]=" . urlencode($phone) .
//     "&FIELDS[EMAIL][0][VALUE]=" . urlencode($email) .
//     "&FIELDS[PHONE][0][TYPE]=WORK&FIELDS[EMAIL][0][TYPE]=WORK" .
//     "&FIELDS[COMMENT]=" . urlencode($msg);

//     curl_get($link);
// }


    function send_crm($data){
        $name = $data['name'] ?? "";
        $phone = $data['phone'] ?? "";
        $email = $data['email'] ?? "";
        $msg = $data['msg'];

        // $link = "https://alsoliman.bitrix24.com/rest/78/q7p4czkokirvykqh/crm.lead.add.json" .
        // //     "?FIELDS[NAME]=" . urlencode($name) .
        //     "&FIELDS[PHONE][0][VALUE]=" . urlencode($phone) .
        //     "&FIELDS[EMAIL][0][VALUE]=" . urlencode($email) .
        //     "&FIELDS[PHONE][0][TYPE]=WORK&FIELDS[EMAIL][0][TYPE]=WORK" .
        //     "&FIELDS[COMMENT]=" . urlencode($msg);
            // dd(
            //     $link
            // );
        $url = 'https://alsoliman.bitrix24.com/rest/78/q7p4czkokirvykqh/crm.lead.add.json';
        $data = [
            'FIELDS' => [
                'NAME' => $name,
                'PHONE' => [['VALUE' => $phone, 'TYPE' => 'WORK']],
                'EMAIL' => [['VALUE' => $email, 'TYPE' => 'WORK']],
                'COMMENTS' => $msg,
                'SOURCE' => "form",
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $response = curl_exec($ch);
        curl_close($ch);
    }
function lng(){
    // return (string)session()->get('locale') == 'ar' ? 'en' : 'ar';
    return LaravelLocalization::getCurrentLocale();
}
