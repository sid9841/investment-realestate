@extends('admin.layouts.app')
@section('title')
    @lang($invoice->subject)
@endsection

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <!-- Currency Create Form  -->
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Invoice #{{$invoice->invoice_no}}</h3>
                            </div>
                            <div class="col-md-6">
                                <div role="tabpanel" class="tab-pane active" id="summary">

                                    <p class="bold proposal-html-information tw-text-neutral-700">
                                        To              </p>
                                    <address class="tw-mb-0 proposal-html-info tw-text-neutral-500 tw-text-normal">
                                        <b>{{$invoice->customer->firstname. ' '. $invoice->customer->lastname}}</b><br> {{$invoice->customer->address}}<br> {{$invoice->customer->country_code}}<br> <a href="tel:{{$invoice->customer->phone}}">{{$invoice->customer->phone}}</a><br> <a href="mailto:{{$invoice->customer->email}}">{{$invoice->customer->email}}</a>                        </address>
                                    <div class="row mtop20">
                                        <div class="tw-text-normal col-md-12 proposal-html-total">
                                            <h4 class="bold tw-mb-3">
                                                Total {{ $basic->currency_symbol }} {{$invoice->subtotal - $invoice->discount}}                </h4>
                                        </div>
                                        <div class="tw-text-normal col-md-4 text-muted proposal-status">
                                            Status                            </div>
                                        <div class="tw-text-normal col-md-8 proposal-status tw-text-neutral-700">
                                            {{$invoice->status}}                            </div>
                                        <div class="tw-text-normal col-md-4 text-muted proposal-date">
                                            Invoice Date                            </div>
                                        <div class="tw-text-normal col-md-8 proposal-date tw-text-neutral-700">
                                            {{$invoice->date}}                            </div>
                                        <div class="tw-text-normal col-md-4 text-muted proposal-open-till">
                                            Due Date                         </div>
                                        <div class="tw-text-normal col-md-8 proposal-open-till tw-text-neutral-700">
                                            {{$invoice->due_date}}                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table items items-preview no-margin proposal-items-preview" data-type="proposal">
                                        <thead>
                                        <tr>
                                            <th align="center">#</th>
                                            <th class="description" width="38%" align="left">Item</th>
                                            <th align="right">Qty</th><th align="right">Rate</th>
                                            <th align="right">Tax</th>
                                            <th align="right">Amount</th></tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($invoice))
                                            @foreach($invoice->items as $item)
                                                <tr>
                                                    <td></td>
                                                    <td>{{$item['item_name']}}<br>
                                                        {{$item['item_description']}}</td>
                                                    <td>{{$item['qty']}}</td>
                                                    <td>{{ $basic->currency_symbol }} {{$item['amount']}}</td>
                                                    <td>{{$item['tax_type']}}</td>
                                                    <td>{{ $basic->currency_symbol }} {{$item['amount'] * $item['qty']}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-md-8 offset-4">
                                    <table class="table text-right">
                                        <tbody>
                                        <tr>
                                            <td><span class="bold tw-text-neutral-700">Sub Total :</span>
                                            </td>
                                            <td class="subtotal" >{{ $basic->currency_symbol }} {{@$invoice->subtotal}}</td>
                                        </tr>
                                        <tr id="discount_area">
                                            <td>
                                                <span class="bold tw-text-neutral-700">Discount:</span>
                                            </td>
                                            <td class="discount-total">

                                                {{ $basic->currency_symbol }} {{@$invoice->discount}}


                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="bold tw-text-neutral-700">Total :</span>
                                            </td>
                                            <td class="total" >{{ $basic->currency_symbol }} {{@$invoice->subtotal - @$invoice->discount}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
