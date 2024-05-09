@extends('admin.layouts.app')
@section('title')
    @lang("Invoice List")
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
                    <a class="btn btn-sm  btn-primary btn-rounded" type="button" href="{{route('admin.createInvoice')}}"
                    >@lang('Add New Invoice')</a>



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
                        <th scope="col">@lang('Invoice#')</th>
                        <th scope="col">@lang('Amount')</th>
                        <th scope="col">@lang('Discount Type')</th>
                        <th scope="col">@lang('Date')</th>
                        <th scope="col">@lang('Customer')</th>
                        <th scope="col">@lang('Tags')</th>
                        <th scope="col">@lang('Due Date')</th>
                        <th scope="col">@lang('Status')</th>
                        @if(adminAccessRoute(config('role.manage_user.access.edit')))
                            <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($invoices as $invoice)
                        <tr>
                            @if(adminAccessRoute(config('role.manage_user.access.edit')))
                                <td class="text-center">
                                    <input type="checkbox" id="chk-{{ $invoice->id }}"
                                           class="form-check-input row-tic tic-check" name="check" value="{{$invoice->id}}"
                                           data-id="{{ $invoice->id }}">
                                    <label for="chk-{{ $invoice->id }}"></label>
                                </td>
                            @endif
                            <td data-label="@lang('No.')">
                                <a href="{{route('admin.viewInvoice',[$invoice->id])}}" target="_blank">
                                    <div class="d-flex no-block align-items-center">

                                        <div class="">INV-{{loopIndex($invoices) + $loop->index}}
                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td data-label="@lang('Company')">@lang($invoice->subtotal)</td>
                            <td data-label="@lang('Phone')">@lang($invoice->discount_type)</td>
                            <td data-label="@lang('Phone')">@lang($invoice->date)</td>
                            <td data-label="@lang('Tags')">@lang($invoice->customer_id)</td>
                            <td data-label="@lang('Assigned')">@foreach($invoice->tags as $tag) @lang($tag) @endforeach</td>
                            <td data-label="@lang('Assigned')">@lang($invoice->due_date)</td>

                            <td data-label="@lang('Status')">
                                <span
                                    class="custom-badge badge-pill {{ $invoice->status == 0 ? 'bg-danger' : 'bg-success' }}">{{ $invoice->status == 0 ? 'Inactive' : 'Active' }}</span>
                            </td>

                            @if(adminAccessRoute(config('role.manage_user.access.edit')))
                                <td data-label="@lang('Action')">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{ route('admin.viewInvoice',$invoice->id) }}">
                                                <i class="fa fa-eye text-info pr-2"
                                                   aria-hidden="true"></i> @lang('View')
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.editInvoice',$invoice->id) }}">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> @lang('Edit')
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.deleteInvoice',$invoice->id) }}">
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
                {{$invoices->appends(@$search)->links('partials.pagination')}}

            </div>
        </div>
    </div>


    <div class="modal fade" id="addNewLead">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="{{route('admin.createLead')}}" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title">@lang('Add New Lead')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-4 col-4">
                                <label>Status</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="status"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="1">New</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the status
                                </div>
                                @if ($errors->has('status'))
                                    <span class="invalid-text">
                                                {{ $errors->first('status') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4 col-4">
                                <label>Source</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="source"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="1">New</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the source
                                </div>
                                @if ($errors->has('source'))
                                    <span class="invalid-text">
                                                {{ $errors->first('source') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4 col-4">
                                <label>Assigned User</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="assigned_user"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="1">New</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please fill in the assigned user
                                </div>
                                @if ($errors->has('assigned_user'))
                                    <span class="invalid-text">
                                                {{ $errors->first('assigned_user') }}
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Tags</label>
                                <select class="form-control  selectpicker currency-change"
                                        data-live-search="true" name="tags"
                                        required="">
                                    <option disabled selected>Nothing Selected</option>
                                    <option value="1">New</option>
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
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Name</label>
                                <input type="text" class="form-control "
                                       name="name"
                                       value="{{ old('name') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the payment method name
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-text">
                                                {{ $errors->first('name') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Address</label>
                                <input type="text" class="form-control "
                                       name="address"
                                       value="{{ old('address') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the address
                                </div>
                                @if ($errors->has('address'))
                                    <span class="invalid-text">
                                                {{ $errors->first('address') }}
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Position</label>
                                <input type="text" class="form-control "
                                       name="position"
                                       value="{{ old('position') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the payment method name
                                </div>
                                @if ($errors->has('position'))
                                    <span class="invalid-text">
                                                {{ $errors->first('position') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>City</label>
                                <input type="text" class="form-control "
                                       name="city"
                                       value="{{ old('city') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the address
                                </div>
                                @if ($errors->has('city'))
                                    <span class="invalid-text">
                                                {{ $errors->first('city') }}
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Email Address</label>
                                <input type="text" class="form-control "
                                       name="email_address"
                                       value="{{ old('email_address') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the email address
                                </div>
                                @if ($errors->has('email_address'))
                                    <span class="invalid-text">
                                                {{ $errors->first('email_address') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>State</label>
                                <input type="text" class="form-control "
                                       name="state"
                                       value="{{ old('state') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the address
                                </div>
                                @if ($errors->has('state'))
                                    <span class="invalid-text">
                                                {{ $errors->first('state') }}
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Website</label>
                                <input type="text" class="form-control "
                                       name="website"
                                       value="{{ old('website') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the website
                                </div>
                                @if ($errors->has('website'))
                                    <span class="invalid-text">
                                                {{ $errors->first('website') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Country</label>
                                <input type="text" class="form-control "
                                       name="country"
                                       value="{{ old('country') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the country
                                </div>
                                @if ($errors->has('country'))
                                    <span class="invalid-text">
                                                {{ $errors->first('country') }}
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Phone</label>
                                <input type="text" class="form-control "
                                       name="phone"
                                       value="{{ old('phone') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the phone
                                </div>
                                @if ($errors->has('phone'))
                                    <span class="invalid-text">
                                                {{ $errors->first('phone') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Zip Code</label>
                                <input type="text" class="form-control "
                                       name="zip_code"
                                       value="{{ old('zip_code') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the zip code
                                </div>
                                @if ($errors->has('zip_code'))
                                    <span class="invalid-text">
                                                {{ $errors->first('zip_code') }}
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Lead Value</label>
                                <input type="text" class="form-control "
                                       name="lead_value"
                                       value="{{ old('lead_value') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the lead value
                                </div>
                                @if ($errors->has('lead_value'))
                                    <span class="invalid-text">
                                                {{ $errors->first('lead_value') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label>Default Language</label>
                                <input type="text" class="form-control "
                                       name="language"
                                       value="{{ old('language') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the language
                                </div>
                                @if ($errors->has('language'))
                                    <span class="invalid-text">
                                                {{ $errors->first('language') }}
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label>Company</label>
                                <input type="text" class="form-control "
                                       name="company"
                                       value="{{ old('company') }}"  required="">
                                <div class="invalid-feedback">
                                    Please fill in the company
                                </div>
                                @if ($errors->has('company'))
                                    <span class="invalid-text">
                                                {{ $errors->first('company') }}
                                            </span>
                                @endif
                            </div>
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

        $('select').select2({
            selectOnClose: true,
            width: '100%'
        });

        $('.from_date').on('change', function (){
            $('.to_date').removeAttr('disabled');
        });

    </script>
@endpush
