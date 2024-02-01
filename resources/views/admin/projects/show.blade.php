@extends('layouts.admin')


@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success my-5">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container my-5">

        @if ($project->cover_image)
            <div class="my-4">
                <img class="ms_show-image" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
            </div>
        @else
            <p class="mt-4">Nessuna immagine presente</p>
        @endif

        <p><span class="fw-bold">Name</span>: {{ $project->name }}</p>
        <p><span class="fw-bold">Slug</span>: {{ $project->slug }}</p>
        <div class="my-2"><span class="fw-bold">Technologies</span>: @foreach ($project->technologies as $technology)
              <span class="badge fs-6" style="background-color: {{ $technology->hex_color }}"> {{ $technology->technology_name }}</span>
            @endforeach
        </div>
        <p><span class="fw-bold">Description</span>: {{ $project->description }}</p>
        <p><span class="fw-bold">Type</span>: {{ $project->type ? $project->type->name : 'no type' }}</p>

        {{-- btns --}}
        <div class="d-flex gap-3 align-items-center">
            @include('admin.projects.partials.back-btn') {{-- back btn --}}
            @include('admin.projects.partials.delete-btn') {{-- delete btn --}}
            @include('admin.projects.partials.edit-btn') {{-- edit btn --}}
            @include('admin.projects.partials.projects-btn') {{-- projects btn --}}
        </div>
        {{-- /btns --}}

    </div>
    @include('partials.delete_modal')
@endsection
