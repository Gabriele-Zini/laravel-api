@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <p class="fs-3"><span class="fw-bold">Type project</span>: {{ $type->name }}</p>
        <p class="fs-3"><span class="fw-bold">Slug</span>: {{ $type->slug }}</p>
        @if (count($type->projects)>0)
        <h4>Projects<i class="fa-solid fa-diagram-project ms-3"></i></h4>
        <ol>
            @foreach ($type->projects as $project)
                <li><a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">{{ $project->name }}</a></li>
                @endforeach
        </ol>

        @else
        <h3>no projects</h3>
        @endif
    </div>

    <h3>Edit Project</h3>
<form action="{{ route('admin.types.update', ['type'=>$type->slug]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3 w-25">
        <label for="name" class="form-label">Type Name</label>
        <input type="text"
            class="form-control @error('name') is-invalid @enderror @if(!empty(old('name')) && !$errors->has('name')) is-valid @endif"
            id="name" name="name" value="{{ old('name') ?? $type->name }}">
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <button class="btn btn-success" type="submit">send</button>
</form>
@endsection
