@extends('layouts.master')

@section('title')
{{ __(ucfirst(str_replace("_", " ", request('type'))) . ' List') }}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav">
                <a href="#manage-earnings" data-bs-toggle="tab" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __('Manage '.ucfirst(str_replace("_", " ", request('type')))) }}
                </a>
                <a href="#add-new" data-bs-toggle="tab" class="add-report-btn">
                    <i class="fas fa-plus-circle"></i> &nbsp;
                    {{ __('Add New') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="manage-earnings">
                <div class="table-header">
                    <h4>{{ __(ucfirst(str_replace("_", " ", request('type'))) . ' List') }}</h4>
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
                                <th>{{ __('Reward Points') }}</th>
                                @if (request('type') == 'website')
                                <th>{{ __('Duration(Sec)') }}</th>
                                <th>{{ __('Visit Website') }}</th>
                                @elseif (request('type') == 'scratch_card')
                                <th>{{ __('Scratch Card Price') }}</th>
                                @endif
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($earnings as $earning)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $earning->title }}</td>
                                    <td class="fw-bold text-dark">{{ $earning->reward_point }}</td>
                                    @if (request('type') == 'website')
                                    <td>{{ $earning->duration }} Sec</td>
                                    <td>
                                        <a target="_blank" class="text-primary" href="{{ url($earning->url) }}">
                                            <i class="fas fa-globe"></i>
                                        </a>
                                    </td>
                                    @elseif (request('type') == 'scratch_card')
                                    <td class="fw-bold text-dark">{{ $earning->price }}</td>
                                    @endif
                                    <td>
                                        <div class="badge bg-{{ $earning->status ? 'success' : 'danger' }}">
                                            {{ $earning->status ? __('Published') : __('Unpublished') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown table-action">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('earnings.edit', [$earning->id, 'type' => request('type')]) }}">
                                                        <i class="fal fa-pencil-alt"></i> 
                                                        {{ __('Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('earnings.destroy', $earning->id) }}" class="confirm-action" data-method="DELETE">
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
                {{ $earnings->links() }}
            </div>
            <div class="tab-pane fade" id="add-new">
                <div class="table-header">
                    <h4>Create new {{ ucfirst(str_replace("_", " ", request('type'))) }}</h4>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="order-form-section">
                            <form action="{{ route('earnings.store') }}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Title')}}</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter title" required>
                                    </div>
                                    <input type="hidden" value="{{ request('type') }}" name="type">
                                    @if (request('type') == 'website')
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Min visiting time (seconds)') }}</label>
                                        <input type="number" name="duration" class="form-control" placeholder="Enter minimum visiting time in seconds" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Enter Link')}}</label>
                                        <input type="url" name="url" class="form-control" placeholder="Enter website link" id="url" required>
                                    </div>
                                    @elseif (request('type') == 'scratch_card')
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Scratch card price') }}</label>
                                        <input type="number" step="any" name="price" class="form-control" placeholder="Enter scratch card price" required>
                                    </div>
                                    @endif
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Reward Points')}}</label>
                                        <input type="number" name="reward_point" class="form-control" placeholder="Enter reward point" required>
                                    </div>
                                    <div class="{{ request('type') == 'website' ? 'col-lg-12' : 'col-lg-6' }} mt-2">
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
