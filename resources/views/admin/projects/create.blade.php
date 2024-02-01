@extends('layouts.admin')

@section('content')
    <div class="container my-5 w-50">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text"
                    class="form-control @error('name') is-invalid @enderror @if (!empty(old('name')) && !$errors->has('name')) is-valid @endif"
                    id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Project cover_image</label>
                <input type="file"
                    class="form-control @error('cover_image') is-invalid @enderror @if (!empty(old('cover_image')) && !$errors->has('cover_image')) is-valid @endif"
                    id="cover_image" name="cover_image" value="{{ old('cover_image') }}">
                @error('cover_image')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <img id="preview-image" class="ms_show-image d-none" src="" alt="">
            </div>

            <div class="mb-3">
                <label class="form-label" for="type">Project type</label>
                <select class="form-select" name="type_id" id="type">
                    <option @selected(!old('type_id')) value="">No type selected</option>
                    @foreach ($types as $type)
                        <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="btn-group btn-group-sm my-3" role="group" aria-label="Basic checkbox toggle button group">
                <div class="row g-2 justify-content-start">
                    @foreach ($technologies as $technology)
                        <div class="col">
                            <input type="checkbox" class="btn-check" id="technology_{{ $technology->id }}"
                                name="technologies[]" value="{{ $technology->id }}" autocomplete="off"
                                @checked(in_array($technology->id, old('technologies', [])))>
                            <label class="btn btn-outline-primary" for="technology_{{ $technology->id }}">
                                {{ $technology->technology_name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('technologies')
                <p class="text-danger">{{ $message }}</p>
            @enderror


            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                    class="form-control @error('description') is-invalid @enderror  @if (!empty(old('description')) && !$errors->has('description')) is-valid @endif"
                    id="description" name="description" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            @include('admin.projects.partials.submit-btn')
            @include('admin.projects.partials.back-btn')
            @include('admin.projects.partials.projects-btn')
        </form>
    </div>
@endsection
