<?php

namespace App\Http\Controllers\selling;

use App\Models\Area;
use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class AreasController extends Controller
{
    private $route = 'areas';
    private $model = Area::class;
    private $bread_main = 'Areas';
    private $bread_desc_index = 'Areas';
    private $bread_desc_edit = 'Edit Area';
    private $bread_desc_create = 'Add Area';

    public function valid($request, $mod='create')
    {
        $v = [
            'name.en' => 'required',
            'name.ar' => 'required',
            'city_id' => 'required',
        ];
        return $v;
    }

    public function attrs()
    {
        return [
            'name.en' => 'En Name',
            'name.ar' => 'Ar Name',
            'city_id' => 'City',
        ];
    }

    public function insert($request, &$model, $mod='create')
    {
        $model->city_id = (int)$request->city_id;
        $model->name = enc($request->name);
        // $model->slug = sluger($request->slug);
    }

    public function AreasList(Request $request)
    {
        $results = $this->model::where('city_id', (int)$request->id)->get();
        $list = '';
        foreach($results as $result){
            $list .= '<option value="'.$result->id.'" >'.@$result->name->en.'</option>';
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
        $results = $this->model::with('city')->paginate(10);
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
            'update' => false,
            'cities' => $cities,
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

