@extends('layouts.backend.app')
@push('css')

@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-chart-area icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Appointment</div>
            </div>
            <div class="page-title-actions">
                @permission('appointment-create')
                <a href="{{ route('app.appointments.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Appointment
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
                            <th class="text-center">Name(Bangle)</th>
                            <th class="text-center">Status</th>
{{--                            <th class="text-center">Created At</th>--}}
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $appointment->name_bn }}</td>

                                <td class="text-center">
                                    @if($appointment->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
{{--                                <td class="text-center">{{ $appointment->created_at->diffForHumans() }}</td>--}}
                                <td class="text-center">
                                    @permission('appointment-update')
                                    <a href="{{ route('app.appointments.edit', $appointment->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endpermission

                                    @permission('appointment-delete')
                                    <button onclick="deleteData({{$appointment->id}})" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$appointment->id}}" method="POST" action="{{ route('app.appointments.destroy', $appointment->id) }}" style="display:none;">
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
