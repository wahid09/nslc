@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-calendar-plus icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Board Member</div>
            </div>
            <div class="page-title-actions">
                @permission('leader-create')
                <a href="{{ route('app.leader.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Board Member
                </a>
                @endpermission
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-body">
                    <table style="width: 100%;" id="dataTable" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Appointment</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Club</th>
                            <th class="text-center">Area</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($leaders as $leader)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $leader->name_bn }}</td>
                                <td class="text-center">
@if(!empty($leader->appointment->name_bn))
{{ $leader->appointment->name_bn }}
@endif
</td>
                                <td class="text-center"><img src="{{ asset('storage/leader/'.$leader->image) }}" style="width: 80px; height:40px;"></td>
                                <td class="text-center">{{ $leader->club->name_bn }}</td>
                                <td class="text-center">

                                    {{ $leader->areaName->name_bn }}
                                </td>
                                <td class="text-center">
                                    @if($leader->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @permission('leader-update')
                                    <a href="{{ route('app.leader.edit', $leader->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endpermission
                                    @permission('leader-delete')
                                    <button onclick="deleteData({{$leader->id}})" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$leader->id}}" method="POST" action="{{ route('app.leader.destroy', $leader->id) }}" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
@endpush
