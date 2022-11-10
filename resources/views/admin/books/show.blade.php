@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
book
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
        <li class="active">books</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    book {{ $book->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $book->id }}</td></tr>
                     <tr><td>string</td><td>{{ $book['string'] }}</td></tr>
					<tr><td>string</td><td>{{ $book['string'] }}</td></tr>
					<tr><td>text</td><td>{{ $book['text'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop