@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Submitted Goal Sheets</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Duration (hours)</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($goals as $goal)
                    <tr>
                        <td>{{ $goal->task_name }}</td>
                        <td>{{ $goal->description }}</td>
                        <td>{{ $goal->duration }}</td>
                        <td>{{ $goal->status }}</td>
                        <td>
                            <a href="{{ route('goals.review', ['goal' => $goal]) }}" class="btn btn-primary">Review</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
