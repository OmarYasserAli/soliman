<?php

namespace App\Http\Controllers\Selling;

use App\Models\City;
use App\Models\SProject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;

class ProjectsController extends Controller
{
    private $route = 'sprojects';
    private $model = SProject::class;
    private $bread_main = 'Projects';
    private $bread_desc_index = 'Projects';
    private $bread_desc_edit = 'Edit Project';
    private $bread_desc_create = 'Add Project';

    public function valid($request, $mod='create')
    {
        $v = [
            'name.en' => 'required',
            'name.ar' => 'required',
            'slug' => 'required',
        ];
        return $v;
    }

    public function attrs()
    {
        return [
            'name.en' => 'En Name',
            'name.ar' => 'Ar Name',
            'slug' => 'Slug',
        ];
    }

    public function insert($request, &$model, $mod='create')
    {
        $model->name = enc($request->name);
        $model->slug = sluger($request->slug);
        $model->url360 = $request->url360;
        $model->profile = $request->profile;
        $model->location = $request->location;
        $model->original_id = (int)$request->original_id;
        $model->buildings_count = (int)$request->buildings_count;
        $model->floors_max = (int)$request->floors_max;
        $model->city_id = (int)$request->city_id;
        $model->area_id = (int)$request->area_id;
        $model->status = (int)$request->status;
        $model->type = (int)$request->type;
        $model->ucount = (int)$request->ucount;
        $model->active = (bool)$request->active;
        // $model->avilable_units = (int)$request->avilable_units;
        if($request->cover){
            $coverName = microtime().'.'.$request->cover->extension();
            $request->cover->move(public_path('uploads/sprojects'), $coverName);
            //@unlink(public_path('uploads/sprojects/'.$model->cover));
            $model->cover = $coverName;
        }
        if($request->logo){
            $logoName = microtime().'.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/sprojects'), $logoName);
            //@unlink(public_path('uploads/sprojects/'.$model->logo));
            $model->logo = $logoName;
        }
        $model->gallery = json_encode(upload_gallery($request->gallery, 'uploads/sprojects'));
        $model->igallery = json_encode(upload_gallery($request->igallery, 'uploads/sprojects'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->model::paginate(50);
        return view('selling.'.$this->route.'.index', [
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
        $cities = City::all();
        return view('selling.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_create,
            'cities' => $cities,
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
        $request->validate($this->valid($request),[], $this->attrs());

        $new = new $this->model;
        $this->insert($request, $new);
        if($request->profile_file){
            $nn = str_replace(' ', '-', $request->profile_file->getClientOriginalName());
            $imageName = time().$nn ; //.'.'.$request->profile_file->extension()
            $request->profile_file->move(public_path('uploads/projects'), $imageName);
            $new->profile =   asset('uploads/projects/'.$imageName);

        }
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
        $cities = City::all();
        return view('selling.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_edit,
            'result' => $result,
            'cities' => $cities,
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
        $request->validate($this->valid($request, 'edit'),[], $this->attrs());

        $this->insert($request, $result, 'edit');
        if($request->profile_file){
            $nn = str_replace(' ', '-', $request->profile_file->getClientOriginalName());
            $imageName = time().$nn ; //.'.'.$request->profile_file->extension()
            $request->profile_file->move(public_path('uploads/projects'), $imageName);
            $result->profile =   asset('uploads/projects/'.$imageName);

        }
        $result->update();
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
            session()->flash('success', 'Deleted Successfully.');
        }
        return back();
    }

    public function replicate($id)
    {
        $post = $this->model::find($id);
        abort_if(empty($post), 404);
        $newPost = $post->replicate();
        $newPost->created_at = Carbon::now();
        $newPost->save();
        $cities = City::all();
        return redirect()->route('sprojects.edit', $newPost->id);
    }
}
