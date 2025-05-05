@extends('layouts.backend.app')
@push('css')
{{--    <style>--}}
{{--        .flex-wrap {--}}
{{--            flex-wrap: wrap !important;--}}
{{--            float: left;--}}
{{--        }--}}
{{--        .dt-search{--}}
{{--            flex-wrap: wrap !important;--}}
{{--            float: right;--}}
{{--        }--}}
{{--        div.dt-container div.dt-info {--}}
{{--            white-space: nowrap;--}}
{{--            float: left;--}}
{{--        }--}}
{{--        div.dt-container div.dt-paging {--}}
{{--            margin: 0;--}}
{{--            float: right;--}}
{{--        }--}}
{{--    </style>--}}
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-file icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Event Attend Member List</div>
            </div>
            <div class="page-title-actions">
                {{--                @permission('club-create')--}}
                {{--                <a href="{{ route('app.member-registration.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">--}}
                {{--                    <i class="fas fa-plus-circle"></i>&nbsp;Create Member--}}
                {{--                </a>--}}
                {{--                @endpermission--}}
            </div>
        </div>
    </div>
    @include('ladiesClub.memberListWithCode.searchpan')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-body">
                    <table style="width: 100%;" id=""
                           class="table table-hover table-striped table-bordered yajra-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Membership No.</th>
                            <th class="text-center">Member Name</th>
                            <th class="text-center">Husband's Name</th>
                            <th class="text-center">BA No.</th>
                            <th class="text-center">Husband's Rank</th>
                            <th class="text-center">Member Contact</th>
                            <th class="text-center">ID Card No.</th>
                            <th class="text-center">Event Name</th>
                            <th class="text-center">Event Code</th>
                            {{--                            <th class="text-center">Status</th>--}}
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--                        @foreach ($memberLists as $item)--}}
                        {{--                            <tr>--}}
                        {{--                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>--}}
                        {{--                                <td class="text-center">{{ $item->membership_no }}</td>--}}
                        {{--                                <td class="text-center">{{ $item->name }}</td>--}}
                        {{--                                <td class="text-center">{{ $item->spouse_name_en }}</td>--}}
                        {{--                                <td class="text-center">{{ $item->spouse_ba_no }}</td>--}}
                        {{--                                <td class="text-center">{{ $item->rank_name }}</td>--}}
                        {{--                                <td class="text-center">{{ $item->phone }}</td>--}}
                        {{--                                <td class="text-center">{{ $item->id_card_number }}</td>--}}
                        {{--                                <td class="text-center">{{$item->event_name}}</td>--}}
                        {{--                                <td class="text-center">--}}
                        {{--                                    @if($item->status == true)--}}
                        {{--                                        <span class="badge badge-info">Active</span>--}}
                        {{--                                    @else--}}
                        {{--                                        <span class="badge badge-warning">Inactive</span>--}}
                        {{--                                    @endif--}}
                        {{--                                </td>--}}
                        {{--                                <td class="text-center">--}}
                        {{--                                    @permission('club-update')--}}
                        {{--                                    <a href="javascript:void(0)" class="btn btn-primary  update-attendance"--}}
                        {{--                                       data-toggle="tooltip"--}}
                        {{--                                       data-placement="top" title="Member is Attended" data-id="{{ $item->id }}"><i--}}
                        {{--                                            class="fas fa-arrow-circle-up"></i></a>--}}
                        {{--                                    @endpermission--}}
                        {{--                                    @permission('club-delete')--}}
                        {{--                                    <button onclick="deleteData({{$item->id}})" type="button" class="btn btn-danger"><i--}}
                        {{--                                            class="fas fa-trash"></i></button>--}}
                        {{--                                    <form id="delete-{{$item->id}}" method="POST"--}}
                        {{--                                          action="{{ route('app.member-registration.destroy', $item->id) }}"--}}
                        {{--                                          style="display:none;">--}}
                        {{--                                        @csrf--}}
                        {{--                                        @method('DELETE')--}}
                        {{--                                    </form>--}}
                        {{--                                    @endpermission--}}
                        {{--                                </td>--}}
                        {{--                            </tr>--}}
                        {{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
    @include('ladiesClub.memberListWithCode.listjs')
@endpush

