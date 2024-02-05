<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    private $route = 'users';
    private $model = User::class;
    private $bread_main = 'Users';
    private $bread_desc_index = 'Users';
    private $bread_desc_edit = 'Edit User';
    private $bread_desc_create = 'Add User';

    public function valid($request, $mod='create')
    {
        $v = [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'active' => 'required|boolean',
        ];
        if($mod == 'create' || $request->filled('password')){
            $v['password'] = 'required|confirmed|min:6';
        }
        return $v;
    }

    public function attrs()
    {
        return [
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'email' => 'Email',
            'active' => 'Activation'
        ];
    }

    public function insert($request, &$model, $mod='create')
    {
        $model->fname = $request->fname;
        $model->lname = $request->lname;
        $model->email = $request->email;
        $model->active = (bool)$request->active;
        if($mod == 'create' || $request->filled('password')){
            $model->password = Hash::make($request->password);
        }
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
