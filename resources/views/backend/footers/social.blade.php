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
                <div>Social</div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-body">
                    <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Facebook Link</th>
                            <th class="text-center">Twitter Link</th>
                            <th class="text-center">Instragram Link</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($links as $item)
                        <tr>
                            <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                            <td class="text-center">{{ $item->fb_link }}</td>
                            <td class="text-center">{{ $item->twitter_link }}
                            </td>
                            <td class="text-center">{{ $item->instra_link }}</td>
                            <td class="text-center">{{ $item->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                @permission('social-update')
                                <a href="{{ route('app.socials.edit', $item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
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
