@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <a class="btn btn-primary mb-3" href="{{ route('admin.types.create') }}">create new type</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Projects</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($types as $type)
                    <tr>
                        <td class="fw-bold">{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>
                            @foreach ($type->projects as $project)
                                <a
                                    href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">{{ $project->name }}</a>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach

                        </td>
                        <td class="d-flex gap-2">
                            <a class="btn btn-success"
                                href="{{ route('admin.types.show', ['type' => $type->slug]) }}">details</a>
                            <form action="{{ route('admin.types.destroy', ['type' => $type->slug]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button data-bs-toggle="modal"
                                data-bs-target="#delete-modal" class="btn btn-danger delete-btn" data-title="{{ $type->name }}">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @include('partials.delete_modal')



    </div>
@endsection
