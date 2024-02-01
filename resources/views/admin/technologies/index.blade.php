@extends('layouts.admin')


@section('content')
    <div class="container my-5">
        <h1 class="my-4">Technologies</h1>

        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif

        <a class="btn btn-primary mb-3" href="{{ route('admin.technologies.create') }}">create new technology</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Hex Color</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($technologies as $technology)
                    <tr>
                        <td class="fw-bold">{{ $technology->id }}</td>
                        <td>{{ $technology->technology_name }}</td>
                        <td>{{ $technology->slug }}</td>
                        <td class="text-white" style="background-color: {{ $technology->hex_color }}">
                            {{ $technology->hex_color }}</td>
                        <td class="d-flex gap-2">
                            <a class="btn btn-success"
                                href="{{ route('admin.technologies.show', ['technology' => $technology->slug]) }}">details</a>
                            <form action="{{ route('admin.technologies.destroy', ['technology' => $technology->slug]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button data-bs-toggle="modal" data-bs-target="#delete-modal"
                                    class="btn btn-danger delete-btn"
                                    data-title="{{ $technology->technology_name }}">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach


                @include('partials.delete_modal')


            </tbody>
        </table>

    </div>
@endsection
