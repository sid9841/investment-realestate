@extends('admin.layouts.app')
@section('title')
    @lang($contract->subject)
@endsection

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <!-- Currency Create Form  -->
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>Contract for {{$contract->subject}}</h3>
                               <p class="mt-4">{!! $contract->description !!}</p>
                            </div>
                            <div class="col-md-4">
                                <div role="tabpanel" class="tab-pane active" id="summary">

                                    <p class="bold proposal-html-information tw-text-neutral-700">
                                        To              </p>
                                    <address class="tw-mb-0 proposal-html-info tw-text-neutral-500 tw-text-normal">
                                        <b>{{$contract->customer->firstname. ' '. $contract->customer->lastname}}</b><br> {{$contract->customer->address}}<br> {{$contract->customer->country_code}}<br> <a href="tel:{{$contract->customer->phone}}">{{$contract->customer->phone}}</a><br> <a href="mailto:{{$contract->customer->email}}">{{$contract->customer->email}}</a>                        </address>
                                    <div class="row mtop20">
                                        <div class="tw-text-normal col-md-12 proposal-html-total">
                                            <h4 class="bold tw-mb-3">
                                                Contract Value {{ $basic->currency_symbol }} {{$contract->contract_value}}                </h4>
                                        </div>
                                        <div class="tw-text-normal col-md-6 text-muted proposal-status">
                                            Status                            </div>
                                        <div class="tw-text-normal col-md-6 proposal-status tw-text-neutral-700">
                                            {{$contract->status}}                            </div>
                                        <div class="tw-text-normal col-md-6 text-muted proposal-date">
                                            Contract Date                            </div>
                                        <div class="tw-text-normal col-md-6 proposal-date tw-text-neutral-700">
                                            {{$contract->start_date}}                            </div>
                                        <div class="tw-text-normal col-md-6 text-muted proposal-open-till">
                                            End Date                         </div>
                                        <div class="tw-text-normal col-md-6 proposal-open-till tw-text-neutral-700">
                                            {{$contract->end_date}}                                    </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
