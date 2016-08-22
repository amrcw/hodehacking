@extends('layouts.admin')

@section('content')

    <h1>Edit Users</h1>

    <div class="row">
    <div class="col-sm-3">

        <img height="300" src="{{$user->photo ? $user->photo->file : 'http://localhost/codehacking/public/images/Noimage.jpg'}}" alt="" class="image-responsive image-rounded">

    </div>

    <div class="col-sm-9">


    {!! Form::model($user,['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],'files'=> true]) !!}

    <div class="form-group">
        {!! Form::label('name','Name :') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}

    </div>
    <div class="form-group">
        {!! Form::label('email','Email :') !!}
        {!! Form::email('email',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id','Role ID :') !!}
        {!! Form::select('role_id',[''=>'Select Option']+ $roles,null,['class'=>'form-control']) !!}

    </div>
    <div class="form-group">
        {!! Form::label('is_active','Status :') !!}
        {!! Form::select('is_active',array(1 => 'Active', 0 =>'Not Active'),0,['class'=>'form-control']) !!}

    </div>
    <div class="form-group">
        {!! Form::label('photo_id','Upload File :') !!}
        {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password','Password :') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}

    </div>
    <div class="form-group">
        {!! Form::submit('Update  user',['class'=>'btn btn-primary col-sm-2']) !!}
    </div>
    {!! Form::close() !!}



     {!! Form::open(['method'=>'DELETE','action'=>['AdminUsersController@destroy',$user->id]]) !!}

         <div class="form-group">
             {!! Form::submit('Delete  user',['class'=>'btn btn-danger col-sm-2']) !!}
         </div>

     {!!  Form::close() !!}

    </div>
    </div>
    <div class="row">
    @include('admin.include.form-error')
    </div>
@stop
