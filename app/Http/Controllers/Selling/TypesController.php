<?php

namespace App\Http\Controllers\Selling;

use App\Models\Type;
use App\Models\SProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypesController extends Controller
{
    private $route = 'types';
    private $model = Type::class;
    private $bread_main = 'Types';
    private $bread_desc_index = 'Types';
    private $bread_desc_edit = 'Edit Type';
    private $bread_desc_create = 'Add Type';

    public function valid($request, $mod='create')
    {
        $v = [
            'name.en' => 'required',
            'name.ar' => 'required',
            'project_id' => 'required',
        ];
        return $v;
    }

    public function attrs()
    {
        return [
            'name.en' => 'En Name',
            'name.ar' => 'Ar Name',
            'project_id' => 'Project name',
        ];
    }

    public function insert($request, &$model, $mod='create')
    {
        $model->project_id = (int)$request->project_id;
        $model->name = enc($request->name);
    }

    public function TypesList(Request $request)
    {
        $results = $this->model::where('project_id', (int)$request->id)->get();
        $list = '';
        foreach($results as $result){
            $list .= '<option value="'.$result->id.'" >'.$result->name->en.'</option>';
        }
        return response()->json([
            'list' => $list
        ]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->model::with('project')->paginate(10);
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
        $projects = SProject::where('type', 0)->get();
        return view('selling.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_create,
            'update' => false,
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
        $projects = SProject::where('type', 0)->get();
        return view('selling.'.$this->route.'.update', [
            'bread_main' => $this->bread_main,
            'bread_desc' => $this->bread_desc_edit,
            'result' => $result,
            'projects' => $projects,
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

