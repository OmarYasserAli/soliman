<?php

namespace App\Http\Controllers\Selling;

use App\Models\Unit;
use App\Models\SProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Type;
use Carbon\Carbon;

class UnitsController extends Controller
{
    private $route = 'units';
    private $model = Unit::class;
    private $bread_main = 'Units';
    private $bread_desc_index = 'Units';
    private $bread_desc_edit = 'Edit Unit';
    private $bread_desc_create = 'Add Unit';

    public function valid($request, $mod='create')
    {
        $v = [
            'name' => 'required',
            'project_id' => 'required',
            //'type_id' => 'required',
            //'floor_id' => 'required',
        ];
        return $v;
    }

    public function attrs()
    {
        return [
            'name' => 'Unit ID',
            'project_id' => 'Project name',
            'type_id' => 'Type',
            'floor_id' => 'Floor',
        ];
    }

    public function unitUpdate(Request $request)
    {
        if(!in_array($request->target, ['sold','hold', 'sale'])){
            return response()->json([
                'status' => false,
            ]);
        }
        $unit = $this->model::where('id', $request->id)->first();
        if(empty($unit)){
            return response()->json([
                'status' => false,
            ]);
        }
        $target = ['sold' => 2,'hold' => 1, 'sale' => 0];
        $unit->status = $target[$request->target];
        $unit->update();
        return response()->json([
            'status' => true,
        ]);
    }

    public function insert($request, &$model, $mod='create')
    {
        $model->name = (int)$request->name;
        $model->project_id = (int)$request->project_id;
        $model->type_id = (int)$request->type_id;
        $model->floor_id = (int)$request->floor_id;
        $model->status = (int)$request->status;
        $model->rooms = (int)$request->rooms;
        $model->space = (float)$request->space;
        $model->space_acc = (float)$request->space_acc;
        $model->price = (float)$request->price;
        $model->specifications = $request->specifications;
        $model->accessories = enc($request->accessories);
        $model->specifications = enc($request->specifications);
        $model->gallery = json_encode(upload_gallery($request->gallery, 'uploads/units'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = $this->model::where(function($q)use($request){
            if($request->has('project_id')){
                $q->where('project_id', (int)$request->project_id);
            }
        })->orderby('name', 'asc')->paginate(50);
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
        $projects = SProject::all();
        $floors = Floor::all();
        return view('selling.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_create,
            'update' => false,
            'floors' => $floors,
            'projects' => $projects,
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
        $projects = SProject::all();
        $floors = Floor::all();
        return view('selling.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_edit,
            'result' => $result,
            'update' => true,
            'floors' => $floors,
            'projects' => $projects,
            'route' => $this->route,
        ]);
    }
    public function replicate($id)
    {
        $post = $this->model::find($id);
        abort_if(empty($post), 404);
        $newPost = $post->replicate();
        $newPost->created_at = Carbon::now();
        $newPost->save();
        return redirect()->route('units.edit', $newPost->id);
    }
    public function replicate10($id)
    {
        $post = $this->model::find($id);
        abort_if(empty($post), 404);
        for($i=1;$i<=10;$i++){
            $newPost = $post->replicate();
            $newPost->name = (int)$post->name+$i;
            $newPost->created_at = Carbon::now();
            $newPost->save();
        }
        return back();
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
}

