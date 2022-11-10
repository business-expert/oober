@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a book
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Books</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>books</li>
        <li class="active">Create New book</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit book
                    </h4>
                </div>
                <div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($book, ['method' => 'PATCH', 'action' => ['BooksController@update', $book->id],'files'=>true]) !!}

                    <div class="form-group">
                        {!! Form::label('string', 'String: ') !!}
                        {!! Form::text('string', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('string', 'String: ') !!}
                        {!! Form::text('string', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('text', 'Text: ') !!}
                        {!! Form::text('text', null, ['class' => 'form-control']) !!}
                    </div>

					

                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</section>
@stop