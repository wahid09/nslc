@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Footer</div>
            </div>
{{--            <div class="page-title-actions">--}}
{{--                <a href="{{ route('app.modules.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">--}}
{{--                    <i class="fas fa-plus-circle"></i>&nbsp;Create Module--}}
{{--                </a>--}}
{{--            </div>--}}
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
                            <th class="text-center">Footer Text</th>
                            <th class="text-center">Contect Info</th>
                            <th class="text-center">Logo</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach ($modules as $item)--}}
                            <tr>
                                <td class="text-center text-muted">{{ $footers->id }}</td>
                                <td class="text-center">{{ str_limit($footers->slogan_bn, 100) }}</td>
                                <td class="text-center">

                                    {{ str_limit($footers->contact_bn, 100) }}
                                </td>
                                <td class="text-center"><img src="{{asset('storage/logo/'.$footers->logo)}}" alt="" style="width: 80px; height: 80px;"></td>
                                <td class="text-center">{{ $footers->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    @permission('footer-update')
                                    <a href="{{ route('app.footers.edit', $footers->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endpermission

{{--                                    <button onclick="deleteData({{$item->id}})" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>--}}
{{--                                    <form id="delete-{{$item->id}}" method="POST" action="{{ route('app.modules.destroy', $item->id) }}" style="display:none;">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                    </form>--}}
                                </td>
                            </tr>
{{--                        @endforeach--}}


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')

@endpush
