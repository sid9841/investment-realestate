@extends('admin.layouts.app')

@section('title')
        @lang("File Manager")
@endsection


@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <!-- Currency Create Form  -->
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <iframe src="{{URL::to('/')}}/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
