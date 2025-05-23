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
                <div>Notice</div>
            </div>
            <div class="page-title-actions">
                @permission('lcn-create')
                <a href="{{ route('app.ladies-club-notice.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Notices
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
                        @foreach ($notices as $notice)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $notice->title_bn }}</td>
                                <td class="text-center">
                                    @if(!empty($notice->attachment))
                                        <span><i class="fas fa-paperclip"></i></span>
                                    @else
                                        <span>--</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ date('D-M-Y', strtotime($notice->created_at)) }}</td>

                                <td class="text-center">
                                    @if($notice->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @permission('lcn-edit')
                                    <a href="{{ route('app.ladies-club-notice.edit', $notice->id)}}" class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    @endpermission

                                    @permission('lcn-index')
                                    <a href="{{ route('app.ladies-club-notice.show', $notice->id)}}" class="btn btn-primary"><i
                                            class="fas fa-eye"></i></a>
                                    @endpermission

                                    @permission('lcn-delete')
                                    <button onclick="deleteData({{$notice->id}})" type="button" class="btn btn-danger">
                                        <i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$notice->id}}" method="POST"
                                          action="{{ route('app.ladies-club-notice.destroy', $notice->id) }}"
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
