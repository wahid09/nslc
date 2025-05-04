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
                <div>Area</div>
            </div>
            <div class="page-title-actions">
                @permission('area-create')
                <a href="{{ route('app.area.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Area
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
                            <th>Name(English)</th>
                            <th class="text-center">Name(Bangle)</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($areas as $area)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $area->name}} Area</div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $area->name_bn }} অঞ্চল</td>

                                <td class="text-center">
                                    @if($area->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $area->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    @permission('area-update')
                                    <a href="{{ route('app.area.edit', $area->id)}}" class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    @endpermission

                                    @permission('area-delete')
                                    <button onclick="deleteData({{$area->id}})" type="button" class="btn btn-danger"><i
                                            class="fas fa-trash"></i></button>
                                    <form id="delete-{{$area->id}}" method="POST"
                                          action="{{ route('app.area.destroy', $area->id) }}" style="display:none;">
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
