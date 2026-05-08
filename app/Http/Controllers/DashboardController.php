<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\TherapySession;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalActivePatients = Patient::where('care_status', 'ativo')->count();
        $totalScheduledSessions = TherapySession::where('session_status', 'marcada')->count();
        $totalCompletedSessions = TherapySession::where('session_status', 'realizada')->count();

        $upcomingSessions = TherapySession::with('patient')
            ->whereDate('session_date', '>=', now()->toDateString())
            ->orderBy('session_date')
            ->orderBy('session_time')
            ->limit(5)
            ->get();

        $latestPatients = Patient::latest()->limit(5)->get();

        return view('dashboard.index', compact(
            'totalPatients',
            'totalActivePatients',
            'totalScheduledSessions',
            'totalCompletedSessions',
            'upcomingSessions',
            'latestPatients'
        ));
    }
}
