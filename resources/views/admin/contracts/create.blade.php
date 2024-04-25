@extends('admin.layouts.app')

@section('title')
    @if(isset($contract))
        @lang("Edit Contract")

    @else

    @lang("Create Contract")
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
                        @if(isset($contract))
                            <form method="post" action="{{route('admin.updateContract',$contract->id)}}" enctype="multipart/form-data">

                        @else
                            <form method="post" action="{{route('admin.storeContract')}}" enctype="multipart/form-data">

                        @endif
                            @csrf

                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="row">

                                        <div class="form-group col-md-12 col-12" >
                                            <label>Customer</label>
                                            <select class="form-control  selectpicker currency-change"
                                                    data-live-search="true" id="customer_id" name="customer_id"
                                                    required="">
                                                <option disabled selected>Nothing Selected</option>
                                                @foreach($customers as $customer)
                                                    <option {{$customer->id == @$contract->customer_id ? 'selected' : ''}} value="{{$customer->id}}">{{$customer->fullname}}</option>

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
                                        <div class="form-group col-md-12 col-12">
                                            <label>Subject</label>
                                            <input type="text" class="form-control "
                                                   name="subject"
                                                   value="{{ isset($contract) ? $contract->subject : old('subject') }}"  required="">
                                            <div class="invalid-feedback">
                                                Please fill in the est no
                                            </div>
                                            @if ($errors->has('subject'))
                                                <span class="invalid-text">
                                                {{ $errors->first('subject') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Contract Value</label>
                                            <input type="text" class="form-control "
                                                   name="contract_value"
                                                   value="{{ isset($contract) ? $contract->contract_value : old('contract_value') }}"  required="">
                                            <div class="invalid-feedback">
                                                Please fill in the contract value
                                            </div>
                                            @if ($errors->has('contract_value'))
                                                <span class="invalid-text">
                                                {{ $errors->first('contract_value') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12 col-12" >
                                            <label>Contract Type</label>
                                            <select class="form-control  selectpicker currency-change"
                                                    data-live-search="true" id="contract_type" name="contract_type"
                                                    required="">
                                                <option disabled selected>Nothing Selected</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->fullname}}</option>

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
                                        <div class="form-group col-md-6 col-6">
                                            <label>Date</label>
                                            <input type="date" class="form-control "
                                                   name="issue_date"
                                                   value="{{ isset($contract) ? $contract->start_date :  old('issue_date') }}"  required="">
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
                                                   value="{{ isset($contract) ? $contract->end_date : old('open_till_date') }}"  required="">
                                            <div class="invalid-feedback">
                                                Please fill in the open till date
                                            </div>
                                            @if ($errors->has('open_till_date'))
                                                <span class="invalid-text">
                                                {{ $errors->first('open_till_date') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Description</label>
                                            <textarea type="text" class="form-control "
                                                      name="description"
                                                      id="description"
                                                      required="">{{isset($contract) ? $contract->description :  old('description') }}</textarea>
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
            var jsonData = document.getElementById("estimateItems").value;

            // Convert the existing JSON data to an array, or initialize an empty array if it's the first data
            var dataArray = jsonData != 'null' ? JSON.parse(jsonData) : [];

            dataArray.splice(id,1);
            document.getElementById("estimateItems").value = JSON.stringify(dataArray);
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
                var jsonData = document.getElementById("estimateItems").value;
                var dataArray = jsonData && jsonData != 'null' ? JSON.parse(jsonData) : [];

                var id = dataArray.length;
                dataArray.push(data);
                document.getElementById("estimateItems").value = JSON.stringify(dataArray);
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


    </script>
@endpush
