<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    public function index(Request $request)
    {
        // Search functionality
        $search = $request->input('search');
        
        $query = Announcement::query();
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
            // $query->orWhere('description', 'like', "%{$search}%");
            $query->orWhere('date', 'like', "%{$search}%");
        }

        $announcements = $query->orderBy('date', 'asc')->get();

        // Separate Upcoming and Past Announcements
        $upcoming = $announcements->where('date', '>=', now()->toDateString());
        $past = $announcements->where('date', '<', now()->toDateString());

        return view('farmer.announcements.index', compact('upcoming', 'past', 'search'));
    }

    public function show(Announcement $announcement)
    {
        return view('farmer.announcements.show', compact('announcement'));
    }
}
