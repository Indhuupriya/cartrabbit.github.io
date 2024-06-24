<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;
class DashboardController extends Controller
{
    public function employee()
    {
        $goals = Auth::user()->goals()->get();

        return view('employee.dashboard', [
            'goals' => $goals,
        ]);
    }
    public function manager()
    {
        $submittedGoals = Goal::all();
        return view('manager.dashboard', ['goals' => $submittedGoals]);
    }
    public function hr()
    {
        $approvedGoals = Goal::where('status', 'completed')->get();
        return view('hr.dashboard', [
            'approvedGoals' => $approvedGoals,
        ]);
    }
}
