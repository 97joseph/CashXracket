@extends('layouts.master')

@section('title')
    {{ __('Watched Videos') }}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="supplier-list-two"><br>
                <div class="table-header">
                    <h4>{{ __('Watched Videos') }}</h4>
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
                                <th>{{__('#')}}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Video title') }}</th>
                                <th>{{ __('Earned coins') }}</th>
                                <th>{{ __('Duration') }}</th>
                                <th>{{ __('Created At') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($watched_videos as $video)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($video->user)->name }}</td>
                                    <td>{{ optional($video->video)->title }}</td>
                                    <td>{{ $video->earned_coins }}</td>
                                    <td>{{ $video->duration }}</td>
                                    <td>{{ date('d M Y - H:i A', strtotime($video->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $watched_videos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

