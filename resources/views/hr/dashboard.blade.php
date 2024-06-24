@extends('layouts.app')

@section('content')
<div class="container">
    <h1>HR Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Approved Goal Sheets</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Task Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Duration (hours)</th>
                                <th scope="col">Assessment</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvedGoals as $goal)
                            <tr>
                                <td>{{ $goal->task_name }}</td>
                                <td>{{ $goal->description }}</td>
                                <td>{{ $goal->duration }}</td>
                                <td>{{ $goal->assessment ?? 'Pending' }}</td>
                                <td>
                                    <form action="{{ route('goals.finalize', ['goal' => $goal]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="assessment">Assessment</label>
                                            <input type="text" name="assessment" id="assessment" class="form-control" value="{{ $goal->assessment }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2">Finalize</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
