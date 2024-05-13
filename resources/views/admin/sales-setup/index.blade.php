@extends('admin.layouts.app')
@section('title')
    @lang("Sales Setup")
@endsection

@section('content')
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
    <div class="row">
        <div class="col-md-2 mb-3">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tags</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Priority</a>
                </li>
            </ul>
        </div>
        <!-- /.col-md-4 -->
        <div class="col-md-10">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <button data-toggle="modal" data-target="#addStatusModal" class="btn btn-primary float-right">Add Status</button>
                    <h2>Status </h2>
                    <p>
                    <div class="table-responsive">
                        <table class="categories-show-table table table-hover table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">@lang('No.')</th>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($status as $stt)
                                    <tr>
                                        <td>
                                            {{$loop->index+1}}
                                        </td>
                                        <td>
                                            {{$stt->name}}
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href="{{ route('admin.deleteStatus',$stt->id) }}">
                                                @lang('Delete')
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="addStatusModal" tabindex="-1" role="dialog" aria-labelledby="addStatusModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="{{route('admin.storeStatus')}}"}}>@csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group col-md-12 col-12">
                                        <label>Title</label>
                                        <input type="text" class="form-control "
                                               name="status"
                                               required="">
                                        <div class="invalid-feedback">
                                            Please fill in the status
                                        </div>
                                        @if ($errors->has('status'))
                                            <span class="invalid-text">
                                                {{ $errors->first('status') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <button data-toggle="modal" data-target="#addTagsModal" class="btn btn-primary float-right">Add Tags</button>
                    <h2>Tags </h2>
                    <p>
                    <div class="table-responsive">
                        <table class="categories-show-table table table-hover table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">@lang('No.')</th>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tg)
                                <tr>
                                    <td>
                                        {{$loop->index+1}}
                                    </td>
                                    <td>
                                        {{$tg->name}}
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteTags',$tg->id) }}">
                                            @lang('Delete')
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="addTagsModal" tabindex="-1" role="dialog" aria-labelledby="addTagsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="{{route('admin.storeTags')}}"}}>@csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Tags</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Title</label>
                                            <input type="text" class="form-control "
                                                   name="status"
                                                   required="">
                                            <div class="invalid-feedback">
                                                Please fill in the status
                                            </div>
                                            @if ($errors->has('status'))
                                                <span class="invalid-text">
                                                {{ $errors->first('status') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <button data-toggle="modal" data-target="#addPriorityModal" class="btn btn-primary float-right">Add Priority</button>
                    <h2>Priority </h2>
                    <p>
                    <div class="table-responsive">
                        <table class="categories-show-table table table-hover table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">@lang('No.')</th>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($priorities as $priority)
                                <tr>
                                    <td>
                                        {{$loop->index+1}}
                                    </td>
                                    <td>
                                        {{$priority->name}}
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="{{ route('admin.deletePriority',$priority->id) }}">
                                            @lang('Delete')
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="addPriorityModal" tabindex="-1" role="dialog" aria-labelledby="addPriorityModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="{{route('admin.storePriority')}}"}}>@csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Priority</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Title</label>
                                            <input type="text" class="form-control "
                                                   name="status"
                                                   required="">
                                            <div class="invalid-feedback">
                                                Please fill in the status
                                            </div>
                                            @if ($errors->has('status'))
                                                <span class="invalid-text">
                                                {{ $errors->first('status') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-md-8 -->
    </div>
        </div>
    </div>

@endsection
