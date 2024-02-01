@extends('layouts.admin')

@section('content')
    <div class="container my-5">

        <form action="{{ route('admin.technologies.store') }}" method="POST">
            @csrf


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

    </div>
@endsection
