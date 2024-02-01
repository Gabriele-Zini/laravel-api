@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h4> Hello {{ Auth::user()->name }} you are logged in!</h4>

                        @if (count(Auth::user()->projects) === 1)
                            <h4>You have {{ count(Auth::user()->projects) }} project:</h4>
                            @foreach (Auth::user()->projects as $project)
                                <li><a
                                        href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">{{ $project->name }}</a>
                                </li>
                            @endforeach
                        @elseif(count(Auth::user()->projects) > 1)
                            <h4>You have {{ count(Auth::user()->projects) }} projects:</h4>
                            <ol>
                                @foreach (Auth::user()->projects as $project)
                                    <li><a
                                            href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">{{ $project->name }}</a>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <h4>You don't have any project</h4>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
