@extends('layouts.master')

@section('title')
    {{ __('Update quiz') }}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav" role="tablist">
                <a href="{{ route('earnings.index', ['type' => $earning->type]) }}" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __(ucfirst(str_replace("_", " ", $earning->type)) . ' List') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade active show" id="add-new-petty" role="tabpanel">
                <div class="table-header">
                    <h4>Update {{ ucfirst(str_replace("_", " ", $earning->type)) }}</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-9">
                        <div class="order-form-section">
                            <form action="{{ route('earnings.update', $earning->id) }}" method="post" class="add-brand-form ajaxform_instant_reload">
                                @csrf
                                @method('put')

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Title')}}</label>
                                        <input type="text" name="title" value="{{ $earning->title }}" class="form-control" placeholder="Enter title" required>
                                    </div>
                                    @if ($earning->type == 'website')
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Min visiting time (seconds)') }}</label>
                                        <input type="number" name="duration" value="{{ $earning->duration }}" class="form-control" placeholder="Enter minimum visiting time in seconds" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Enter Link')}}</label>
                                        <input type="url" name="url" value="{{ $earning->url }}" class="form-control" placeholder="Enter website link" id="url" required>
                                    </div>
                                    @elseif ($earning->type == 'scratch_card')
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Scratch card price') }}</label>
                                        <input type="number" name="price" value="{{ $earning->price }}" class="form-control" placeholder="Enter scratch card price" required>
                                    </div>
                                    @endif
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Reward Points')}}</label>
                                        <input type="number" step="any" name="reward_point" value="{{ $earning->reward_point }}" class="form-control" placeholder="Enter reward point" required>
                                    </div>
                                    <div class="col-lg-{{ $earning->type == 'scratch_card' ? '6' : '12' }} mt-2">
                                        <label>{{__('Status')}}</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option @selected($earning->status == 1) value="1">{{ __('Published') }} </option>
                                            <option @selected($earning->status == 0) value="0">{{ __('Unpublished') }} </option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="button-group text-center mt-5">
                                            <button type="reset" class="theme-btn border-btn m-2">{{ __('Reset') }}</button>
                                            <button class="theme-btn m-2 submit-btn">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

