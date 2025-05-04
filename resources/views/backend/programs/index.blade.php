@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-allergies icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Program</div>
            </div>
            <div class="page-title-actions">
                @permission('program-create')
                <a href="{{ route('app.programs.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Program
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
                            <th class="text-center">Title(Bangle)</th>
                            <th class="text-center">Club</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Area</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($programs as $program)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td>{{ $program->title_bn }}</td>
                                <td class="text-center">{{ $program->club->name_bn }}</td>
                                <td class="text-center"><img src="{{ asset('storage/programs/'.$program->image) }}" style="width: 80px; height:40px;"></td>
                                <td class="text-center">
                                    {{$program->area->name_bn}}
                                </td>
                                <td class="text-center">
                                    @if($program->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $program->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    @permission('program-update')
                                    <a href="{{ route('app.programs.edit', $program->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endpermission

                                    @permission('program-delete')
                                    <button onclick="deleteData({{$program->id}})" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$program->id}}" method="POST" action="{{ route('app.programs.destroy', $program->id) }}" style="display:none;">
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
