@extends('layouts.backend.app')
@push('css')
    <style>
        .flex-wrap {
            flex-wrap: wrap !important;
            float: left;
        }
    </style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-file icon-gradient bg-mean-fruit"></i>
                </div>
                <div>All Member</div>
            </div>
            <div class="page-title-actions">
                @permission('club-create')
                <a href="{{ route('app.member-registration.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Member
                </a>
                @endpermission
            </div>
        </div>
    </div>
{{--    @include('ladiesClub.registration.searchPan')--}}
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-body">
                    <table style="width: 100%;" id="" class="table table-hover table-striped table-bordered yajra-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Membership No.</th>
                            <th class="text-center">Husband's Name</th>
                            <th class="text-center">BA No.</th>
                            <th class="text-center">Husband's Rank</th>
                            <th class="text-center">Member Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Member Contact</th>
                            <th class="text-center">ID Card No.</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach ($membersList as $item)--}}
{{--                            <tr>--}}
{{--                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>--}}
{{--                                <td class="text-center">{{ $item->membership_no }}</td>--}}
{{--                                <td class="text-center">{{ $item->spouse_name_en }}</td>--}}
{{--                                <td class="text-center">{{ $item->spouse_ba_no }}</td>--}}
{{--                                <td class="text-center">{{ $item->rank_name }}</td>--}}
{{--                                <td class="text-center">{{ $item->member_phone }}</td>--}}
{{--                                <td class="text-center">{{ $item->member_name }}</td>--}}
{{--                                <td class="text-center">{{ $item->email }}</td>--}}
{{--                                <td class="text-center">{{ $item->id_card_number }}</td>--}}
{{--                                <td class="text-center">--}}
{{--                                    @if($item->user_status == true)--}}
{{--                                        <span class="badge badge-info">Active</span>--}}
{{--                                    @else--}}
{{--                                        <span class="badge badge-warning">Inactive</span>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td class="text-center">--}}
{{--                                    <a href="{{ route('app.member.view', $item->user_id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Details"><i--}}
{{--                                            class="fas fa-eye"></i></a>--}}
{{--                                    <a href="{{ route('app.user.assignDeviceForm', $item->user_id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Assign Device"><i--}}
{{--                                            class="fa fa-tablet"></i></a>--}}
{{--                                    @permission('club-update')--}}
{{--                                    <a href="{{ route('app.member-registration.edit', $item->user_id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit member"><i--}}
{{--                                            class="fas fa-edit"></i></a>--}}
{{--                                    @endpermission--}}
{{--                                    @permission('club-delete')--}}
{{--                                    <button onclick="deleteData({{$item->user_id}})" type="button" class="btn btn-danger"><i--}}
{{--                                            class="fas fa-trash"></i></button>--}}
{{--                                    <form id="delete-{{$item->id}}" method="POST"--}}
{{--                                          action="{{ route('app.member-registration.destroy', $item->user_id) }}" style="display:none;">--}}
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
    @include('ladiesClub.registration.indexJs')
@endpush

