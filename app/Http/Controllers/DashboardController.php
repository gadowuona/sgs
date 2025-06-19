<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        if (Auth::user()->role === 'USR') {
            return $this->StudentDashboard();
        }
        return view('dashboard');
    }

    private function StudentDashboard()
    {
        $user = Auth::user();
        $student = $user->student;
        $thesis = $student->thesis->load(['supervisors', 'timelines']);
        // dd($student, $user, $thesis);
        return view('student.dashboard', compact('user', 'student', 'thesis'));
    }
}
