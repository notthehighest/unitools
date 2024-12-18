<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowedEquipment;
use Illuminate\Http\Request;
use App\Mail\BorrowRequestStatusMail;
use Illuminate\Support\Facades\Mail;

class BorrowedEquipmentController extends Controller
{
    public function index(Request $request)
    {
        // Get search parameters
        $search = $request->input('search');

        // Query for borrowed equipment
        $pending = BorrowedEquipment::with('equipment', 'user')
            ->where('status', 'pending');

        $approved = BorrowedEquipment::with('equipment', 'user')
            ->where('status', 'approved');

        $rejected = BorrowedEquipment::with('equipment', 'user')
            ->where('status', 'rejected');

        // Apply search filter to all queries
        if ($search) {
            $pending->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('equipment', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });

            $approved->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('equipment', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });

            $rejected->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('equipment', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Paginate results
        $pending = $pending->paginate(10);
        $approved = $approved->paginate(10);
        $rejected = $rejected->paginate(10);

        return view('admin.borrowed_equipment.index', compact('pending', 'approved', 'rejected', 'search'));
    }

    public function update(Request $request, BorrowedEquipment $borrowedEquipment)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Update the status
        $borrowedEquipment->update(['status' => $request->status]);

        // Get details for the email
        $userName = $borrowedEquipment->user->name;
        $userEmail = $borrowedEquipment->user->email;
        $equipmentName = $borrowedEquipment->equipment->name;
        $borrowedDate = $borrowedEquipment->borrowed_date;
        $status = $request->status;

        // Send email notification to the user
        Mail::to($userEmail)->send(new BorrowRequestStatusMail($userName, $equipmentName, $borrowedDate, $status));

        return redirect()->route('borrowed_equipment.index')->with('success', 'Borrow request status updated and user notified successfully.');
    }
}
