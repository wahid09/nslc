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
                <div>Chif Calender</div>
            </div>
            <div class="page-title-actions">
                @permission('chif-calender-create')
                <a href="{{ route('app.chipCalenders.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Chif Calender
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
                            <th width="50%">Title</th>
                            <th class="text-center">Club</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($calenders as $calender)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td>{{ $calender->title }}</td>
                                <td class="text-center">{{ $calender->club->name_bn }}</td>
                                <td class="text-center">{{$calender->start}}</td>
                                <td class="text-center">{{ $calender->end }}</td>
                                <td class="text-center">
                                    @if($calender->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @permission('chif-calender-update')
                                    <a href="{{ route('app.chipCalenders.edit', $calender->id)}}"
                                       class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endpermission
                                    @permission('chif-calender-delete')
                                    <button onclick="deleteData({{$calender->id}})" type="button"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$calender->id}}" method="POST"
                                          action="{{ route('app.chipCalenders.destroy', $calender->id) }}"
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
