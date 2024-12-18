<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\BorrowedEquipment;
use App\Models\Announcement;
use App\Models\Equipment;
use App\Models\Service; // Import the Service model
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $farmerId = Auth::id(); // Get the currently logged-in farmer's ID

        // Retrieve the counts of borrowed equipment by status
        $totalPending = BorrowedEquipment::where('user_id', $farmerId)->where('status', 'pending')->count();
        $totalApproved = BorrowedEquipment::where('user_id', $farmerId)->where('status', 'approved')->count();
        $totalRejected = BorrowedEquipment::where('user_id', $farmerId)->where('status', 'rejected')->count();

        // Retrieve the nearest announcement date
        $nearestAnnouncement = Announcement::where('date', '>=', now())->orderBy('date', 'asc')->first();

        // Retrieve all equipment with prices
        $equipmentWithPrices = Equipment::whereNotNull('price')->get();

        $associationInfo = "The Pagkakaisa Farmer’s Association is a community-based organization in Barangay Pagkakaisa, Naujan dedicated to improving the livelihoods of local farmers. Their mission is to promote sustainable agriculture, provide access to modern farming techniques, and empower farmers through educational initiatives and resource-sharing.";

        // Information about borrowing equipment
        $borrowingInfo = "Farmers can borrow equipment to enhance their agricultural productivity. This program aims to ensure that all members have access to the tools they need to maximize their crop yields and reduce manual labor. Equipment borrowing is subject to availability and must follow the guidelines set by the association.";

        // Pass the data to the view
        return view('farmer.dashboard', [
            'totalPending' => $totalPending,
            'totalApproved' => $totalApproved,
            'totalRejected' => $totalRejected,
            'nearestAnnouncement' => $nearestAnnouncement,
            'equipmentWithPrices' => $equipmentWithPrices,
            'associationInfo' => $associationInfo,
            'borrowingInfo' => $borrowingInfo,
        ]);
    }

    public function services()
    {

    }
}
