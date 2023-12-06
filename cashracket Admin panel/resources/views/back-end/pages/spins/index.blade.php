@extends('layouts.master')

@section('title')
{{__('Update spin info')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header">
            <h4>Update spin info</h4>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="order-form-section">
                    <form action="{{ route('spins.store') }}" method="post" class="add-brand-form ajaxform" id="add-brand-form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Entry Fee') }}</label>
                                <input type="text" name="entry_fee" value="{{ $spins->value['entry_fee'] ?? '' }}" class="form-control" placeholder="Enter entry fee" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 0') }}</label>
                                <input type="text" name="position0" value="{{ $spins->value['position0'] ?? '' }}" class="form-control" placeholder="Enter 0 position value" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 1') }}</label>
                                <input type="text" name="position1" value="{{ $spins->value['position1'] ?? '' }}" class="form-control" placeholder="Enter 1 position value" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 2') }}</label>
                                <input type="text" name="position2" value="{{ $spins->value['position2'] ?? '' }}" class="form-control" placeholder="Enter 2 position value" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 3') }}</label>
                                <input type="text" name="position3" value="{{ $spins->value['position3'] ?? '' }}" class="form-control" placeholder="Enter 3 position value" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 4') }}</label>
                                <input type="text" name="position4" value="{{ $spins->value['position4'] ?? '' }}" class="form-control" placeholder="Enter 4 position value" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 5') }}</label>
                                <input type="text" name="position5" value="{{ $spins->value['position5'] ?? '' }}" class="form-control" placeholder="Enter 5 position value" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 6') }}</label>
                                <input type="text" name="position6" value="{{ $spins->value['position6'] ?? '' }}" class="form-control" placeholder="Enter 6 position value" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 7') }}</label>
                                <input type="text" name="position7" value="{{ $spins->value['position7'] ?? '' }}" class="form-control" placeholder="Enter 7 position value" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 8') }}</label>
                                <input type="text" name="position8" value="{{ $spins->value['position8'] ?? '' }}" class="form-control" placeholder="Enter 8 position value" required>
                            </div>

                            <div class="col-sm-6 col-md-4 mt-2">
                                <label>{{ __('Position 9') }}</label>
                                <input type="text" name="position9" value="{{ $spins->value['position9'] ?? '' }}" class="form-control" placeholder="Enter 9 position value" required>
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
@endsection
