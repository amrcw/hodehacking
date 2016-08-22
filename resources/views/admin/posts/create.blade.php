@extends('layouts.admin')

@section('content')

    <h1>Create Posts</h1>
    @include('admin.include.form-error')

    {!! Form::open(['method'=>'POST','action'=>'AdminPostsController@store','files'=>true]) !!}

        <div class="form-group">

            {!! Form::label('Title','Title :') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}

            {!! Form::label('category_id','Category :') !!}
            {!! Form::select('category_id',['0'=>'Select Option']+$category,null,['class'=>'form-control']) !!}

            {!! Form::label('content','Description :') !!}
            {!! Form::textarea('content',null,['class'=>'form-control','row'=>3]) !!}

            {!! Form::label('photo_id','Photo :') !!}
            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}

        </div>
        <div class="form-group">
            {!! Form::submit('Create  post',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}




@stop()