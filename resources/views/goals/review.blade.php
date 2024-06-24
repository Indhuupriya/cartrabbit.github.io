@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Review Goal Sheet</h1>
                    <h5 class="card-subtitle mb-2 text-muted">{{ $goal->task_name }}</h5>
                    <p class="card-text">{{ $goal->description }}</p>
                    <p class="card-text">Duration: {{ $goal->duration }} hours</p>
                    <p class="card-text">Status: {{ $goal->status }}</p>

                    <form id="assessmentForm" action="{{ route('goals.assess', ['goal' => $goal]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status">Task Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="not started" {{ $goal->status == 'not started' ? 'selected' : '' }}>Not Started</option>
                                <option value="in progress" {{ $goal->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $goal->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="on hold" {{ $goal->status == 'on hold' ? 'selected' : '' }}>On Hold</option>
                                <option value="canceled" {{ $goal->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                <option value="postponed" {{ $goal->status == 'postponed' ? 'selected' : '' }}>Postponed</option>
                                <option value="overdue" {{ $goal->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="manager_assessment">Reporting Manager’s Assessment (out of 5)</label>
                            <select name="manager_assessment" id="manager_assessment" class="form-control" required>
                                <option value="" disabled selected>Rate out of 5</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ $goal->manager_assessment == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="feedback">Feedback</label>
                            <textarea name="feedback" id="feedback" class="form-control" required>{{ $goal->feedback }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
