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
                <div>Events</div>
            </div>
            <div class="page-title-actions">
                @permission('lce-create')
                <a href="{{ route('app.ladies-club-event.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">
                    <i class="fas fa-plus-circle"></i>&nbsp;Create Event
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
                            <th class="text-center">Event Title(Bangle)</th>
                            <th class="text-center">Event Description(Bangle)</th>
                            <th class="text-center">Event Date</th>
{{--                            <th class="text-center">Event Start Time</th>--}}
{{--                            <th class="text-center">Event End Time Time</th>--}}
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($events as $item)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $item->title_bn }}</td>
                                <td class="text-center">{!! $item->description_bn !!}</td>
                                <td class="text-center">{{ $item->event_date }}</td>
{{--                                <td class="text-center">{{ $item->start_time }}</td>--}}
{{--                                <td class="text-center">{{ $item->end_time }}</td>--}}
                                <td class="text-center">
                                    @if($item->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @permission('lce-edit')
                                    <a href="{{ route('app.ladies-club-event.edit', $item->id)}}" class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    @endpermission

                                    @permission('lce-index')
                                    <a href="{{ route('app.ladies-club-event.show', $item->id)}}" class="btn btn-primary"><i
                                            class="fas fa-eye"></i></a>
                                    @endpermission

                                    @permission('lce-delete')
                                    <button onclick="deleteData({{$item->id}})" type="button" class="btn btn-danger">
                                        <i class="fas fa-trash"></i></button>
                                    <form id="delete-{{$item->id}}" method="POST"
                                          action="{{ route('app.ladies-club-event.destroy', $item->id) }}"
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
