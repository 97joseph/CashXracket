@extends('layouts.master')

@section('title')
{{__('Videos list')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav">
                <a href="#manage-videos" data-bs-toggle="tab" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __('Manage Videos') }}
                </a>
                <a href="#add-new" data-bs-toggle="tab" class="add-report-btn">
                    <i class="fas fa-plus-circle"></i> &nbsp;
                    {{ __('Add New') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="manage-videos">
                <div class="table-header">
                    <h4>Videos List</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <form action="">
                            <div class="input-group w-280">
                                <input type="text" class="form-control rounded-0" placeholder="Searching..." aria-describedby="basic-addon2" name="search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="input-group-text btn btn-warning rounded-0 rounded-end">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="responsive-table">
                    <table class="table" id="erp-table">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Thumbnail') }}</th>
                                <th>{{ __('Duration(Sec)') }}</th>
                                <th>{{ __('Coins') }}</th>
                                <th>{{ __('Play Video') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos as $video)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $video->title }}</td>
                                    <td>
                                        <div class="badge bg-{{ $video->type == 'video' ? 'success' : 'primary' }}">
                                            {{ $video->type == 'video' ? __('Uploaded Video') : __('Video Link') }}
                                        </div>
                                    </td>
                                    <td>
                                        <img height="45" width="45" class="rounded-circle" src="{{ asset($video->thumbnail) }}" alt="">
                                    </td>
                                    <td>{{ $video->duration }} Sec</td>
                                    <td>{{ $video->coins }}</td>
                                    <td>
                                        <a target="_blank" href="{{ url($video->video_link) }}">
                                            <i class="fas fa-video text-danger"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="badge bg-{{ $video->status ? 'success' : 'danger' }}">
                                            {{ $video->status ? __('Published') : __('Unpublished') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown table-action">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('videos.edit', $video->id) }}">
                                                        <i class="fal fa-pencil-alt"></i> 
                                                        {{ __('Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('videos.destroy', $video->id) }}" class="confirm-action" data-method="DELETE">
                                                        <i class="fal fa-trash-alt"></i>
                                                        {{ __('Delete') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $videos->links() }}
            </div>
            <div class="tab-pane fade" id="add-new">
                <div class="table-header">
                    <h4>Create new video</h4>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="order-form-section">
                            <form action="{{ route('videos.store') }}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Title')}}</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter video title" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Thumbnail')}}</label>
                                        <input type="file" name="thumbnail" class="form-control" id="thumbnail" accept="image/*" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Min watching time (seconds)') }}</label>
                                        <input type="number" name="duration" class="form-control" placeholder="Enter minimum watching time in seconds" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Coins')}}</label>
                                        <input type="number" name="coins" class="form-control" placeholder="Enter coins" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label for="type">{{ __('Video Type') }}</label>
                                        <select name="type" id="type" class="form-control type" required>
                                            <option selected value="url">{{ __('Video Link') }} </option>
                                            <option value="video">{{ __('Upload Video') }} </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2 d-none video">
                                        <label>{{__('Upload Video')}}</label>
                                        <input type="file" name="video" class="form-control" id="video" accept="file/*" required>
                                    </div>
                                    <div class="col-lg-6 mt-2 video_link">
                                        <label>{{__('Video Link')}}</label>
                                        <input type="url" name="video_link" class="form-control" placeholder="Enter video link" id="video_link" required>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label>{{__('Status')}}</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected value="1">{{ __('Published') }} </option>
                                            <option value="0">{{ __('Unpublished') }} </option>
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
