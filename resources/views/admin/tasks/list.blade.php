@extends('admin.layouts.app')
@section('title')
    @lang("Task List")
@endsection

@section('content')


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            @if(adminAccessRoute(config('role.manage_user.access.edit')))
                <div class="dropdown mb-2 text-right">
                    <button class="btn btn-sm  btn-primary btn-rounded dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i class="fas fa-bars pr-2"></i> @lang('Action')</span>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_active">@lang('Active')</button>
                        <button class="dropdown-item" type="button" data-toggle="modal"
                                data-target="#all_inactive">@lang('Inactive')</button>
                    </div>
                    <button class="btn btn-sm  btn-primary btn-rounded" type="button" data-toggle="modal"
                            data-target="#addNewLead">@lang('Add New Task')</button>


                </div>
            @endif

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        @if(adminAccessRoute(config('role.manage_user.access.edit')))
                            <th scope="col" class="text-center">
                                <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                       id="check-all">
                                <label for="check-all"></label>
                            </th>
                        @endif
                        <th scope="col">@lang('No.')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Start Date')</th>
                        <th scope="col">@lang('Due Date')</th>
                        <th scope="col">@lang('Assigned')</th>
                        <th scope="col">@lang('Tags')</th>

                        <th scope="col">@lang('Priority')</th>
                        @if(adminAccessRoute(config('role.manage_user.access.edit')))
                            <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            @if(adminAccessRoute(config('role.manage_user.access.edit')))
                                <td class="text-center">
                                    <input type="checkbox" id="chk-{{ $task->id }}"
                                           class="form-check-input row-tic tic-check" name="check" value="{{$task->id}}"
                                           data-id="{{ $task->id }}">
                                    <label for="chk-{{ $task->id }}"></label>
                                </td>
                            @endif
                            <td data-label="@lang('No.')">
                                <a href="{{route('admin.user-edit',[$task->id])}}" target="_blank">
                                    <div class="d-flex no-block align-items-center">

                                        <div class="">
                                            {{loopIndex($tasks) + $loop->index}}
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td data-label="@lang('Company')">@lang($task->subject)</td>
                            <td data-label="@lang('Status')">
                            <span
                                class="custom-badge badge-pill {{ $task->status == 0 ? 'bg-danger' : 'bg-success' }}">{{ $task->status == 0 ? 'Inactive' : $task->statusD->name }}</span>
                            </td>
                            <td data-label="@lang('Phone')">@lang($task->start_date)</td>
                            <td data-label="@lang('Phone')">@lang($task->due_date)</td>
                                <td data-label="@lang('Assigned')">@lang(@$task->assigned->name)</td>

                            <td data-label="@lang('Tags')">@foreach($task->tags as $tag) {{$tag}} @endforeach</td>
                            <td data-label="@lang('Tags')">@lang($task->priorityD->name)</td>



                            @if(adminAccessRoute(config('role.manage_user.access.edit')))
                                <td data-label="@lang('Action')">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" onclick="viewTask({{$task->id}})">
                                                <i class="fa fa-eye text-info pr-2"
                                                   aria-hidden="true"></i> @lang('View')
                                            </a>
                                            <a class="dropdown-item" onclick="editTask({{$task->id}})">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> @lang('Edit')
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.deleteTask',$task->id) }}">
                                                <i class="fa fa-trash text-danger pr-2"
                                                   aria-hidden="true"></i> @lang('Delete')
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-na" colspan="100%">@lang('No User Data')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$tasks->appends(@$search)->links('partials.pagination')}}

            </div>
        </div>
    </div>


    <div class="modal fade" id="addNewLead">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="{{route('admin.storeTask')}}" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title">@lang('Add New Task')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Subject</label>
                                <input type="text" class="form-control "
                                       name="subject"
                                       value="{{ old('subject') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the subject
                                </div>
                                @if ($errors->has('subject'))
                                    <span class="invalid-text">
                                                {{ $errors->first('subject') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Hourly Rate</label>
                                <input type="text" class="form-control "
                                       name="hourly_rate"
                                       value="{{ old('hourly_rate') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the hourly rate
                                </div>
                                @if ($errors->has('hourly_rate'))
                                    <span class="invalid-text">
                                                {{ $errors->first('hourly_rate') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Date</label>
                                <input type="date" class="form-control "
                                       name="issue_date"
                                       value="{{ old('issue_date') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the date
                                </div>
                                @if ($errors->has('issue_date'))
                                    <span class="invalid-text">
                                                {{ $errors->first('issue_date') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Open Till</label>
                                <input type="date" class="form-control "
                                       name="open_till_date"
                                       value="{{ old('open_till_date') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the open till date
                                </div>
                                @if ($errors->has('open_till_date'))
                                    <span class="invalid-text">
                                                {{ $errors->first('open_till_date') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6" >
                                <label>Priority</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" id="priority" name="priority"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    @foreach($priority as $pt)
                                        <option value="{{$pt->id}}">
                                            {{$pt->name}}</option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the contract type
                                </div>
                                @if ($errors->has('contract_type'))
                                    <span class="invalid-text">
                                                {{ $errors->first('contract_type') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6" >
                                <label>Assigned To</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" id="assigned_to" name="assigned_to"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>

                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the contract type
                                </div>
                                @if ($errors->has('contract_type'))
                                    <span class="invalid-text">
                                                {{ $errors->first('contract_type') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Tags</label>
                                <select class="form-control  tags-selectpicker currency-change"
                                        data-live-search="true" multiple name="tags[]"
                                        required="">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}" {{isset($estimate) ? (in_array($tag->id,$estimate->tags) ? 'selected' : '') : ''}}>
                                            {{$tag->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the assigned user
                                </div>
                                @if ($errors->has('tags'))
                                    <span class="invalid-text">
                                                {{ $errors->first('tags') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Description</label>
                                <textarea id="description" name="description" rows="4" class="form-control" placeholder="Description"></textarea>

                                <div class="invalid-feedback">
                                    Please fill in the assigned user
                                </div>
                                @if ($errors->has('tags'))
                                    <span class="invalid-text">
                                                {{ $errors->first('tags') }}
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-12">
                            <label>Attachment</label>
                            <div class="input-group">
                                   <span class="input-group-btn">
                                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose
                                     </a>
                                   </span>
                                <input id="thumbnail" class="form-control" type="text" name="filepath">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>



                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('Close')</span>
                        </button>
                        <button type="submit" class=" btn btn-primary "><span>@lang('Yes')</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editLead">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" id="updateTaskForm" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title">@lang('Update Task')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Subject</label>
                                <input type="text" class="form-control "
                                       name="subject"
                                       id="editSubject"
                                       value="{{ old('subject') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the subject
                                </div>
                                @if ($errors->has('subject'))
                                    <span class="invalid-text">
                                                {{ $errors->first('subject') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Hourly Rate</label>
                                <input type="text" class="form-control "
                                       name="hourly_rate"
                                       id="editHourlyRate"
                                       value="{{ old('hourly_rate') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the hourly rate
                                </div>
                                @if ($errors->has('hourly_rate'))
                                    <span class="invalid-text">
                                                {{ $errors->first('hourly_rate') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Date</label>
                                <input type="date" class="form-control "
                                       name="issue_date"
                                       id="editStartDate"
                                       value="{{ old('issue_date') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the date
                                </div>
                                @if ($errors->has('issue_date'))
                                    <span class="invalid-text">
                                                {{ $errors->first('issue_date') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Open Till</label>
                                <input type="date" class="form-control "
                                       name="open_till_date"
                                       id="editDueDate"

                                       value="{{ old('open_till_date') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the open till date
                                </div>
                                @if ($errors->has('open_till_date'))
                                    <span class="invalid-text">
                                                {{ $errors->first('open_till_date') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4 col-6" >
                                <label>Priority</label>
                                <select id="editPriority" class="form-control  selectpicker currency-change"
                                        data-live-search="true" id="priority" name="priority"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    @foreach($priority as $pd)
                                        <option value="{{$pd->id}}">{{$pd->name}}</option>

                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the contract type
                                </div>
                                @if ($errors->has('contract_type'))
                                    <span class="invalid-text">
                                                {{ $errors->first('contract_type') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4 col-6" >
                                <label>Assigned To</label>
                                <select id="editAssignedTo" class="form-control  selectpicker currency-change"
                                        data-live-search="true"  name="assigned_to"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>

                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the contract type
                                </div>
                                @if ($errors->has('contract_type'))
                                    <span class="invalid-text">
                                                {{ $errors->first('contract_type') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4 col-6" >
                                <label>Status</label>
                                <select id="editStatus" class="form-control  selectpicker currency-change"
                                        data-live-search="true"  name="status"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    @foreach($status as $st)
                                        <option value="{{$st->id}}">{{$st->name}}</option>

                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the contract type
                                </div>
                                @if ($errors->has('contract_type'))
                                    <span class="invalid-text">
                                                {{ $errors->first('contract_type') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Tags</label>
                                <select id="editTags" class="form-control tags-selectpicker currency-change"
                                        data-live-search="true" multiple name="tags[]"
                                        required="">
                                   @foreach($tags as $tg)
                                       <option value="{{$tg->id}}">{{$tg->name}}</option>
                                   @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the assigned user
                                </div>
                                @if ($errors->has('tags'))
                                    <span class="invalid-text">
                                                {{ $errors->first('tags') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Description</label>
                                <textarea id="editDescription" name="description" rows="4" class="form-control" placeholder="Description"></textarea>

                                <div class="invalid-feedback">
                                    Please fill in the assigned user
                                </div>
                                @if ($errors->has('tags'))
                                    <span class="invalid-text">
                                                {{ $errors->first('tags') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Attachment</label>
                                <div class="input-group">
                                   <span class="input-group-btn">
                                     <a id="lfm-edit" data-input="thumbnail-edit" data-preview="holder-edit" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose
                                     </a>
                                   </span>
                                    <input id="thumbnail-edit" class="form-control" type="text" name="filepath">
                                </div>
                                <div id="holder-edit" style="margin-top:15px;max-height:100px;"></div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('Close')</span>
                        </button>
                        <button type="submit" class=" btn btn-primary "><span>@lang('Update')</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewLead">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title">@lang('View Task')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="taskDetails">

            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('Active User Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p>@lang("Are you really want to active the User's")</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary active-yes"><span>@lang('Yes')</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="all_inactive" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('DeActive User Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <p>@lang("Are you really want to Inactive the User's")</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary inactive-yes"><span>@lang('Yes')</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('js')
    <script>
        "use strict";

        $(document).on('click', '#check-all', function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $(document).on('change', ".row-tic", function () {
            let length = $(".row-tic").length;
            let checkedLength = $(".row-tic:checked").length;
            if (length == checkedLength) {
                $('#check-all').prop('checked', true);
            } else {
                $('#check-all').prop('checked', false);
            }
        });

        //dropdown menu is not working
        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        //multiple active
        $(document).on('click', '.active-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            var strIds = allVals;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "{{ route('admin.user-multiple-active') }}",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                },
            });
        });
        function editTask(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.getTaskInfo') }}",
                type: "POST",
                data: {
                    dataid:  id,
                },
                success: function (data) {
                    $('#editSubject').val(data.subject)
                    $('#editHourlyRate').val(data.hourly_rate)
                    $('#editStartDate').val(data.start_date)
                    $('#editDueDate').val(data.due_date)
                    $('#editPriority').val(data.priority).trigger('change')
                    $('#editAssignedTo').val(data.assigned_users).trigger('change')
                    $('#editTags').val(data.tags).trigger('change')
                    $('#editDescription').val(data.task_description)
                    $('#updateTaskForm').attr('action','update-task/'+id);
                    $('#thumbnail-edit').val(data.filepath)
                    $('#editStatus').val(data.status).trigger('change')
                },
            });
            $('#editLead').modal('show');
        }
        function viewTask(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.getTaskInfo') }}",
                type: "POST",
                data: {
                    dataid:  id,
                },
                success: function (data) {
                   var taskInfo =  generateLeadView(data);
                   $('#taskDetails').html(taskInfo);

                },
            });
            $('#viewLead').modal('show');

        }
        //multiple deactive
        $(document).on('click', '.inactive-yes', function (e) {
            e.preventDefault();
            var allVals = [];
            $(".row-tic:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            var strIds = allVals;
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "{{ route('admin.user-multiple-inactive') }}",
                data: {strIds: strIds},
                datatType: 'json',
                type: "post",
                success: function (data) {
                    location.reload();

                }
            });
        });

        $(document).on('click', '.loginAccount', function () {
            var route = $(this).data('route');
            $('.loginAccountAction').attr('action', route)
        });
        $('.tags-selectpicker').select2({
            width: '100%',
            placeholder: '@lang("Select Tags")',
        });
        $('select').select2({
            selectOnClose: true,
            width: '100%'
        });

        $('.from_date').on('change', function (){
            $('.to_date').removeAttr('disabled');
        });
        function generateLeadView(data){
            console.log(data);
            var html = '<div class="row"> ' +
                '<div class="col-md-8 task-single-col-left" > <div class="task-single-related-wrapper"> ' +
                '<h4 class="bold font-medium mbot15 tw-mt-0">'+data.subject+'</h4> ' +
                '<h4 class="bold font-medium mbot15 tw-mt-0">Assigned To: '+data.assigned.name+'</h4> ' +
                '</div> <div class="clearfix"></div> <hr class="hr-10"> ' +
                '<h4 class="th tw-font-semibold tw-text-base mbot15 pull-left">Description</h4> <div class="clearfix"> </div> <hr>' +
                '<p>'+data.task_description+'</p>' +
                '<hr class="hr-10"> ' +
                '<h4 class="th tw-font-semibold tw-text-base mbot15 pull-left">Attachment</h4> <div class="clearfix"> </div> <hr>' +
                '<img style="max-width: 100%;" src="'+data.filepath+'"> </div> ' +
                '<div class="col-md-4 task-single-col-right"> ' +
                '<h4 class="task-info-heading tw-font-medium tw-text-base tw-mb-0 tw-text-neutral-800">Task Info        </h4> ' +
                '<div class="clearfix"></div> <p class="tw-mb-0 task-info-created tw-text-sm"> ' +
                // '<span class="tw-text-neutral-500">Created by <span class="tw-text-neutral-600">'+data.+'</span>                <i class="fa-regular fa-clock" data-toggle="tooltip" data-title="Created at 2024-05-12 14:00:07"></i></span> <br>' +
                '</p> <hr class="task-info-separator"> <div class="task-info task-status task-info-status"> <h5 class="tw-inline-flex tw-items-center tw-space-x-1.5"> ' +
                '<i class="fa-regular fa-star fa-fw fa-lg pull-left task-info-icon"></i>Status: '+data.status+'</h5></div>' +
                '<div class="task-info task-single-inline-wrap task-info-start-date"> <h5 class="tw-inline-flex tw-items-center tw-space-x-1.5"> <div class="tw-shrink-0 tw-grow"> <i class="fa-regular fa-calendar fa-fw fa-lg fa-margin task-info-icon pull-left tw-mt-2"></i>' +
                'Start Date:' +data.start_date+'</div> </h5> </div> <div class="task-info task-info-due-date task-single-inline-wrap"> <h5 class="tw-inline-flex tw-items-center tw-space-x-1.5"> <div class="tw-shrink-0 tw-grow"> <i class="fa-regular fa-calendar-check fa-fw fa-lg task-info-icon pull-left tw-mt-2"></i>' +
                'Due Date:' +data.due_date+' </div> </h5> </div> <div class="task-info task-info-priority"> ' +
                '<h5 class="tw-inline-flex tw-items-center tw-space-x-1.5"> ' +
                '<i class="fa fa-bolt fa-fw fa-lg task-info-icon pull-left"></i>Priority: <span class="task-single-menu task-menu-priority"> <span class="trigger pointer manual-popover text-has-action" style="color:#03a9f4;" data-original-title="" title="">' +
                data.priority_d.name+' </span> </span> </h5> </div> <div class="task-info task-info-hourly-rate"> <h5 class="tw-inline-flex tw-items-center tw-space-x-1.5"> <i class="fa-regular fa-clock fa-fw fa-lg task-info-icon pull-left"></i>' +
                'Hourly Rate: <span class="tw-text-neutral-800">' +data.hourly_rate +'                   </span> </h5> </div> <div class="mtop10 clearfix"></div> ' +
                '<hr class="task-info-separator"> <div class="clearfix"></div> </div> </div>';
                return html;
        }

    </script>
    <script src="{{asset('assets/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>
        var route_prefix = '{{URL::to('/')}}/laravel-filemanager';
        $('#lfm').filemanager('file',{prefix: route_prefix});
        $('#lfm-edit').filemanager('file',{prefix: route_prefix});
    </script>
@endpush
