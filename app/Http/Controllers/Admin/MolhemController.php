<?php

namespace App\Http\Controllers\Admin;

use App\Models\Molhem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ScriptsService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SEO\SEOToolsService;
use App\Services\UniqueImages\ImageService;
use Illuminate\Validation\ValidationException;

class MolhemController extends Controller
{
    private $route = 'molhem';
    private $model = Molhem::class;
    private $bread_main = 'molhem';
    private $bread_desc_index = 'molhem';
    private $bread_desc_edit = 'Edit Molhem';
    private $bread_desc_create = 'Add Molhem';

    public function valid($request, $mod='create')
    {
        $v = [
            'title.en' => 'required',
        ];
        if($mod == 'create'){
            // $v['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        return $v;
    }

    public function attrs()
    {
        return [
            'title.en' => 'Title',
            'cat' => 'Category',
            'title' => 'Title',
            'breif' => 'Breif',
            'content' => 'Content',
            'image' => 'Image',
        ];
    }

    public function insert($request, &$model, $mod='create')
    {
        $model->title = enc($request->title);
        $model->slug = Str::slug(@$model->title->en);
        $model->slug_ar = sluger(@$model->title->ar);

        if($mod  ==  'create'){
            $check = $this->model::where('slug', $model->slug)->orWhere('slug_ar', $model->slug_ar)->count();
            if($check){
                throw ValidationException::withMessages([
                    'title' => ['That titile already in use.'],
                ]);
                return back();
            }
        }
        $model->cat = enc($request->cat);
        $model->breif = enc($request->breif);
        $model->content = enc($request->content);

        if(($model->by_ocoda_dev == null || $model->by_ocoda_dev == false) && $mod == 'edit') {
            if($request->image){
                $imageName = microtime().'.'.$request->image->extension();
                $request->image->move(public_path('uploads/molhem'), $imageName);
                @unlink(public_path('uploads/molhem/'.$model->image));
                $model->image = $imageName;
            }
        }

        if($mod == 'create') $model->by_ocoda_dev = true;
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
        $request->validate(array_merge($this->valid($request), (new ImageService(new Molhem))->getImageValidationRules(), (new SEOToolsService)->getSEOToolsValidationRules(), (new ScriptsService)->getScriptsValidationRules()),[], $this->attrs());

        $new = new $this->model;
        $this->insert($request, $new);
        $new->save();

        (new ImageService($request, $new))->store();
        (new SEOToolsService($request, $new))->store();
        (new ScriptsService($new))->execute();

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
            $request->validate(array_merge($this->valid($request, 'edit'), (new ImageService(new Molhem()))->getImageDetailsValidationRules(), (new SEOToolsService)->getSEOToolsValidationRules(), (new ScriptsService)->getScriptsValidationRules()),[], $this->attrs());
        } else {
            $request->validate($this->valid($request, 'edit'),[], $this->attrs());
        }

        $this->insert($request, $result, 'edit');
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
