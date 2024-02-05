<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormData;
use App\Models\Product;
use App\Services\SEO\SEOToolsService;
use App\Services\UniqueImages\ImageService;

class FormsController extends Controller
{
    private $route = 'forms';
    private $model = Form::class;
    private $bread_main = 'forms';
    private $bread_desc_index = 'forms';
    private $bread_desc_edit = 'Edit Company';
    private $bread_desc_create = 'Add Company';

    public function valid($request, $mod='create')
    {
        $v = [
            'title' => 'required',
        ];
        if($mod == 'create'){
            // $v['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        return $v;
    }

    public function attrs()
    {
        return [
            'title' => 'title',
            'slug' => 'slug',
           // 'image' => 'Image',
        ];
    }

    public function insert($request, &$model, $mod='create')
    {
        $model->title = enc($request->title);

        // if(($model->by_ocoda_dev == null || $model->by_ocoda_dev == false) && $mod == 'edit') {
        //     if($request->image){
        //         $imageName = microtime().'.'.$request->image->extension();
        //         $request->image->move(public_path('uploads/companies'), $imageName);
        //         @unlink(public_path('uploads/companies/'.$model->image));
        //         $model->image = $imageName;
        //     }
        // }

        // if($mod == 'create') $model->by_ocoda_dev = true;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->model::paginate(10);
        return view('admin.'.$this->route.'.index', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_index,
            'results' => $results,
            'route' => $this->route,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_create,
            'update' => false,
            'route' => $this->route,
            'products' => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(array_merge($this->valid($request),
        //  (new ImageService(new Company))->getImageValidationRules(),
        //   (new SEOToolsService)->getSEOToolsValidationRules()
        ),
          [],
           $this->attrs());

        $new = new $this->model;
        $this->insert($request, $new);
        $new->title = $request->title;
        $new->slug = $request->slug;
        $new->slug_ar = $request->slug_ar;
        $new->phone = $request->phone;
        $new->email = $request->email;
        $new->name = $request->name;
        $new->active = $request->active;
        $new->product_id = $request->product_id;
        $new->save();



        session()->flash('success', 'Added successfully.');
        return redirect()->route($this->route . '.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->model::find($id);
        abort_if(empty($result), 404);
        return view('admin.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_edit,
            'result' => $result,
            'update' => true,
            'route' => $this->route,
            'products' => Product::all(),
        ]);
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

        $new = $this->model::find($id);
        abort_if(empty($new), 404);

        // if($result->by_ocoda_dev == true) {
        //     $request->validate(array_merge($this->valid($request, 'edit'), (new ImageService(new Company))->getImageDetailsValidationRules(), (new SEOToolsService)->getSEOToolsValidationRules()),[], $this->attrs());
        // } else {
        //     $request->validate($this->valid($request, 'edit'),[], $this->attrs());
        // }


        $new->title = $request->title;
        $new->slug = $request->slug;
        $new->slug_ar = $request->slug_ar;
        $new->phone = $request->phone;
        $new->email = $request->email;
        $new->name = $request->name;
        $new->active = $request->active;
        $new->product_id = $request->product_id;
        $new->save();

        // if($result->by_ocoda_dev == true) (new ImageService($request, $result))->update();
        // (new SEOToolsService($request, $result))->update();
        session()->flash('success', 'Updated Successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = $this->model::find($id);
        if(!empty($del)){

            DB::transaction(function() use ($del) {
                $del->delete();
                (new ImageService($del))->destroy();
                (new SEOToolsService($del))->destroy();
            });

            session()->flash('success', 'Deleted Successfully.');
        }
        return back();
    }

    public function data()
    {
        $results = FormData::with('product')->paginate(10);
        return view('admin.'.$this->route.'.data', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_index,
            'results' => $results,
            'route' => $this->route,
        ]);
    }
}
