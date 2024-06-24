@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Resubmit Goal</h1>
                    <form action="{{ route('goals.resubmit', ['goal' => $goal]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="task_name">Task Name</label>
                            <input type="text" class="form-control" id="task_name" name="task_name" value="{{ $goal->task_name }}"  required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required>{{ $goal->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration (hours)</label>
                            <input type="number" name="duration" id="duration" class="form-control" value="{{ $goal->duration }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
