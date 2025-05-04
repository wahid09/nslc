@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div>Publication</div>
            </div>
            <div class="page-title-actions">
                @permission('publication-create')
                <a href="{{ route('app.publications.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create publication
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
                            <th class="text-center">Attachment</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($publications as $publication)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $publication->title_bn }}</td>
                                <td class="text-center">
                                    @if(!empty($publication->attachment))
                                        <span><i class="fas fa-paperclip"></i></span>
                                    @else
                                        <span>--</span>
                                    @endif
                                </td>
                                <td class="text-center">{{$publication->created_at}}</td>

                                <td class="text-center">
                                    @if($publication->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @permission('publication-update')
                                    <a href="{{ route('app.publications.edit', $publication->id)}}"
                                       class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endpermission

                                    @permission('publication-delete')
                                    <button onclick="deleteData({{$publication->id}})" type="button"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$publication->id}}" method="POST"
                                          action="{{ route('app.publications.destroy', $publication->id) }}"
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
