@extends('layouts.backend.app')
@push('css')
    <script src="{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/fancybox/jquery.fancybox.min.css')}}"/>
    <script src="{{asset('assets/fancybox/jquery.fancybox.min.js')}}"></script>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-chart-area icon-gradient bg-mean-fruit"></i>
                </div>
                <div>tutorial</div>
            </div>
            <div class="page-title-actions">
                @permission('tutorial-create')
                <a href="{{ route('app.tutorial.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Tutorial
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
                            <th class="text-center">Tutorial</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tutorials as $item)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $item->title }}</td>
                                <td class="text-center">
                                    <a data-fancybox href="#myVideo-{{$item->id}}" class="btn btn-info">
                                        View
                                    </a>

                                    <video width="640" height="320" controls id="myVideo-{{$item->id}}"
                                           style="display:none;">
                                        <source src="{{url('/uploads/videos/'.$item->video)}}" type="video/mp4">
                                    </video>

                                </td>

                                <td class="text-center">
                                    @if($item->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @permission('tutorial-update')
                                    <a href="{{ route('app.tutorial.edit', $item->id)}}" class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    @endpermission

                                    @permission('tutorial-delete')
                                    <button onclick="deleteData({{$item->id}})" type="button" class="btn btn-danger">
                                        <i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$item->id}}" method="POST"
                                          action="{{ route('app.tutorial.destroy', $item->id) }}"
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
