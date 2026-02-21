<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function superAdmin()
    {
        $stats = [
            'users_count' => User::count(),
            'jobs_count' => JobPost::count(),
            'applications_count' => JobApplication::count(),
            'total_revenue' => Payment::where('status', 'success')->sum('amount'),
            'admin_count' => User::whereHas('role', function ($q) {
                $q->where('slug', 'admin');
            })->count(),
            'hr_count' => User::whereHas('role', function ($q) {
                $q->where('slug', 'hr');
            })->count(),
        ];

        $recentUsers = User::with('role')->latest()->take(5)->get();

        return view('super_admin.dashboard', compact('stats', 'recentUsers'));
    }

    public function admin()
    {
        $stats = [
            'active_jobs' => JobPost::where('status', 'open')->count(),
            'total_applications' => JobApplication::count(),
            'candidates_count' => User::whereHas('role', function ($q) {
                $q->where('slug', 'candidate');
            })->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function hr()
    {
        $stats = [
            'pending_applications' => JobApplication::where('status', 'Applied')->count(),
            'shortlisted_applications' => JobApplication::where('status', 'Shortlisted')->count(),
            'rejected_applications' => JobApplication::where('status', 'Rejected')->count(),
            'interview_scheduled_applications' => JobApplication::where('status', 'Interview Scheduled')->count(),
        ];

        return view('hr.dashboard', compact('stats'));
    }

    public function accountant()
    {
        $stats = [
            'total_revenue' => Payment::where('status', 'success')->sum('amount'),
            'recent_payments' => Payment::where('status', 'success')->latest()->take(5)->get(),
        ];

        return view('accountant.dashboard', compact('stats'));
    }

    public function candidate()
    {
        $user = auth()->user();
        $user->load(['candidateProfile', 'jobApplications.jobPost']);
        
        $stats = [
            'applied_jobs_count' => $user->jobApplications->count(),
            'profile_completion' => $user->candidateProfile->profile_completion_percentage ?? 0,
            'recent_applications' => $user->jobApplications()->latest()->take(5)->get(),
        ];

        $recommendedJobs = JobPost::where('status', 'open')
            ->latest()
            ->take(3)
            ->get();

        return view('candidate.dashboard', compact('user', 'stats', 'recommendedJobs'));
    }

    public function exportPayments()
    {
        if (! auth()->user()->can('payment.view')) {
            abort(403);
        }

        $payments = Payment::with('user', 'subscriptionPlan')->where('status', 'success')->get();

        $filename = 'payments_export_'.date('Ymd_His').'.csv';
        $handle = fopen('php://output', 'w');

        // CSV Header
        $columns = ['ID', 'User', 'Email', 'Plan', 'Amount', 'Date'];

        $callback = function () use ($payments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->id,
                    $payment->user->name ?? 'N/A',
                    $payment->user->email ?? 'N/A',
                    $payment->subscriptionPlan->name ?? 'N/A',
                    $payment->amount,
                    $payment->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ]);
    }
}
