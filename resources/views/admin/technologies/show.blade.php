@extends('layouts.admin')

@section('content')
    <div class="container my-5">

        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <h3>Name: {{ $technology->technology_name }}</h3>
        <h3>Hex Color: <span class="badge"
                style="background-color: {{ $technology->hex_color }}">{{ $technology->hex_color }}</span> </h3>
        <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fa-solid fa-backward"></i></a>
    </div>

    <h3>Edit technology</h3>

    <form action="{{ route('admin.technologies.update', ['technology' => $technology->slug]) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="mb-3 w-25">
            <label for="technology_name" class="form-label">Technology Name</label>
            <input type="text"
                class="form-control @error('technology_name') is-invalid @enderror @if (!empty(old('technology_name')) && !$errors->has('technology_name')) is-valid @endif"
                id="technology_name" name="technology_name" value="{{ old('technology_name') }}">
            @error('technology_name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 w-25">
            <label for="hex_color" class="form-label">Hex Color</label>
            <input type="text"
                class="form-control mb-3 @error('hex_color') is-invalid @enderror @if (!empty(old('hex_color')) && !$errors->has('hex_color')) is-valid @endif"
                id="hex_color" name="hex_color" value="{{ old('hex_color') }}">
               <a href="https://www.color-hex.com/" target="_blank">find your favourite hex color here</a>
            @error('hex_color')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn btn-success" type="submit">send</button>
    </form>
@endsection
