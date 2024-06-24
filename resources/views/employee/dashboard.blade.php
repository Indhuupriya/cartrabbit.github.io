@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Employee Dashboard</h1>
        <a href="{{ route('goals.create') }}" class="btn btn-primary">Create Task</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Your Goals</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Task Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Duration (hours)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Feedback</th>
                                <th scope="col">Self-Assessment</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($goals as $goal)
                            <tr>
                                <td>{{ $goal->task_name }}</td>
                                <td>{{ $goal->description }}</td>
                                <td>{{ $goal->duration }}</td>
                                <td>{{ $goal->status }}</td>
                                <td>{{ $goal->feedback }}</td>
                                @if($goal->manager_assessment != '')
                                <td>{{ $goal->manager_assessment }}/5</td>
                                @else
                                <td>0/5</td>
                                @endif
                                <td>
                                    @if($goal->status == 'canceled' || $goal->status == 'postponed' || $goal->status == 'overdue')
                                        <a href="{{ route('goals.showResubmitForm', ['goal' => $goal]) }}" class="btn btn-primary">Resubmit</a>
                                    @elseif($goal->status == 'completed')
                                        <span class="text-success">Final Approval Received</span>
                                    @else
                                        <span>Awaiting Review</span>
                                    @endif
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
