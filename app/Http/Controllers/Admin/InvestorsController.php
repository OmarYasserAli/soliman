<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Igroup;
use App\Models\Investor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SEO\SEOToolsService;

class InvestorsController extends Controller
{
    private $route = 'investors';
    private $model = Investor::class;
    private $bread_main = 'investors';
    private $bread_desc_index = 'investors';
    private $bread_desc_edit = 'Edit Investor';
    private $bread_desc_create = 'Add Investor';

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
            'parent' => 'Parent',
            'group' => 'Group',
            'url' => 'URL',
        ];
    }

    public function insert($request, &$model, $mod='create')
    {
        $model->title = enc($request->title);
        $model->parent = (int)$request->parent;
        $model->group = (int)$request->group;
        $model->url = $request->url;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->model::select('*', DB::raw('(select title from s_investors as b where b.id=s_investors.parent) as parent_name'))->paginate(10);
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
        $groups = Igroup::select('id','title')->get();
        $parents = $this->model::select('id', 'title')->where('parent', 0)->get();
        return view('admin.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_create,
            'update' => false,
            'parents' => $parents,
            'route' => $this->route,
            'igroups' => $groups,
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

        if($request->url_file){
            $nn = str_replace(' ', '-', $request->url_file->getClientOriginalName());
            $imageName = time().$nn ; //.'.'.$request->url_file->extension()
            $request->url_file->move(public_path('uploads/files'), $imageName);

            $new->url =   asset('uploads/files/'.$imageName);

        }

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
        $groups = Igroup::select('id','title')->get();
        $parents = $this->model::select('id', 'title')->where('parent', 0)->get();
        return view('admin.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_edit,
            'result' => $result,
            'update' => true,
            'parents' => $parents,
            'route' => $this->route,
            'igroups' => $groups,
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

        if($request->url_file){
            $nn = str_replace(' ', '-', $request->url_file->getClientOriginalName());
            $imageName = time().$nn ; //.'.'.$request->url_file->extension()
            $request->url_file->move(public_path('uploads/files'), $imageName);

            $result->url =   asset('uploads/files/'.$imageName);

        }
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
