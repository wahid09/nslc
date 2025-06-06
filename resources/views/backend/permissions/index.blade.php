@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                {{-- <i class="pe-7s-check icon-gradient bg-mean-fruit"></i> --}}
                <i class="fas fa-angellist"></i>
            </div>
            <div>Permission</div>
        </div>
        <div class="page-title-actions">
            @permission('permission-create')
            <a href="{{ route('app.permissions.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                <i class="fas fa-plus-circle"></i>&nbsp;Create Permission
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
                            <th class="text-center">Module</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($permissions as $item)
                                <tr>
                                    <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">

                                        <span class="badge badge-info">{{ $item->module->name }}</span>
                                    </td>
                                    <td class="text-center">{{ $item->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        @permission('permission-update')
                                        <a href="{{ route('app.permissions.edit', $item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        @endpermission
                                        @permission('permission-delete')
                                        <button onclick="deleteData({{$item->id}})" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        <form id="delete-{{$item->id}}" method="POST" action="{{ route('app.permissions.destroy', $item->id) }}" style="display:none;">
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
