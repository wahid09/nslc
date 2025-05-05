@extends('layouts.backend.app')
@push('css')

@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-won-sign"></i>
                </div>
                <div>Welfare activities</div>
            </div>
            <div class="page-title-actions">
                @permission('welfare-create')
                <a href="{{ route('app.welfares.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Welfare activities
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
                            <th width="50%">Title(Bangle)</th>
                            <th class="text-center">Club</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Area</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($welfares as $welfare)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td>{{ $welfare->title_bn }}</td>
{{--                                <td class="text-center">{{ $welfare->club->name_bn }}</td>--}}
                                <td class="text-center">{{ optional($welfare->club)->name_bn ?? 'N/A' }}</td>
                                <td class="text-center"><img src="{{ asset('storage/welfare/'.$welfare->image) }}" style="width: 80px; height:40px;"></td>
{{--                                <td class="text-center">--}}
{{--                                    {{$welfare->area->name_bn}}--}}
{{--                                </td>--}}
                                <td class="text-center">{{ optional($welfare->area)->name_bn ?? 'N/A' }}</td>
                                <td class="text-center">
                                    @if($welfare->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $welfare->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    @permission('welfare-update')
                                    <a href="{{ route('app.welfares.edit', $welfare->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endpermission

                                    @permission('welfare-delete')
                                    <button onclick="deleteData({{$welfare->id}})" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$welfare->id}}" method="POST" action="{{ route('app.welfares.destroy', $welfare->id) }}" style="display:none;">
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
