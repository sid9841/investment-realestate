@extends('admin.layouts.app')
@section('title')
    @lang("Proposal List")
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
                    <a class="btn btn-sm  btn-primary btn-rounded" type="button" href="{{route('admin.createProposal')}}"
                            >@lang('Add New Proposal')</a>


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
                        <th scope="col">@lang('Proposal#')</th>
                        <th scope="col">@lang('Subject')</th>
                        <th scope="col">@lang('To')</th>
                        <th scope="col">@lang('Total')</th>
                        <th scope="col">@lang('Date')</th>
                        <th scope="col">@lang('Open Till')</th>
                        <th scope="col">@lang('Tags')</th>
                            <th scope="col">@lang('Created')</th>

                        <th scope="col">@lang('Status')</th>
                        @if(adminAccessRoute(config('role.manage_user.access.edit')))
                            <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($proposals as $proposal)
                        <tr>
                            @if(adminAccessRoute(config('role.manage_user.access.edit')))
                                <td class="text-center">
                                    <input type="checkbox" id="chk-{{ $proposal->id }}"
                                           class="form-check-input row-tic tic-check" name="check" value="{{$proposal->id}}"
                                           data-id="{{ $proposal->id }}">
                                    <label for="chk-{{ $proposal->id }}"></label>
                                </td>
                            @endif
                            <td data-label="@lang('No.')">
                                <a href="{{route('admin.user-edit',[$proposal->id])}}" target="_blank">

                                Proposal-{{$proposal->id}}
                                </a>

                            </td>
                            <td data-label="@lang('Subject')">
                                    <div class="d-flex no-block align-items-center">

                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">@lang($proposal->subject)</h5>
                                        </div>
                                    </div>
                            </td>
                            <td data-label="@lang('Company')">@lang($proposal->proposal_to)</td>
                            <td data-label="@lang('Phone')">@lang($proposal->subtotal)</td>
                            <td data-label="@lang('Phone')">@lang($proposal->date)</td>
                            <td data-label="@lang('Tags')">@lang($proposal->open_till)</td>
                            <td data-label="@lang('Assigned')">@foreach($proposal->tags as $tg) @lang($tg) @endforeach</td>
                                <td data-label="@lang('Created')">{{$proposal->created_at}}</td>

                            <td data-label="@lang('Status')">
                                <span
                                    class="custom-badge badge-pill {{ $proposal->status == 0 ? 'bg-danger' : 'bg-success' }}">{{ $proposal->status == 0 ? 'Inactive' : 'Active' }}</span>
                            </td>

                            @if(adminAccessRoute(config('role.manage_user.access.edit')))
                                <td data-label="@lang('Action')">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{ route('admin.editProposal',$proposal->id) }}">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> @lang('Edit')
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.deleteProposal',$proposal->id) }}">
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
                {{$proposals->appends(@$search)->links('partials.pagination')}}

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
