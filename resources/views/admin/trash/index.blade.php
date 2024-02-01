@extends('layouts.admin')

@section('content')
    <div class="container my-5">

        @if (count($projects) > 0)
        <h2 class="my-3">Deleted projects</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td class="d-flex gap-3">
                            <form action="{{ route('admin.trash.update', ['id' => $project->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success" type="submit"
                                    data-title="{{ $project->name }}">restore</button>
                            </form>
                            <form action="{{ route('admin.trash.destroy', ['id' => $project->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-btn" data-bs-toggle="modal"
                                    data-bs-target="#delete-modal" type="submit"
                                    data-title="{{ $project->name }}">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h2>no deleted projects</h2>
        @endif

        @if (count($types) > 0)
        <h2 class="my-5">Deleted technologies</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td class="d-flex gap-3">
                           <form action="{{ route('admin.trash.update', ['id' => $type->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success" type="submit"
                                    data-title="{{ $type->name }}">restore</button>
                            </form>
                            <form action="{{ route('admin.trash.destroy', ['id' => $type->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-btn" data-bs-toggle="modal"
                                    data-bs-target="#delete-modal" type="submit"
                                    data-title="{{ $type->name }}">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h2>no deleted projects</h2>
        @endif

        @include('partials.delete_modal')

    </div>
@endsection
