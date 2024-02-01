@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <h3>Edit Project</h3>
        <form action="{{ route('admin.types.store') }}" method="POST">
            @csrf

            <div class="mb-3 w-25">
                <label for="name" class="form-label">Type Name</label>
                <input type="text"
                    class="form-control @error('name') is-invalid @enderror @if (!empty(old('name')) && !$errors->has('name')) is-valid @endif"
                    id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-success" type="submit">send</button>
        </form>
    </div>
@endsection
