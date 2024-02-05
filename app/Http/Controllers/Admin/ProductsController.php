<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ScriptsService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SEO\SEOToolsService;
use Illuminate\Support\Facades\Cache;
use App\Services\UniqueImages\ImageService;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
    private $route = 'products';
    private $model = Product::class;
    private $bread_main = 'Products';
    private $bread_desc_index = 'Products';
    private $bread_desc_edit = 'Edit Product';
    private $bread_desc_create = 'Add Product';

    public function valid($request, $mod='create')
    {
        $v = [
            'name.en' => 'required',
        ];
        return $v;
    }

    public function attrs()
    {
        return [
            'name.en' => 'Name',
            'title' => 'Title',
            'content' => 'Content',
            'image' => 'Image',
        ];
    }

    public function insert($request, &$model, $mod='create')
    {
        $model->title = enc($request->title);
        $model->name = enc($request->name);
        $model->slug = Str::slug(@$model->name->en);
        $model->slug_ar = sluger(@$model->name->ar);

        if($mod  ==  'create'){
            $check = $this->model::where('slug', $model->slug)->orWhere('slug_ar', $model->slug_ar)->count();
            if($check){
                throw ValidationException::withMessages([
                    'title' => ['That titile already in use.'],
                ]);
                return back();
            }
        }

        $model->breif = enc($request->breif);
        $model->land_size = (int)$request->land_size;
        $model->sizes = enc($request->sizes);
        $model->features = enc($request->features);
        $model->garuntees = enc($request->garuntees);
        $model->owner = (int)$request->owner;
        $model->developer = (int)$request->developer;
        $model->contractor = (int)$request->contractor;
        $model->profile = $request->profile;
        $model->f360 = $request->f360;
        $model->map = $request->map;

        if(($model->by_ocoda_dev == null || $model->by_ocoda_dev == false) && $mod == 'edit') {
            if($request->image){
                $imageName = microtime().'.'.$request->image->extension();
                $request->image->move(public_path('uploads/products'), $imageName);
                @unlink(public_path('uploads/products/'.$model->image));
                $model->image = $imageName;
            }
            if($request->logo){
                $logoName = microtime().'.'.$request->logo->extension();
                $request->logo->move(public_path('uploads/products'), $logoName);
                @unlink(public_path('uploads/products/'.$model->logo));
                $model->logo = $logoName;
            }
        }

        if($mod == 'create') $model->by_ocoda_dev = true;

        $model->gallery = enc(upload_gallery($request->gallery, 'uploads/products'));

        Cache::forget('products');
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
        $companies = Company::select('id', 'title')->get();
        return view('admin.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_create,
            'companies' => $companies,
            'update' => false,
            'route' => $this->route,
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
        // dd((new SEOToolsService)->getSEOToolsValidationRules());
        $request->validate(array_merge($this->valid($request),
         (new ImageService(new Product))->getImageValidationRules(),
          (new SEOToolsService)->getSEOToolsValidationRules(),
           (new ScriptsService)->getScriptsValidationRules()),[], $this->attrs());

        $new = new $this->model;
        $this->insert($request, $new, 'create');
        $new->save();

        (new ImageService($request, $new))->store();
        (new SEOToolsService($request, $new))->store();

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
        $companies = Company::select('id', 'title')->get();
        return view('admin.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_edit,
            'result' => $result,
            'companies' => $companies,
            'update' => true,
            'route' => $this->route,
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
        $result = $this->model::find($id);
        abort_if(empty($result), 404);

        if($result->by_ocoda_dev == true) {
            $request->validate(array_merge($this->valid($request, 'edit'), (new ImageService(new Product))->getImageDetailsValidationRules(), (new SEOToolsService)->getSEOToolsValidationRules()),[], $this->attrs());
        } else {
            $request->validate($this->valid($request, 'edit'),[], $this->attrs());
        }


        $this->insert($request, $result, 'edit');

        if($request->profile_file){
            $nn = str_replace(' ', '-', $request->profile_file->getClientOriginalName());
            $imageName = time().$nn ; //.'.'.$request->profile_file->extension()
            $request->profile_file->move(public_path('uploads/products'), $imageName);
            @unlink(public_path('uploads/products/'.$result->profile));
            $result->profile =   asset('uploads/products/'.$imageName);
        }

        $result->update();

        if($result->by_ocoda_dev == true) (new ImageService($request, $result))->update();
        (new SEOToolsService($request, $result))->update();
        (new ScriptsService($result))->execute();

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
                (new ScriptsService($del))->destroy();
            });

            session()->flash('success', 'Deleted Successfully.');
        }
        return back();
    }
}
