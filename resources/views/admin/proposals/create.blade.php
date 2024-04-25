@extends('admin.layouts.app')

@section('title')
    @if(isset($proposal))
        @lang("Edit Proposal")
    @else
        @lang("Create Proposal")
    @endif

@endsection


@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <!-- Currency Create Form  -->
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        @if(isset($proposal))
                            <form method="post" action="{{route('admin.updateProposal',$proposal->id)}}" enctype="multipart/form-data">

                        @else
                            <form method="post" action="{{route('admin.storeProposal')}}" enctype="multipart/form-data">

                        @endif
                            @csrf

                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Subject</label>
                                            <input type="text" class="form-control "
                                                   name="subject"
                                                   value="{{ isset($proposal) ? $proposal->subject : old('subject') }}"  required="">
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
                                            <label>Related To</label>
                                            <select class="form-control  selectpicker currency-change"
                                                    data-live-search="true" id="related_to" name="related_to"
                                                    required="">
                                                <option readonly selected>Nothing Selected</option>
                                                <option value="1" {{@$proposal->related_to == 1 ? 'selected' : ''}}>Lead</option>
                                                <option value="2" {{@$proposal->related_to == 2 ? 'selected' : ''}}>Customer</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please fill in the related to
                                            </div>
                                            @if ($errors->has('related_to'))
                                                <span class="invalid-text">
                                                {{ $errors->first('related_to') }}
                                            </span>
                                            @endif
                                        </div>
                                            @php
                                                $display_leads= 'none';
                                                $display_customers= 'none';
                                                   if(isset($proposal)){
                                                       if ($proposal->related_to == 1){
                                                           $display_leads = 'block';
                                                       }
                                                       elseif ($proposal->related_to == 2){
                                                             $display_customers = 'block';
                                                       }
                                                   }

                                            @endphp
                                            <div class="form-group col-md-12 col-12" id="leads_div" style="display: {{$display_leads}};">
                                                <label>Leads</label>
                                                <select class="form-control  selectpicker currency-change"
                                                        data-live-search="true" id="leads" name="leads"
                                                        required="">
                                                    <option readonly selected>Nothing Selected</option>
                                                    @foreach($leads as $lead)
                                                        <option value="{{$lead->id}}">{{$lead->name}}</option>

                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill in the related to
                                                </div>
                                                @if ($errors->has('related_to'))
                                                    <span class="invalid-text">
                                                {{ $errors->first('related_to') }}
                                            </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-12 col-12" id="customers_div" style="display: {{$display_customers}};">
                                                <label>Customer</label>
                                                <select class="form-control  selectpicker currency-change"
                                                        data-live-search="true" id="customer_id" name="customer_id"
                                                        required="">
                                                    <option  >Nothing Selected</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{$customer->id}}" {{$customer->id == @$proposal->related_id ? 'selected' : ''}}>{{$customer->fullname}}</option>

                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill in the related to
                                                </div>
                                                @if ($errors->has('related_to'))
                                                    <span class="invalid-text">
                                                {{ $errors->first('related_to') }}
                                            </span>
                                                @endif
                                            </div>

                                            <div class="form-group col-md-6 col-6">
                                            <label>Date</label>
                                            <input type="date" class="form-control "
                                                   name="issue_date"
                                                   value="{{ isset($proposal) ? $proposal->date : old('issue_date') }}"  required="">
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
                                                   value="{{ isset($proposal) ? $proposal->open_till : old('open_till_date') }}"  required="">
                                            <div class="invalid-feedback">
                                                Please fill in the open till date
                                            </div>
                                            @if ($errors->has('open_till_date'))
                                                <span class="invalid-text">
                                                {{ $errors->first('open_till_date') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 col-6">
                                            <label>Currency</label>
                                            <select class="form-control  selectpicker currency-change"
                                                    data-live-search="true" name="currency_id"
                                                    required="">
                                                <option>Nothing Selected</option>
                                                <option value="1" {{@$proposal->currency_id == 1 ? 'selected' : ''}} >AUD</option>
                                                <option value="2" {{@$proposal->currency_id == 2 ? 'selected' : ''}}>EUR</option>
                                                <option value="3" {{@$proposal->currency_id == 3 ? 'selected' : ''}}>GBP</option>
                                                <option value="4" {{@$proposal->currency_id == 4 ? 'selected' : ''}}>USD</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please fill in the currency
                                            </div>
                                            @if ($errors->has('currency'))
                                                <span class="invalid-text">
                                                {{ $errors->first('currency') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 col-6">
                                            <label>Discount Type</label>
                                            <select class="form-control  selectpicker currency-change"
                                                    data-live-search="true" name="discount_type"
                                                    required="">
                                                <option readonly selected>Nothing Selected</option>
                                                <option value="Before Tax"  {{@$proposal->discount_type == 'Before Tax' ? 'selected' : ''}} >Before Tax</option>
                                                <option value="After Tax"  {{@$proposal->discount_type == 'After Tax' ? 'selected' : ''}}>After Tax</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please fill in the discount type
                                            </div>
                                            @if ($errors->has('discount_type'))
                                                <span class="invalid-text">
                                                {{ $errors->first('discount_type') }}
                                            </span>
                                            @endif
                                        </div>
                                         <div class="form-group col-md-12 col-12">
                                                    <label>Tags</label>
                                                    <select class="form-control tags-selectpicker currency-change"
                                                            data-live-search="true" name="tags[]" multiple
                                                            required="">
                                                        <option value="bug" {{isset($proposal) ? (in_array('bug',$proposal->tags) ? 'selected' : '') : ''}}>Bug</option>
                                                        <option value="follow-up" {{isset($proposal) ? (in_array('follow-up',$proposal->tags) ? 'selected' : '') : ''}}>follow-up</option>
                                                        <option value="important" {{isset($proposal) ? (in_array('important',$proposal->tags) ? 'selected' : '') : ''}}>important</option>
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
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">

                                        <div class="row">
                                            <div class="form-group col-md-6 col-6">
                                                <label>Status</label>
                                                <select class="form-control  selectpicker currency-change"
                                                        data-live-search="true" name="status"
                                                        required="">
                                                    <option readonly selected>Nothing Selected</option>
                                                    <option value="1" {{@$proposal->status == 1 ? 'selected' : ''}}>Draft</option>
                                                    <option value="2" {{@$proposal->status == 2 ? 'selected' : ''}}>Sent</option>
                                                    <option value="3" {{@$proposal->status == 3 ? 'selected' : ''}}>Open</option>
                                                    <option value="4" {{@$proposal->status == 4 ? 'selected' : ''}}>Done</option>
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
                                            <div class="form-group col-md-6 col-6">
                                                <label>Assigned To</label>
                                                <select class="form-control  selectpicker currency-change"
                                                        data-live-search="true" name="assigned_to"
                                                        required="">
                                                    <option readonly selected>Nothing Selected</option>
                                                    @foreach($admins as $admin)
                                                    <option value="{{$admin->id}}" {{@$proposal->assigned_to == $admin->id ? 'selected' : ''}}>{{$admin->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill in the assigned to
                                                </div>
                                                @if ($errors->has('assigned_to'))
                                                    <span class="invalid-text">
                                                {{ $errors->first('assigned_to') }}
                                            </span>
                                                @endif
                                            </div>

                                            <div class="form-group col-md-12 col-12">
                                                <label>To</label>
                                                <input type="text" class="form-control "
                                                       name="to_name"
                                                       id="to_name"
                                                       value="{{ isset($proposal) ? $proposal->proposal_to : old('to_name') }}"  required="">
                                                <div class="invalid-feedback">
                                                    Please fill in the tovname
                                                </div>
                                                @if ($errors->has('to_name'))
                                                    <span class="invalid-text">
                                            {{ $errors->first('to_name') }}
                                        </span>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 col-12">
                                                <label>Address</label>
                                                <textarea type="text" class="form-control "
                                                       name="address"
                                                       id="address"
                                                       required="">{{ isset($proposal) ? $proposal->address : old('address') }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please fill in the address
                                                </div>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-text">
                                            {{ $errors->first('address') }}
                                        </span>
                                                @endif
                                            </div>

                                            <div class="form-group col-md-6 col-6">
                                                <label>City</label>
                                                <input type="text" class="form-control "
                                                       name="city"
                                                       id="city"
                                                       value="{{ isset($proposal) ? $proposal->city : old('city') }}"  required="">
                                                <div class="invalid-feedback">
                                                    Please fill in the address
                                                </div>
                                                @if ($errors->has('city'))
                                                    <span class="invalid-text">
                                            {{ $errors->first('city') }}
                                        </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label>State</label>
                                                <input type="text" class="form-control "
                                                       name="state"
                                                       id="state"
                                                       value="{{ isset($proposal) ? $proposal->state : old('state') }}"  required="">
                                                <div class="invalid-feedback">
                                                    Please fill in the address
                                                </div>
                                                @if ($errors->has('state'))
                                                    <span class="invalid-text">
                                            {{ $errors->first('state') }}
                                        </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label>Zip Code</label>
                                                <input type="text" class="form-control "
                                                       name="zip_code"
                                                       id="zip_code"
                                                       value="{{ isset($proposal) ? $proposal->zip_code : old('zip_code') }}"  required="">
                                                <div class="invalid-feedback">
                                                    Please fill in the zip code
                                                </div>
                                                @if ($errors->has('zip_code'))
                                                    <span class="invalid-text">
                                            {{ $errors->first('zip_code') }}
                                        </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label>Country</label>
                                                <input type="text" class="form-control "
                                                       name="country"
                                                       id="country"
                                                       value="{{ isset($proposal) ? $proposal->country : old('country') }}"  required="">
                                                <div class="invalid-feedback">
                                                    Please fill in the country
                                                </div>
                                                @if ($errors->has('country'))
                                                    <span class="invalid-text">
                                            {{ $errors->first('country') }}
                                        </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label>Email Address</label>
                                                <input type="text" class="form-control "
                                                       name="email_address"
                                                       id="email_address"
                                                       value="{{ isset($proposal) ? $proposal->email : old('email_address') }}"  required="">
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
                                                <label>Phone</label>
                                                <input type="text" class="form-control "
                                                       name="phone"
                                                       id="phone"
                                                       value="{{ isset($proposal) ? $proposal->phone : old('phone') }}"  required="">
                                                <div class="invalid-feedback">
                                                    Please fill in the phone
                                                </div>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-text">
                                            {{ $errors->first('phone') }}
                                        </span>
                                                @endif
                                            </div>
                                        </div>



                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive s_table">
                                            <input type="hidden" name="proposalItems" value="{{json_encode(@$proposal->items)}}" id="proposalItems">
                                            <div class="col-md-4 mb-4">
                                            <select class="form-control  selectpicker currency-change" id="itemsList">
                                                <option>Select Item to Add</option>
                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <table class="table estimate-items-table items table-main-estimate-edit has-calculations no-mtop">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th width="20%" align="left"><i class="fa-solid fa-circle-exclamation tw-mr-1" aria-hidden="true" data-toggle="tooltip" data-title="New lines are not supported for item description. Use the item long description instead."></i>
                                                        Item</th>
                                                    <th width="25%" align="left">Description</th>
                                                    <th width="15%" align="right">Rate</th>
                                                    <th width="15%" align="right">Quantity</th>
                                                    <th width="20%" align="right">Tax</th>
                                                    <th width="10%" align="right">Amount</th>
                                                    <th align="center"><i class="fa fa-cog"></i></th>
                                                </tr>
                                                </thead>
                                                <tbody class="ui-sortable" id="itemTableBody">
                                                    <tr class="main" id="addItemForm">
                                                    <td></td>
                                                    <td>
                                                        <textarea id="description" rows="4" class="form-control" placeholder="Description"></textarea>
                                                    </td>
                                                    <td>
                                                        <textarea id="long_description" rows="4" class="form-control" placeholder="Long description"></textarea>
                                                    </td>

                                                    <td>
                                                        <input type="number" id="rate" class="form-control" placeholder="Rate">
                                                    </td>
                                                    <td>
                                                        <input type="number" id="quantity" class="form-control" placeholder="Quantity">
                                                    </td>
                                                    <td>
                                                        <select class="form-select" id="tax">
                                                            <option value="0" >No Tax</option>
                                                            <option value="1" >5.00%</option>
                                                            <option value="2" >10.00%</option>
                                                            <option value="3" >18.00%</option>
                                                        </select>
                                                    <td id="amount">

                                                    </td>
                                                    <td>
                                                        <button type="button" id="addItemToTable" class="btn pull-right btn-primary"><i class="fa fa-check"></i></button>
                                                    </td>
                                                </tr>
                                                    @if(isset($proposal))
                                                        @foreach($proposal->items as $item)
                                                            <tr>
                                                                <td></td>
                                                                <td>{{$item['item_name']}}</td>
                                                                <td>{{$item['item_description']}}</td>
                                                                <td>{{$item['amount']}}</td>
                                                                <td>{{$item['qty']}}</td>
                                                                <td>{{$item['tax_type']}}</td>
                                                                <td>{{$item['amount'] * $item['qty']}}</td>
                                                                <td><a href="#" class="btn btn-primary" id="item-{{$loop->index}}" onclick="delete_item({{$loop->index}});return false;">Delete</a></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>

                                        </div>

                                    </div>
                                    <div class="col-md-8 offset-4">
                                        <table class="table text-right">
                                            <tbody>
                                            <tr>
                                                <td><span class="bold tw-text-neutral-700">Sub Total :</span>
                                                </td>
                                                <td class="subtotal" ><input type="text" value="{{@$proposal->subtotal}}" name="subtotal" readonly id="subtotal"></td>
                                            </tr>
                                            <tr id="discount_area">
                                                <td>
                                                            <span class="bold tw-text-neutral-700">Discount:</span>
                                                    </td>
                                                <td class="discount-total">

                                                            <input type="number" value="{{@$proposal->discount}}" class="" min="0"  id="discount_percent" name="discount_percent">


                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="bold tw-text-neutral-700">Total :</span>
                                                </td>
                                                <td class="total" ><input readonly value="{{@$proposal->subtotal - @$proposal->discount}}" type="text" id="total"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('Close')</span>
                                </button>
                                <button type="submit" class=" btn btn-primary "><span>@lang('Submit')</span>
                                </button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---Container Fluid-->




@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/summernote.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link href="{{ asset('assets/admin/css/bootstrap-iconpicker.min.css') }}" rel="stylesheet" type="text/css">
@endpush


@push('js-lib')
    <script src="{{ asset('assets/admin/js/summernote.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush

@push('js')
    <script>
        function delete_item(id){
            console.log(id);
            var jsonData = document.getElementById("proposalItems").value;

            // Convert the existing JSON data to an array, or initialize an empty array if it's the first data
            var dataArray = jsonData != 'null' ? JSON.parse(jsonData) : [];

            dataArray.splice(id,1);
            document.getElementById("proposalItems").value = JSON.stringify(dataArray);
            $("#item-"+id).closest("tr").remove();
            return false;
        }
        'use strict'

        $(document).ready(function () {
            $('#related_to').change(function (){
                if($('#related_to').val() == 1){
                    $('#leads_div').show();
                    $('#customers_div').hide();

                }
                else{
                    $('#customers_div').show();
                    $('#leads_div').hide();

                }
               console.log($('#related_to').val())
            });
            $('#addItemToTable').click(function (){
                var item_name = $('#description').val();
                var item_description = $('#long_description').val();
                var rate = $('#rate').val();
                var qty = $('#quantity').val();
                var tax = $('#tax').val();
                var data = {
                    'item_name': item_name,
                    'item_description': item_description,
                    'rate': rate,
                    'qty': qty,
                    'tax': tax,
                }
                var jsonData = document.getElementById("proposalItems").value;
                var dataArray = jsonData && jsonData != 'null' ? JSON.parse(jsonData) : [];

                var id = dataArray.length;
                dataArray.push(data);
                document.getElementById("proposalItems").value = JSON.stringify(dataArray);
                var html = '<tr>' +
                    '<td></td>' +
                    '<td>'+item_name+'</td>' +
                    '<td>'+item_description+'</td>' +
                    '<td>'+rate+'</td>' +
                    '<td>'+qty+'</td>' +
                    '<td>'+tax+'</td>' +
                    '<td>'+rate*qty+'</td>' +
                    '<td><a href="#" class="btn btn-primary" id="item-'+id+'" onclick="delete_item('+id+');return false;">Delete</a></td>' +
                    '</tr>';
                $('#itemTableBody').append(html);
                var subtotal = 0;
                dataArray.forEach(function (element) {
                    console.log(element)
                        subtotal += element.qty * element.rate;
                    }

                )
                $('#subtotal').val(subtotal);
                var discount =  $('#discount_percent').val();
                $('#total').val(subtotal-discount);

            });

            $('#discount_percent').keyup(function (){
                console.log()
               var subtotal =  $('#subtotal').val();
                var discount =  $('#discount_percent').val();
                $('#total').val(subtotal-discount);
            });
            $('.summernote').summernote({
                minHeight: 200,
                callbacks: {
                    onBlurCodeview: function() {
                        let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                        $(this).val(codeviewHtml);
                    }
                }
            });
            $('#customer_id').change(function (e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('admin.getCustomerInfo') }}",
                    type: "POST",
                    data: {
                        dataid:  $('#customer_id').val(),
                    },
                    success: function (data) {
                        $('#to_name').val(data.firstname + ' ' + data.lastname)
                        $('#address').val(data.address)
                        $('#city').val(data.city)
                        $('#state').val(data.state)
                        $('#zip_code').val(data.zip_code)
                        $('#country').val(data.country_code)
                        $('#email').val(data.email)
                        $('#phone').val(data.phone)
                    },
                });
            });

            $('.iconPicker').iconpicker({
                align: 'center', // Only in div tag
                arrowClass: 'btn-danger',
                arrowPrevIconClass: 'fas fa-angle-left',
                arrowNextIconClass: 'fas fa-angle-right',
                cols: 10,
                footer: true,
                header: true,
                icon: 'fas fa-bomb',
                iconset: 'fontawesome5',
                labelHeader: '{0} of {1} pages',
                labelFooter: '{0} - {1} of {2} icons',
                placement: 'bottom', // Only in button tag
                rows: 5,
                search: true,
                searchText: 'Search icon',
                selectedClass: 'btn-success',
                unselectedClass: ''
            }).on('change', function (e) {
                $(this).parent().siblings('.icon').val(`${e.icon}`);
            });
        });
        $('.tags-selectpicker').select2({
            width: '100%',
            placeholder: '@lang("Select Tags")',
        });
        $('#itemsList').on('change',function (){
            var id = $('#itemsList').val();
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
                    $('#description').val(data.title)
                    $('#long_description').val(data.long_description)
                    $('#rate').val(data.rate)
                    $('#quantity').val(1)

                },
            });
        });

    </script>
@endpush
