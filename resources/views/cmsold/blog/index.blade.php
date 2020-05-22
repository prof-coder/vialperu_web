@extends('cms.layout.base')

@section('title', 'Blog')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 class="mb-1"><span class="s-icon"><i class="ti-thought"></i></span> &nbsp;Blog Post</h5><hr>
            <a href="{{ route('cms.blog.create') }}" style="margin-left: 1em;" class="btn btn-success shadow-box btn-rounded pull-right"><i class="fa fa-plus"></i>Add New</a>
            <a href="{{ url('/blogs') }}" style="margin-left: 1em;" class="btn btn-success shadow-box btn-rounded pull-right" target="_blank"><i class="fa fa-plus"></i>View Blog</a>
            <table class="table table-striped table-bordered dataTable" id="table-2" style="width:100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width: 300px;">Post Title</th>
                        
                        <th style="width: 800px;">Description</th>
                       
                        <th> Post Image</th>
                        <th style="width: 80px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($blog as $index => $service)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $service->title }}</td>
                        <td>{!! str_limit($service->description, 200) !!}</td>
                       
                        <td>
                            @if($service->image) 
                                <img src="{{$service->image}}" style="height: 50px" >
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('cms.blog.destroy', $service->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ route('cms.blog.edit', $service->id) }}" class="btn btn-success shadow-box">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button class="btn btn-danger shadow-box" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
               
            </table>
        </div>
    </div>
</div>
@endsection