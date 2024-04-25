@extends('admin.layouts.app')
@section('title')
    @lang("Items List")
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
                            data-target="#addNewItem">@lang('Add New Item')</button>


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
                        <th scope="col">@lang('Description')</th>
                        <th scope="col">@lang('Long Description')</th>
                        <th scope="col">@lang('Rate')</th>
                        <th scope="col">@lang('Unit')</th>
                        <th scope="col">@lang('Group Name')</th>
                        <th scope="col">@lang('Status')</th>
                        @if(adminAccessRoute(config('role.manage_user.access.edit')))
                            <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $item)
                        <tr>
                            @if(adminAccessRoute(config('role.manage_user.access.edit')))
                                <td class="text-center">
                                    <input type="checkbox" id="chk-{{ $item->id }}"
                                           class="form-check-input row-tic tic-check" name="check" value="{{$item->id}}"
                                           data-id="{{ $item->id }}">
                                    <label for="chk-{{ $item->id }}"></label>
                                </td>
                            @endif
                            <td data-label="@lang('No.')">
                                <a href="{{route('admin.user-edit',[$item->id])}}" target="_blank">
                                    <div class="d-flex no-block align-items-center">

                                        <div class="">
                                {{loopIndex($items) + $loop->index}}
                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td data-label="@lang('Company')">@lang($item->title)</td>
                            <td data-label="@lang('Phone')">@lang($item->long_description)</td>
                            <td data-label="@lang('Phone')">@lang($item->rate)</td>
                            <td data-label="@lang('Tags')">@lang($item->unit)</td>
                            <td data-label="@lang('Assigned')">@lang($item->item_group)</td>

                            <td data-label="@lang('Status')">
                                <span
                                    class="custom-badge badge-pill {{ $item->status == 0 ? 'bg-danger' : 'bg-success' }}">{{ $item->status == 0 ? 'Inactive' : 'Active' }}</span>
                            </td>

                            @if(adminAccessRoute(config('role.manage_user.access.edit')))
                                <td data-label="@lang('Action')">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" onclick="editItem({{$item->id}})">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> @lang('Edit')
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.deleteItem',$item->id) }}">
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
                {{$items->appends(@$search)->links('partials.pagination')}}

            </div>
        </div>
    </div>


    <div class="modal fade" id="addNewItem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="{{route('admin.createItem')}}" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title">@lang('Add New Item')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Description</label>
                                <input type="text" class="form-control "
                                       name="description"
                                       value="{{ old('description') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the description
                                </div>
                                @if ($errors->has('description'))
                                    <span class="invalid-text">
                                                {{ $errors->first('description') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Long Description</label>
                                <textarea type="text" class="form-control "
                                       name="long_description"
                                          required="">{{ old('long_description') }}</textarea>
                                <div class="invalid-feedback">
                                    Please fill in the long description
                                </div>
                                @if ($errors->has('long_description'))
                                    <span class="invalid-text">
                                                {{ $errors->first('long_description') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Rate</label>
                                <input type="text" class="form-control "
                                       name="rate"
                                       value="{{ old('rate') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the rate
                                </div>
                                @if ($errors->has('rate'))
                                    <span class="invalid-text">
                                                {{ $errors->first('rate') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Unit</label>
                                <input type="text" class="form-control "
                                       name="unit"
                                       value="{{ old('unit') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the unit
                                </div>
                                @if ($errors->has('unit'))
                                    <span class="invalid-text">
                                                {{ $errors->first('unit') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Item Group</label>
                                <select name="item_group" class="form-control">
                                    <option value="1" >Product</option>
                                    <option value="2" >Service</option>

                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the unit
                                </div>
                                @if ($errors->has('unit'))
                                    <span class="invalid-text">
                                                {{ $errors->first('unit') }}
                                            </span>
                                @endif
                            </div>


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
    <div class="modal fade" id="editItem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" id="editItemForm" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title">@lang('Edit Item')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Description</label>
                                <input type="text" class="form-control "
                                       name="description"
                                       id="editDescription"
                                       value="{{ old('description') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the description
                                </div>
                                @if ($errors->has('description'))
                                    <span class="invalid-text">
                                                {{ $errors->first('description') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Long Description</label>
                                <textarea type="text" class="form-control "
                                       name="long_description"
                                       id="editLongDescription"
                                          required="">{{ old('long_description') }}</textarea>
                                <div class="invalid-feedback">
                                    Please fill in the long description
                                </div>
                                @if ($errors->has('long_description'))
                                    <span class="invalid-text">
                                                {{ $errors->first('long_description') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Rate</label>
                                <input type="text" class="form-control "
                                       name="rate"
                                       id="editRate"
                                       value="{{ old('rate') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the rate
                                </div>
                                @if ($errors->has('rate'))
                                    <span class="invalid-text">
                                                {{ $errors->first('rate') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Unit</label>
                                <input type="text" class="form-control "
                                       name="unit"
                                       id="editUnit"
                                       value="{{ old('unit') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the unit
                                </div>
                                @if ($errors->has('unit'))
                                    <span class="invalid-text">
                                                {{ $errors->first('unit') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Item Group</label>
                                <select id="editItemGroup" name="item_group" class="form-control">
                                    <option value="1" >Product</option>
                                    <option value="2" >Service</option>

                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the unit
                                </div>
                                @if ($errors->has('unit'))
                                    <span class="invalid-text">
                                                {{ $errors->first('unit') }}
                                            </span>
                                @endif
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

    <!-- Admin Login as a User Modal -->
    <div class="modal fade" id="signIn">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="" class="loginAccountAction" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title">@lang('Sing In Confirmation')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p>@lang('Are you sure to sign in this account?')</p>
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
        function editItem(id) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('admin.getItemInfo') }}",
                    type: "POST",
                    data: {
                        dataid:  id,
                    },
                    success: function (data) {
                        $('#editDescription').val(data.title)
                        $('#editLongDescription').val(data.long_description)
                        $('#editRate').val(data.rate)
                        $('#editUnit').val(data.unit)
                        $('#editItemGroup').val(data.item_group).trigger('change')
                        $('#editItemForm').attr('action','update-item/'+id);

                    },
                });
            $('#editItem').modal('show');
        }

        $('select').select2({
            selectOnClose: true,
            width: '100%'
        });

        $('.from_date').on('change', function (){
            $('.to_date').removeAttr('disabled');
        });

    </script>
@endpush
