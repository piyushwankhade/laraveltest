@extends('layouts.app')

@section('content')
<div class="container">

    <div class="">
        <a href="{{ route('article_categories.create') }}" class="btn btn-primary" title="Add Category">Add Category</a>
    </div><br>
    <table class="table table-bordered">            
        <thead>
            <tr>
                <th>Title</th>                
                <th>Parent</th>
                <th>Status</th>
                <th>Approval</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>     
        @foreach($categories as $key => $category)       
            <tr>
                <td>{{$category->title}}</td>
                <td>{{$category->parent->title ? : 'Self'}}</td>                
                <td>{{$category->status}} | <a href="{{ route('article_categories.status',$category->id) }}" title="">Change Status</a> </td>
                <td>{{$category->approval}} | <a href="{{ route('article_categories.approval',$category->id) }}" title="">Change Approval</a></td>                
                <td><a href="{{ route('article_categories.edit',$category->id) }}" title="">Edit</a> | 
                    <a href="{{ route('article_categories.delete',$category->id) }}" title="">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection