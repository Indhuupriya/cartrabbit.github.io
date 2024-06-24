<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
        ]);
       
        $goal = new Goal();
        $goal->task_name = $request->task_name;
        $goal->description = $request->description;
        $goal->duration = $request->duration;
        $goal->status = "pending";
        $goal->user_id = Auth::id();
        $goal->save();

        return redirect()->route('dashboard.employee')->with('success', 'Goal has been saved waiting for approvel');
    }
    public function review(Goal $goal)
    {
        return view('goals.review', ['goal' => $goal]);
    }
    public function approve(Goal $goal)
    {
        $goal->status = 'approved';
        $goal->save();

        return redirect()->route('dashboard.manager')->with('success', 'Goal sheet approved.');
    }
    public function showResubmitForm(Goal $goal)
    {
        return view('goals.resubmit', compact('goal'));
    }

    public function resubmit(Request $request, Goal $goal)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'duration' => 'required|numeric|min:1',
        ]);

        $goal->update([
            'task_name' => $request->input('task_name'),
            'description' => $request->input('description'),
            'duration' => $request->input('duration'),
            'status' => 'pending', // Reset status to pending after resubmission
        ]);

        return redirect()->route('dashboard.employee')->with('success', 'Goal resubmitted successfully.');
    }
    public function finalize(Request $request, Goal $goal)
    {
        $request->validate([
            'assessment' => 'required|string|max:255',
        ]);

        $goal->update([
            'assessment' => $request->input('assessment'),
        ]);

        return redirect()->back()->with('success', 'Assessment finalized successfully.');
    }
    public function updateStatus(Request $request, Goal $goal)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $goal->update([
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
    public function assess(Request $request, Goal $goal)
    {
        $request->validate([
            'manager_assessment' => 'required|numeric|min:1|max:5',
            'feedback' => 'required|string|max:255',
            'status' => 'required|string',
        ]);
        $goal->update([
            'manager_assessment' => $request->input('manager_assessment'),
            'feedback' => $request->input('feedback'),
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'Assessment updated successfully.');
    }

}
