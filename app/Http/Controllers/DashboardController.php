<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Application;
use App\Models\Document;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isStaff()) {
            return $this->staffDashboard();
        } else {
            return $this->studentDashboard();
        }
    }

    private function adminDashboard()
    {
        $data = [
            'total_users' => User::count(),
            'total_students' => User::whereHas('role', fn($q) => $q->where('name', 'Student'))->count(),
            'total_announcements' => Announcement::count(),
            'total_documents' => Document::count(),
            'total_applications' => Application::count(),
            'pending_applications' => Application::where('status', 'pending')->count(),
            'recent_announcements' => Announcement::latest()->take(5)->get(),
            'recent_applications' => Application::latest()->take(5)->get(),
        ];

        return view('dashboard.admin', $data);
    }

    private function staffDashboard()
    {
        $data = [
            'total_students' => User::whereHas('role', fn($q) => $q->where('name', 'Student'))->count(),
            'pending_applications' => Application::where('status', 'pending')->count(),
            'recent_announcements' => Announcement::latest()->take(5)->get(),
            'upcoming_events' => Event::where('event_date', '>=', now())->orderBy('event_date')->take(5)->get(),
        ];

        return view('dashboard.staff', $data);
    }

    private function studentDashboard()
    {
        $user = auth()->user();
        $data = [
            'recent_results' => Result::where('student_id', $user->id)->latest()->take(5)->get(),
            'applications' => Application::where('student_id', $user->id)->latest()->take(5)->get(),
            'announcements' => Announcement::where('is_published', true)->latest()->take(5)->get(),
            'upcoming_events' => Event::where('event_date', '>=', now())->orderBy('event_date')->take(5)->get(),
        ];

        return view('dashboard.student', $data);
    }
}
