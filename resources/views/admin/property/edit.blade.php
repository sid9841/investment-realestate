@extends('admin.layouts.app')
@section('title')
    @lang('Edit a Property')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media justify-content-end">
                <a href="{{route('admin.propertyList',['all'])}}" class="btn btn-sm  btn-primary btn-rounded mr-2">
                    <span><i class="fas fa-arrow-left"></i> @lang('Back')</span>
                </a>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($languages as $key => $language)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }} language_tab" data-toggle="tab"
                           href="#lang-tab-{{ $key }}" role="tab" aria-controls="lang-tab-{{ $key }}"
                           aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-languageid="{{ $language->id }}">@lang($language->name)</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-5" id="myTabContent">
                @foreach($languages as $key => $language)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-tab-{{ $key }}"
                         role="tabpanel">
                        <form method="post" action="{{route('admin.propertyUpdate', [$id, $language->id])}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card">
                                <div class="card-header text-primary">
                                    <li><span class="propertyDetailsLabel">@lang('Update Property Details')</span></li>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>@lang('Title') <span class="text-danger">*</span></label>
                                                <input type="text" name="property_title[{{ $language->id }}]"
                                                       value="<?php echo old('property_title'.$language->id, isset($singlePropertyDetails[$language->id]) ? $singlePropertyDetails[$language->id][0]->property_title : '') ?>"
                                                       class="form-control">
                                                @error('property_title'.'.'.$language->id)
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if ($loop->index == 0)
                                            <div class="col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label class="">@lang('Address') <span
                                                            class="text-danger">*</span></label>
                                                    <select name="address_id" class="form-control  type addressList">
                                                        @foreach($allAddress as $address)
                                                            <option
                                                                value="{{ $address->id }}" {{ optional($singlePropertyDetails[$language->id][0]->manageProperty)->address_id == $address->id ? 'selected' : '' }}>@lang(optional($address->details)->title)</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('address_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-lg-3">
                                                <div class="form-group">
                                                    <label>@lang('Location')</label>
                                                    <input type="text" name="location"
                                                           value="{{ $singlePropertyDetails[$language->id][0]->manageProperty->location }}"
                                                           class="form-control @error('location') is-invalid @enderror">
                                                    @error('location')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <label for="before_expiry_date"> @lang('Amenities')</label>
                                                <select name="amenity_id[]"
                                                        class="form-control propertyAmenities @error('amenity_id') is-invalid @enderror"
                                                        multiple>
                                                    <option disabled>@lang('Choose items')</option>
                                                    @foreach($allAmenities as $amenity)
                                                        <option
                                                            value="{{ $amenity->id }}" {{ in_array($amenity->id, $singlePropertyDetails[$language->id][0]->manageProperty->amenity_id) ? 'selected' : '' }}>@lang(optional($amenity->details)->title)</option>
                                                    @endforeach
                                                </select>
                                                @error('amenity_id')
                                                <span class="text-danger">@lang($message)</span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
{{--                                    <div class="row mt-4">--}}
{{--                                        <div class="col-md-12 col-xl-12">--}}
{{--                                            <label for="before_expiry_date"> @lang('Enable Drip')</label>--}}
{{--                                            @php--}}
{{--                                                $available_for =$singlePropertyDetails[1][0]->manageProperty->available_for;--}}
{{--                                            @endphp--}}
{{--                                            <select name="available_for[]"--}}
{{--                                                    class="form-control propertyAvailableFor @error('available_for') is-invalid @enderror"--}}
{{--                                                    multiple>--}}
{{--                                                <option disabled>@lang('Choose available for')</option>--}}
{{--                                                @foreach($allBadges as $badges)--}}
{{--                                                    <option--}}
{{--                                                        value="{{ $badges->id }}" {{in_array($badges->id,$available_for) ? 'selected' : ''}}>@lang(optional($badges->details)->rank_name)</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            @error('available_for')--}}
{{--                                            <span class="text-danger">@lang($message)</span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    @php
                                      $drip_enabled = $singlePropertyDetails[1][0]->manageProperty->drip_enabled;
                                      $dripDB = [];
                                    @endphp
                                    <div class="row mt-4">
                                        <div class="col-md-12 col-xl-12">
                                            <label for="before_expiry_date"> @lang('Enable Drip')</label>
                                            <input type="checkbox" id="enable_drip" {{$drip_enabled == true ? 'checked' : ''}}  name="drip_enabled">
                                            @error('drip_enabled')
                                            <span class="text-danger">@lang($message)</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-4" id="drip_content_div" style="display:{{$drip_enabled == true ? 'block' : 'none'}}">
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>@lang('Start Date') <span class="text-danger">*</span></label>
                                                        <input type="date" name="drip_start_date" id="drip_start_date"
                                                               value="{{ old('drip_start_date') }}"
                                                               class="form-control @error('drip_start_date'.'.'.$language->id) is-invalid @enderror">
                                                        @error('drip_start_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label>@lang('End Date') <span class="text-danger">*</span></label>
                                                        <input type="date" name="drip_end_date" id="drip_end_date"
                                                               value="{{ old('drip_end_date') }}"
                                                               class="form-control @error('drip_end_date'.'.'.$language->id) is-invalid @enderror">
                                                        @error('drip_end_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="available_for"> @lang('Drip Available For')</label>

                                                        <select name="available_for[]"
                                                                id="drip_available_for"
                                                                class="form-control propertyAvailableFor @error('available_for') is-invalid @enderror"
                                                                multiple>
                                                            <option disabled>@lang('Choose available for')</option>
                                                            @foreach($allBadges as $badges)
                                                                <option
                                                                    value="{{ $badges->id }}" >@lang(optional($badges->details)->rank_name)</option>
                                                            @endforeach
                                                        </select>
                                                        @error('available_for')
                                                        <span class="text-danger">@lang($message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group align-content-center">
                                                        <button class="btn btn-primary mt-4 " id="add_drip">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class=" table table-hover table-striped table-bordered text-center" id="dripContentTable">
                                                <tr>
                                                    <td>
                                                        Start Date
                                                    </td>
                                                    <td>
                                                        End Date
                                                    </td>
                                                    <td>Available For</td>
                                                </tr>
                                                @foreach($singlePropertyDetails[1][0]->manageProperty->drips as $pDrip)
                                                    <tr>
                                                        <td>
                                                            {{$pDrip->start_date}}
                                                        </td>
                                                        <td>
                                                            {{$pDrip->end_date}}
                                                        </td>
                                                        <td>{{$pDrip->available_for->pluck('badge_id')}}</td>
                                                        <td><a href="#" class="btn btn-primary" id="drip_contents-{{$loop->index}}" onclick="delete_drip_body({{$loop->index}});return false;">Delete</a></td>
                                                    </tr>
                                                    @php
                                                        $dripDB[] = ['start_date'=>$pDrip->start_date,'end_date'=>$pDrip->end_date,'available_for'=>$pDrip->available_for->pluck('badge_id')];
                                                    @endphp
                                                @endforeach



                                            </table>
                                            <input type="hidden" name="drip_contents_value" value="{{json_encode($dripDB)}}" id="drip_contents_value">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-xl-12 col-12 property__details">
                                            <div class="form-group">
                                                <label for="details"> @lang('Details') </label>
                                                <textarea
                                                    class="form-control summernote @error('details'.'.'.$language->id) is-invalid @enderror"
                                                    name="details[{{ $language->id }}]" id="summernote" rows="15"
                                                    value="<?php echo old('details'.$language->id, isset($singlePropertyDetails[$language->id]) ? $singlePropertyDetails[$language->id][0]->details : '') ?>">{{ @$singlePropertyDetails[$language->id][0]->details }}</textarea>
                                                @error('details')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if ($loop->index == 0)
                                            <div class="col-md-5 col-xl-5 col-12">
                                                <div class="form-group">
                                                    <label for="thumbnail">{{ ('Thumbnail') }}</label>
                                                    <div class="image-input property_image_input">
                                                        <label for="image-upload" id="image-label"><i
                                                                class="fas fa-upload"></i></label>
                                                        <input type="file" name="thumbnail"
                                                               placeholder="@lang('Choose image')"
                                                               id="image"
                                                               class="form-control @error('thumbnail') is-invalid @enderror">
                                                        <img id="image_preview_container" class="preview-image"
                                                             src="{{ asset(getFile(config('location.propertyThumbnail.path').(isset($singlePropertyDetails[$language->id]) ? @$singlePropertyDetails[$language->id][0]->manageProperty->thumbnail : ''))) }}"
                                                             alt="@lang('preview image')">
                                                    </div>
                                                    @error('thumbnail')
                                                    <span class="text-danger">@lang($message)</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-7 col-xl-7 col-12">
                                                <div class="form-group" id="tab3">
                                                    <label for="details"> @lang('Property Galary Images') </label>
                                                    <div class="property-image"></div>
                                                    @error('property_image.*')
                                                    <span class="text-danger">@lang($message)</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>@lang('Video Url')</label>
                                                    <input type="text" name="video" value="{{old('video', $singlePropertyDetails[$language->id][0]->manageProperty->video)}}"
                                                           placeholder="@lang('only iframe embed url accepted')"
                                                           class="form-control @error('video') is-invalid @enderror">
                                                    @error('video')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-xl-4">
                                                <div class="form-group">
                                                    <label>@lang('Is Featured Property?') (<span class="text-primary font-14">@lang('For available also home page')</span>)</label>
                                                    <div class="custom-switch-btn">
                                                        <input type='hidden' value='1'
                                                               name="is_featured" {{ old('is_featured', $singlePropertyDetails[$language->id][0]->manageProperty->is_featured) == "1" ? 'checked' : '' }}>
                                                        <input type="checkbox" name="is_featured" id="is_featured"
                                                               class="custom-switch-checkbox"
                                                               value="0" {{ old('is_featured', $singlePropertyDetails[$language->id][0]->manageProperty->is_featured) == "0" ? 'checked' : '' }}>
                                                        <label class="custom-switch-checkbox-label" for="is_featured">
                                                            <span class="custom-switch-checkbox-for-installments"></span>
                                                            <span class="custom-switch-checkbox-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-xl-4">
                                                <div class="form-group">
                                                    <label>@lang('Can investors see property available funds for investment?')</label>
                                                    <div class="custom-switch-btn">
                                                        <input type='hidden' value='1'
                                                               name="is_available_funding" {{ old('is_available_funding', $singlePropertyDetails[$language->id][0]->manageProperty->is_available_funding) == "1" ? 'checked' : '' }}>
                                                        <input type="checkbox" name="is_available_funding" id="is_available_funding"
                                                               class="custom-switch-checkbox"
                                                               value="0" {{ old('is_available_funding', $singlePropertyDetails[$language->id][0]->manageProperty->is_available_funding) == "0" ? 'checked' : '' }}>
                                                        <label class="custom-switch-checkbox-label" for="is_available_funding">
                                                            <span class="custom-switch-checkbox-for-installments"></span>
                                                            <span class="custom-switch-checkbox-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 col-xl-6 mt-4 mb-3 pl-2 pr-2 pt-1 pb-1 ml-2">
                                            <a href="javascript:void(0)" class="btn btn-primary btn-rounded generate" data-lang="{{$language->id}}"><i class="fa fa-plus-circle"></i> @lang('Add FAQ')</a>
                                        </div>
                                    </div>

                                    @if(!empty($singlePropertyDetails[$language->id][0]->faq))
                                        @foreach($singlePropertyDetails[$language->id][0]->faq as $key => $value)
                                            <div class="row">
                                                <div class="col-md-12 col-log-12 col-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input name="faq_title[]"
                                                                   class="form-control" type="text"
                                                                   value="{{ @$value->field_name }}">
                                                            <textarea class="form-control" name="faq_details[]" rows="1"
                                                                      placeholder="@lang('Answer')">{{ @$value->field_value }}</textarea>
                                                            <span class="input-group-btn">
                                                            <button class="btn btn-danger delete_desc" type="button">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    @php
                                        $maxNum = old('faq_title') && old('faq_details') ? max(count(old('faq_title')), count(old('faq_details'))) : (old('faq_title') && !old('faq_details') ? count(old('faq_title')) : (!old('faq_title') && old('faq_details') ? count(old('faq_title')) : 0));
                                    @endphp

                                    <div class="row addedField{{ $language->id }}">
                                        @for($i = 0; $i < $maxNum; $i++)
                                            <div class="col-md-12 col-log-12 col-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input name="faq_title[]" class="form-control" type="text"
                                                               value="{{ old('faq_title.'.$i) }}"
                                                               placeholder="{{trans('question')}}">
                                                        <textarea class="form-control" name="faq_details[]"
                                                                  id="summernote" rows="1"
                                                                  placeholder="@lang('Answer')">{{ old('faq_details.'.$i) }}</textarea>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-danger delete_desc" type="button">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>

                                </div>
                            </div>

                            @if ($loop->index == 0)
                                <div class="card">
                                    <div class="card-header text-primary">
                                        <li><span class="propertyDetailsLabel"> @lang('Add Investment Details')</span></li>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Invest Type')</label>
                                                    <div class="custom-switch-btn">
                                                        <input type='hidden' value='1'
                                                               name="is_invest_type" {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "1" ? 'checked' : '' }}>
                                                        <input type="checkbox" name="is_invest_type" id="is_invest_type"
                                                               class="custom-switch-checkbox"
                                                               value="0" {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" ? 'checked' : '' }}>
                                                        <label class="custom-switch-checkbox-label" for="is_invest_type">
                                                            <span class="custom-switch-checkbox-for-investType"></span>
                                                            <span class="custom-switch-checkbox-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xl-3 fixedAmount {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" ? 'd-block' : 'd-none' }}">
                                                <div class="form-group">
                                                    <label>@lang('Fixed Invest Amount')</label>
                                                    <div class="input-group">
                                                        <input type="text" name="fixed_amount"
                                                               class="form-control @error('fixed_amount') is-invalid @enderror"
                                                               placeholder="0.00" value="{{ old('fixed_amount', $singlePropertyDetails[$language->id][0]->manageProperty->fixed_amount) }}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                               id="fixedAmount"
                                                               autocomplete="off">
                                                        <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                                        </div>
                                                    </div>
                                                    @error('fixed_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3 rangeAmount {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" ? 'd-none' : '' }} ">
                                                <div class="form-group">
                                                    <label>@lang('Minimum Invest Amount')</label>
                                                    <div class="input-group">
                                                        <input type="text" name="minimum_amount"
                                                               class="form-control @error('minimum_amount') is-invalid @enderror"
                                                               placeholder="0.00" value="{{ old('minimum_amount', $singlePropertyDetails[$language->id][0]->manageProperty->minimum_amount) }}"
                                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                                        <div class="input-group-append">
                                                <span
                                                    class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                                        </div>
                                                    </div>
                                                    @error('minimum_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3 rangeAmount {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" ? 'd-none' : '' }}">
                                                <div class="form-group">
                                                    <label>@lang('Maximum Invest Amount')</label>
                                                    <div class="input-group">
                                                        <input type="text" name="maximum_amount"
                                                               class="form-control @error('maximum_amount') is-invalid @enderror"
                                                               placeholder="0.00" value="{{ old('maximum_amount', $singlePropertyDetails[$language->id][0]->manageProperty->maximum_amount) }}"
                                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                                        <div class="input-group-append">
                                                <span
                                                    class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                                        </div>
                                                    </div>
                                                    @error('maximum_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Need Total Invest Amount')</label>
                                                    <div class="input-group">
                                                        <input type="text" name="total_investment_amount"
                                                               class="form-control @error('total_investment_amount') is-invalid @enderror"
                                                               placeholder="0.00"
                                                               value="{{ old('total_investment_amount', $singlePropertyDetails[$language->id][0]->manageProperty->total_investment_amount) }}"
                                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                                        <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                                        </div>
                                                    </div>
                                                    @error('total_investment_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Profit Range')</label>
                                                    <div class="input-group">
                                                        <input type="text" name="profit"
                                                               class="form-control @error('profit') is-invalid @enderror"
                                                               placeholder="0.00" value="{{ old('profit', $singlePropertyDetails[$language->id][0]->manageProperty->profit) }}">
                                                        <div class="input-group-append">
                                                            <select name="profit_type" id="profit_type"
                                                                    class="form-control">
                                                                <option value="1" {{ $singlePropertyDetails[$language->id][0]->manageProperty->profit_type == 1 ? 'selected' : '' }}>%</option>
                                                                <option
                                                                    value="0" {{ $singlePropertyDetails[$language->id][0]->manageProperty->profit_type == 0 ? 'selected' : '' }}>@lang(config('basic.currency_symbol'))</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @error('profit')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3 acceptInstallments {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" ? '' : 'd-none' }}">
                                                <div class="form-group">
                                                    <label>@lang('Accept Installments')</label>
                                                    <div class="custom-switch-btn">
                                                        <input type='hidden' value='1'
                                                               name="is_installment" {{ old('is_installment', $singlePropertyDetails[$language->id][0]->manageProperty->is_installment) == "1" ? 'checked' : ''}}>
                                                        <input type="checkbox" name="is_installment" id="is_installment"
                                                               class="custom-switch-checkbox"
                                                               value="0" {{ old('is_installment', $singlePropertyDetails[$language->id][0]->manageProperty->is_installment) == "0" ? 'checked' : ''}}>
                                                        <label class="custom-switch-checkbox-label" for="is_installment">
                                                            <span class="custom-switch-checkbox-for-installments"></span>
                                                            <span class="custom-switch-checkbox-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3 installmentField {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" && old('is_installment', $singlePropertyDetails[$language->id][0]->manageProperty->is_installment) == "1" ? '' : 'd-none' }}">
                                                <div class="form-group">
                                                    <label>@lang('Total Installments')</label>
                                                    <div class="input-group">
                                                        <input type="text" name="total_installments"
                                                               class="form-control @error('total_installments') is-invalid @enderror"
                                                               id="totalInstallments"
                                                               placeholder="min 1"
                                                               value="{{ old('total_installments', $singlePropertyDetails[$language->id][0]->manageProperty->total_installments) }}"
                                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                                    </div>
                                                    @error('total_installments')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3 installmentField {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" && old('is_installment', $singlePropertyDetails[$language->id][0]->manageProperty->is_installment) == "1" ? '' : 'd-none' }}">
                                                <div class="form-group">
                                                    <label>@lang('Installment Amount')</label>
                                                    <div class="input-group">
                                                        <input type="text" name="installment_amount"
                                                               class="form-control @error('installment_amount') is-invalid @enderror"
                                                               placeholder="0.00" value="{{ old('installment_amount', $singlePropertyDetails[$language->id][0]->manageProperty->installment_amount) }}"
                                                               id="installmentAmount"
                                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" readonly autocomplete="off">
                                                        <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                                        </div>
                                                    </div>
                                                    @error('installment_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3 installmentField {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" && old('is_installment', $singlePropertyDetails[$language->id][0]->manageProperty->is_installment) == "1" ? '' : 'd-none' }}">
                                                <div class="form-group">
                                                    <label>@lang('Installment Duration')</label>
                                                    <div class="input-group">
                                                        <input type="text" name="installment_duration"
                                                               class="form-control expiry_time @error('installment_duration') is-invalid @enderror"
                                                               value="{{ old('installment_duration', $singlePropertyDetails[$language->id][0]->manageProperty->installment_duration) }}"
                                                               placeholder="min 1" min="1" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                                        <div class="input-group-append">
                                                            <select class="form-control installment_duration_type"
                                                                    id="installment_duration_type"
                                                                    name="installment_duration_type">
                                                                <option value="Days" {{ old('installment_duration_type', $singlePropertyDetails[$language->id][0]->manageProperty->installment_duration_type) == 'Days' ? 'selected' : '' }}>@lang('Day(s)')</option>
                                                                <option value="Months" {{ old('installment_duration_type', $singlePropertyDetails[$language->id][0]->manageProperty->installment_duration_type) == 'Months' ? 'selected' : '' }}>@lang('Month(s)')</option>
                                                                <option value="Years" {{ old('installment_duration_type', $singlePropertyDetails[$language->id][0]->manageProperty->installment_duration_type) == 'Years' ? 'selected' : '' }}>@lang('Year(s)')</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @error('installment_duration')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3 installmentField {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" && old('is_installment', $singlePropertyDetails[$language->id][0]->manageProperty->is_installment) == "1" ? '' : 'd-none' }}">
                                                <div class="form-group">
                                                    <label>@lang('Installment Late Fee')</label>
                                                    <div class="input-group">
                                                        <input type="text" name="installment_late_fee"
                                                               class="form-control @error('installment_late_fee') is-invalid @enderror"
                                                               placeholder="0.00" value="{{ old('installment_late_fee', $singlePropertyDetails[$language->id][0]->manageProperty->installment_late_fee) }}"
                                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                                        <div class="input-group-append">
                                                        <span
                                                            class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                                        </div>
                                                    </div>
                                                    @error('installment_late_fee')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Profit Return Type')</label>
                                                    <div class="custom-switch-btn">
                                                        <input type='hidden' value='1'
                                                               name="is_return_type" {{ old('is_return_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_return_type) == "1" ? 'checked' : '' }}>
                                                        <input type="checkbox" name="is_return_type" id="is_return_type"
                                                               class="custom-switch-checkbox"
                                                               value="0" {{ old('is_return_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_return_type) == "0" ? 'checked' : '' }}>
                                                        <label class="custom-switch-checkbox-label" for="is_return_type">
                                                            <span class="custom-switch-checkbox-for-returnType"></span>
                                                            <span class="custom-switch-checkbox-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3 howManyTimes {{ old('is_return_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_return_type) == "0" ? '' : 'd-none' }}">
                                                <div class="form-group">
                                                    <label>@lang('how many times get profit?')</label>
                                                    <div class="input-group">
                                                        <input type="number" name="how_many_times"
                                                               class="form-control @error('how_many_times') is-invalid @enderror"
                                                               placeholder="min 1" value="{{ old('how_many_times', $singlePropertyDetails[$language->id][0]->manageProperty->how_many_times) }}"
                                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                                    </div>
                                                    @error('how_many_times')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Profit Return Schedule') (<span class="text-primary font-weight-normal font-14">@lang('after how many days')</span>)</label>
                                                    <select name="how_many_days" id="how_many_days"
                                                            class="form-control @error('how_many_days') is-invalid @enderror">
                                                        <option value="" disabled>@lang('Select a Period')</option>
                                                        @foreach($allSchedule as $schedule)
                                                            <option
                                                                value="{{ $schedule->id }}" {{ old('how_many_days', $singlePropertyDetails[$language->id][0]->manageProperty->how_many_days)  == $schedule->id ? 'selected' : ''}}>@lang($schedule->time) @lang($schedule->time_type)</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('how_many_days')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Can the investor sell his investment for this property?')</label>
                                                    <div class="custom-switch-btn">
                                                        <input type='hidden' value='1'
                                                               name="is_investor" {{ old('is_investor', $singlePropertyDetails[$language->id][0]->manageProperty->is_investor) == "1" ? 'checked' : '' }}>
                                                        <input type="checkbox" name="is_investor" id="is_investor"
                                                               class="custom-switch-checkbox"
                                                               value="0" {{ old('is_investor', $singlePropertyDetails[$language->id][0]->manageProperty->is_investor) == "0" ? 'checked' : '' }}>
                                                        <label class="custom-switch-checkbox-label" for="is_investor">
                                                            <span class="custom-switch-checkbox-for-installments"></span>
                                                            <span class="custom-switch-checkbox-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Capital Back')</label>
                                                    <div class="custom-switch-btn">
                                                        <input type='hidden' value='1'
                                                               name="is_capital_back" {{ old('is_capital_back', $singlePropertyDetails[$language->id][0]->manageProperty->is_capital_back) == "1" ? 'checked' : '' }}>
                                                        <input type="checkbox" name="is_capital_back" id="is_capital_back"
                                                               class="custom-switch-checkbox"
                                                               value="0" {{ old('is_capital_back', $singlePropertyDetails[$language->id][0]->manageProperty->is_capital_back) == "0" ? 'checked' : '' }}>
                                                        <label class="custom-switch-checkbox-label" for="is_capital_back">
                                                            <span class="custom-switch-checkbox-for-installments"></span>
                                                            <span class="custom-switch-checkbox-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Investment Start Date-Time')</label>
                                                    <input type="datetime-local" class="form-control start_date" name="start_date" value="{{\Illuminate\Support\Carbon::parse($singlePropertyDetails[$language->id][0]->manageProperty->start_date)}}" autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Investment Expire Date-Time')</label>
                                                    <input type="datetime-local" class="form-control expire_date" name="expire_date" value="{{\Illuminate\Support\Carbon::parse($singlePropertyDetails[$language->id][0]->manageProperty->expire_date)}}" autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Status')</label>
                                                    <div class="custom-switch-btn">
                                                        <input type='hidden' value='1'
                                                               name='status' {{ old('status', $singlePropertyDetails[$language->id][0]->manageProperty->status) == "1" ? 'checked' : '' }}>
                                                        <input type="checkbox" name="status" class="custom-switch-checkbox"
                                                               id="status"
                                                               value="0" {{ old('status', $singlePropertyDetails[$language->id][0]->manageProperty->status) == "0" ? 'checked' : '' }}>
                                                        <label class="custom-switch-checkbox-label" for="status">
                                                            <span class="custom-switch-checkbox-propertyStatus"></span>
                                                            <span class="custom-switch-checkbox-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <button type="submit"
                                        class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">
                                    <span><i class="fas fa-save pr-2"></i> @lang('Save Changes')</span></button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/summernote.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/image-uploader.css') }}"/>
@endpush

@push('js-lib')
    <script src="{{ asset('assets/admin/js/summernote.min.js')}}"></script>
    <script src="{{ asset('assets/global/js/image-uploader.js') }}"></script>
@endpush

@push('js')

    <script>
        'use strict'

        $('.summernote').summernote({
            height: 250,
            callbacks: {
                onBlurCodeview: function () {
                    let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                    $(this).val(codeviewHtml);
                }
            }
        });

        $('#image').on("change",function () {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image_preview_container').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).ready(function (){
            $(".generate").on('click', function () {
                var lang = $(this).data('lang');
                var form = `<div class="col-md-12 col-log-12 col-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="faq_title[]" class="form-control" type="text"
                                        placeholder="{{trans('question')}}">
                                        <textarea class="form-control summernote " name="faq_details[]" rows="1" placeholder="@lang('Answer')"></textarea>
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger delete_desc" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>`;

                $(`.addedField${lang}`).append(form)
            });

            $(document).on('click', '.delete_desc', function () {
                $(this).closest('.input-group').parent().remove();
            });

            $('.propertyAmenities').select2({
                width: '100%',
                placeholder: '@lang("Select Amenities")',
            });
            $('.propertyAvailableFor').select2({
                width: '100%',
                placeholder: '@lang("Select Available For")',
            });

            var property_images = {!! json_encode(optional(optional($singlePropertyDetails[1][0]->manageProperty)->image)->toArray()) !!};

            let preloaded = [];
            property_images.forEach(function (value, index) {
                preloaded.push({
                    id: value.id,
                    image_name: value.image,
                    src: "{{ asset(config('location.property.path')) }}/" + value.image
                });
            });

            let propertyImageOptions = {
                preloaded: preloaded,
                imagesInputName: 'property_image',
                preloadedInputName: 'old_property_image',
                label: 'Drag & Drop files here or click to browse images',
                extensions: ['.jpg', '.jpeg', '.png'],
                mimes: ['image/jpeg', 'image/png'],
                maxSize: 5242880
            };

            $('.property-image').imageUploader(propertyImageOptions);

            $(document).on('input', '#totalInstallments', function (){
                let total_installments = $('#totalInstallments').val();
                let fixed_amount = $('#fixedAmount').val();
                let installment_amount = parseInt(fixed_amount) / parseInt(total_installments);
                let final_installment_amount = installment_amount.toFixed(2);
                $('#installmentAmount').val(final_installment_amount);
            });


            $(document).on('change', '#is_invest_type', function () {
                var isCheck = $(this).prop('checked');
                if (isCheck == false) {
                    $('.rangeAmount').addClass('d-block');
                    $('.rangeAmount').removeClass('d-none');
                    $('.fixedAmount').removeClass('d-block');
                    $('.fixedAmount').addClass('d-none');
                    $('.acceptInstallments').addClass('d-none')
                    $('.installmentField').addClass('d-none');
                } else {
                    $('.rangeAmount').addClass('d-none');
                    $('.rangeAmount').removeClass('d-block');
                    $('.fixedAmount').removeClass('d-none');
                    $('.acceptInstallments').removeClass('d-none');
                    $('.installmentField').removeClass('d-none');
                    $('#is_installment').prop('checked', false);
                }
            });

            $(document).on('change', '#is_return_type', function () {
                var isCheck = $(this).prop('checked');

                if (isCheck == false) {
                    $('.howManyTimes').removeClass('d-block');
                    $('.howManyTimes').addClass('d-none');
                } else {
                    $('.howManyTimes').removeClass('d-none');
                    $('.howManyTimes').addClass('d-block');
                }
            });

            $(document).on('change', '#is_installment', function () {
                var isCheck = $(this).prop('checked');
                if (isCheck == false) {
                    $('.installmentField').removeClass('d-none');
                } else {
                    $('.installmentField').addClass('d-none');
                }
            });

            $('.propertyAmenities').select2({
                width: '100%',
                placeholder: '@lang("Select Amenities")',
            });

            $('.addressList').select2({
                width: '100%',
                placeholder: '@lang("Select Address")',
            });

            $('select[name=period_duration]').select2({
                selectOnClose: true
            });
            $('#drip_available_for').select2({
                width: '100%',
                placeholder: '@lang("Select Available For")',
            });

            $('#add_drip').click(function (e){
                e.preventDefault();
                var start_date = $('#drip_start_date').val();
                var end_date = $('#drip_end_date').val();
                var available_for = $('#drip_available_for').val();
                console.log(available_for);
                var data = {
                    'start_date': start_date,
                    'end_date': end_date,
                    'available_for': available_for,
                }
                var jsonData = document.getElementById("drip_contents_value").value;
                var dataArray = jsonData && jsonData != 'null' ? JSON.parse(jsonData) : [];

                var id = dataArray.length;
                dataArray.push(data);
                document.getElementById("drip_contents_value").value = JSON.stringify(dataArray);
                var html = '<tr>' +
                    '<td>'+start_date+'</td>' +
                    '<td>'+end_date+'</td>' +
                    '<td>'+available_for+'</td>' +
                    '<td><a href="#" class="btn btn-primary" id="drip_contents-'+id+'" onclick="delete_drip_body('+id+');return false;">Delete</a></td>' +
                    '</tr>';
                $('#dripContentTable').append(html);
            });
            $('#enable_drip').click(function (){
                if($('#enable_drip').is(':checked')){
                    $('#drip_content_div').css('display','block');
                }else{
                    $('#drip_content_div').css('display','none  ');

                }
            });


        });
        function delete_drip_body(id){
            console.log(id);
            var jsonData = document.getElementById("drip_contents_value").value;

            // Convert the existing JSON data to an array, or initialize an empty array if it's the first data
            var dataArray = jsonData != 'null' ? JSON.parse(jsonData) : [];
            dataArray.splice(id,1);
            document.getElementById("drip_contents_value").value = JSON.stringify(dataArray);
            $("#drip_contents-"+id).closest("tr").remove();
            return false;
        }

    </script>

@endpush
