<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserEditRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdminUsersRequest;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $roles = Role::lists('name','id')->all();

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersRequest $request)
    {
        //
        if (trim($request->password) == '')
        {
            $input = $request->except('password');
        }else{
            $input = $request->all();
        }

        if ($file = $request->file('photo_id'))
        {
            $name =time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;
        }
        $input['password']=bcrypt($request->password);

        User::create($input);
        return redirect('/admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::lists('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserEditRequest  $request, $id)
    {
        //

        $user = User::findOrFail($id);
        if (trim($request->password) == '')
        {
            $input = $request->except('password');
        }else{
            $input = $request->all();
        }


        if ($file = $request->file('photo_id'))
        {
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id']=$photo;
        }
       $input['password']= bcrypt($request->password);

        $user->update($input);
        return redirect('/admin/user');
       // return view('admin.users.index',compact('update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        unlink(public_path().$user->photo->file);
        $user->delete();
        Session::flash('delete_user','The user has been deleted.');
        return redirect('/admin/user');
    }
}
