<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SEO\SEOToolsService;
use Illuminate\Validation\ValidationException;

class PagesController extends Controller
{
    private $route = 'pages';
    private $model = Page::class;
    private $bread_main = 'pages';
    private $bread_desc_index = 'pages';
    private $bread_desc_edit = 'Edit Page';
    private $bread_desc_create = 'Add Page';

    public function valid($request, $mod='create')
    {
        $v = [
            'title.en' => 'required',
        ];
        return $v;
    }

    public function attrs()
    {
        return [
            'title.en' => 'Title',
            'content' => 'Content',
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
        $model->content = enc($request->content);
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
        $request->validate(array_merge($this->valid($request), (new SEOToolsService)->getSEOToolsValidationRules()),[], $this->attrs());

        $new = new $this->model;
        $this->insert($request, $new);
        $new->save();

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
        $request->validate(array_merge($this->valid($request, 'edit'), (new SEOToolsService)->getSEOToolsValidationRules()),[], $this->attrs());

        $this->insert($request, $result, 'edit');
        $result->update();

        (new SEOToolsService($request, $result))->update();

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
            $del->delete();
            (new SEOToolsService($del))->destroy();
            session()->flash('success', 'Deleted Successfully.');
        }
        return back();
    }
}
