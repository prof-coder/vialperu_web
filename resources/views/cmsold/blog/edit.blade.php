@extends('cms.layout.base')

@section('title', 'Update Service Type ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('cms.blog.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i>@lang('cms.btn.back')</a>

            <h5 style="margin-bottom: 2em;"><span class="s-icon"><i class="ti-thought"></i></span> &nbsp;Update Blog Post</h5><hr>
            <form class="form-horizontal" action="{{route('cms.blog.update', $service->id )}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
				
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">Post Name</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $service->title }}" name="title" required id="title" placeholder="title">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="provider_name" class="col-xs-2 col-form-label">Description</label>
                    <div class="col-xs-10">
                        <textarea class="form-control" name="description" required id="myeditor" placeholder="description">{{ $service->description }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    
                    <label for="image" class="col-xs-2 col-form-label">Post Image</label>
                    <div class="col-xs-10">
                        @if(isset($service->image))
                        <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{ $service->image }}">
                        @endif
                        <input type="file" accept="image/*" name="image" class="dropify form-control-file" id="image" aria-describedby="fileHelp">
                    </div>
                </div>
				
                <div class="form-group row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success shadow-box btn-block">Save</button>
                    </div>
                    <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                        <a href="{{route('cms.blog.index')}}" class="btn btn-danger shadow-box btn-block">Cancel</a>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('myeditor');
</script>
@endsection

