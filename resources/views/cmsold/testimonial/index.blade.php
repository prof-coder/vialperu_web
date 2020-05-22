@extends('cms.layout.base')



@section('title', 'Testimonials')



@section('content')



    <div class="content-area py-1">

        <div class="container-fluid">

            

            <div class="box box-block bg-white">

                <h5 class="mb-1"><i class="ti-themify-favicon"></i>&nbsp;Testimonials</h5><hr>

                <a href="{{ route('cms.testimonial.create') }}" style="margin-left: 1em;" class="btn shadow-box btn-success btn-rounded pull-right"><i class="fa fa-plus"></i> Add New</a>

                

                <table class="table table-striped table-bordered dataTable" id="table-2" style="width:100%">

                    <thead>

                        <tr>

                            <th>Image</th>

                            <th>Name</th>

                            <th>Type</th>

                            <th>Description</th> 

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @if( count( $testimonials ) > 0 )

                            @foreach( $testimonials as $testimonial )

                                <tr>

                                    <td><img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{ asset('storage/app/public/'.$testimonial->image ) }}"></td>

                                    <td>{{ $testimonial->name }}</td>

                                    <td>{{ $testimonial->type }}</td>

                                    <td>{{ $testimonial->description }}</td>

                                    <td style="width: 100px">

                                        <form action="{{ route('cms.testimonial.destroy', $testimonial->id) }}" method="POST">

                                            {{ csrf_field() }}

                                            <input type="hidden" name="_method" value="DELETE">

                                            <a href="{{ route('cms.testimonial.edit', $testimonial->id) }}" class="btn shadow-box btn-success"><i class="fa fa-pencil"></i></a>

                                            <button class="btn btn-danger shadow-box" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        @else

                            <tr>

                                <td colspan="6">No Testimonial found</td>

                            </tr>

                        @endif

                    </tbody>

                    <tfoot>

                        <tr>

                            <td>Image</td>

                            <td>Name</td>

                            <td>Type</td>

                            <td>Description</td> 

                            <td>Action</td>

                        </tr>

                    </tfoot>

                </table>

            </div>

            

        </div>

    </div>

@endsection