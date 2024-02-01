@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <a class="btn btn-secondary mb-3" href="{{ route('admin.projects.create') }}">create project</a>

        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif

        @if (count($projects) > 0)
            <div class="my-4 w-25">
                <form class="form" action="{{ route('admin.projects.index') }}" method="GET">
                    @csrf
                    <label class="my-3 fw-bold" for="per_page"> {{ $projects->perPage() }} per page</label>
                    <select class="form-select" name="per_page" id="per_page">
                        @for ($i = 5; $i <= 20; $i += 5)
                            <option @selected($projects->perPage() == $i) value="{{ $i }}">{{ $i }}</option>
                        @endfor

                    </select>

                    <button class="btn btn-primary my-3" type="submit">apply</button>
                </form>
            </div>
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">title</th>
                        <th scope="col">description</th>
                        <th scope="col">type</th>
                        <th scope="col">technologies</th>
                        <th scope="col" class="text-center">actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($projects as $project)
                        <tr>
                            <td class="fw-bold">{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->type ? $project->type->name : '' }}</td>
                            <td>
                                @foreach ($project->technologies as $technology)
                               <p class="badge" style="background-color: {{ $technology->hex_color }}">{{ $technology->technology_name }}</p>
                                @endforeach
                            </td>
                            <td class="d-flex align-items-center justify-content-center gap-2">
                                @include('admin.projects.partials.details-btn')
                                @include('admin.projects.partials.edit-btn')
                                @include('admin.projects.partials.delete-btn')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning d-flex align-items-center">
                <h4 class="m-0"> <i class="fa-solid fa-arrow-up-from-bracket me-4"></i><span>Create your first
                        project</span><i class="fa-solid fa-diagram-project ms-4"></i></h4>
            </div>
        @endif

        @include('partials.delete_modal')
        <div>
            {{ $projects->links() }}
        </div>
    </div>


@endsection
