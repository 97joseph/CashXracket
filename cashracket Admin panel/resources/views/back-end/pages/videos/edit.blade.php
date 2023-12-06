@extends('layouts.master')

@section('title')
    {{ __('Update video') }}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav" role="tablist">
                <a href="{{ route('videos.index') }}" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __('Videos List') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade active show" id="add-new-petty" role="tabpanel">
                <div class="table-header">
                    <h4>Update Video</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-9">
                        <div class="order-form-section">
                            <form action="{{ route('videos.update', $video->id) }}" method="post" class="add-brand-form ajaxform_instant_reload">
                                @csrf
                                @method('put')

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Title')}}</label>
                                        <input type="text" name="title" value="{{ $video->title }}" class="form-control" placeholder="Enter video title" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <div class="row m-0 p-0 justify-content-between">
                                            <div class="col-10 m-0 p-0">
                                                <label>{{__('Thumbnail')}}</label>
                                                <input type="file" name="thumbnail" class="form-control" id="thumbnail" accept="image/*">
                                            </div>
                                            <div class="col-2 m-0 p-0 mt-3 pt-2 text-end">
                                                <img width="80%" class="rounded-2" src="{{ asset($video->thumbnail) }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Min watching time (seconds)') }}</label>
                                        <input type="number" name="duration" value="{{ $video->duration }}" class="form-control" placeholder="Enter minimum watching time in seconds" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Coins')}}</label>
                                        <input type="number" name="coins" value="{{ $video->coins }}" class="form-control" placeholder="Enter coins" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label for="type">{{ __('Video Type') }}</label>
                                        <select name="type" id="type" class="form-control type" required>
                                            <option @selected($video->type == 'url') value="url">{{ __('Video Link') }} </option>
                                            <option @selected($video->type == 'video') value="video">{{ __('Upload Video') }} </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2 video_link {{ $video->type == 'url' ? '':'d-none' }}">
                                        <label>{{__('Video Link')}}</label>
                                        <input type="url" name="video_link" value="{{ $video->video_link }}" class="form-control" placeholder="Enter video link" id="video_link" required>
                                    </div>
                                    <div class="col-lg-6 mt-2 video {{ $video->type == 'video' ? '':'d-none' }}">
                                        <label>{{__('Upload Video')}}</label>
                                        <input type="file" name="video" class="form-control" id="video" accept="video/*">
                                        <a target="_blank" class="text-primary" href="{{ url($video->video_link) }}">
                                            Previous video <i class="fas fa-video"></i>
                                        </a>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>{{__('Status')}}</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option @selected($video->status == 1) value="1">{{ __('Published') }} </option>
                                            <option @selected($video->status == 0) value="0">{{ __('Unpublished') }} </option>
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

