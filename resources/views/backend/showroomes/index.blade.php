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
                <div>Show Room</div>
            </div>
            <div class="page-title-actions">
                @permission('showroome-create')
                <a href="{{ route('app.showroome.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Show Roome
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
                            <th class="text-center">Title</th>
                            <th class="text-center">house</th>
                            <th class="text-center">Road</th>
                            <th class="text-center">Area</th>
                            <th class="text-center">Phone No</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($showroomes as $showroome)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $showroome->title }}</td>
                                <td class="text-center">{{ $showroome->house }}</td>
                                <td class="text-center">{{ $showroome->road }}</td>
{{--                                <td class="text-center">{{ $showroome->areaName->name_bn }}</td>--}}
                                <td class="text-center">{{ optional($showroome->areaName)->name_bn ?? 'N/A' }}</td>
                                <td class="text-center">{{ $showroome->phone }}</td>
                                <td class="text-center">
                                    @if($showroome->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @permission('showroome-update')
                                    <a href="{{ route('app.showroome.edit', $showroome->id)}}"
                                       class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endpermission
                                    @permission('showroome-delete')
                                    <button onclick="deleteData({{$showroome->id}})" type="button"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$showroome->id}}" method="POST"
                                          action="{{ route('app.showroome.destroy', $showroome->id) }}"
                                          style="display:none;">
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
