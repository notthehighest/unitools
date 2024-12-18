<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\BorrowRequestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class BorrowedEquipmentController extends Controller
{
    public function index()
    {
        $borrowedEquipment = BorrowedEquipment::with('equipment')
            ->where('user_id', Auth::id())
            ->where('status', 'pending') // Only show pending requests
            ->get();

        foreach ($borrowedEquipment as $borrowed) {
            $borrowed->borrowed_date = Carbon::parse($borrowed->borrowed_date);
        }

        return view('farmer.borrowed_equipment.index', compact('borrowedEquipment'));
    }

    public function history()
    {
        // Fetch both approved and rejected borrowed equipment for the logged-in user
        $approvedEquipment = BorrowedEquipment::with('equipment')
            ->where('user_id', Auth::id())
            ->where('status', 'approved') // Only show approved requests
            ->get();

        $rejectedEquipment = BorrowedEquipment::with('equipment')
            ->where('user_id', Auth::id())
            ->where('status', 'rejected') // Only show rejected requests
            ->get();

        return view('farmer.borrowed_equipment.history', compact('approvedEquipment', 'rejectedEquipment'));
    }

    public function create(Equipment $equipment)
    {
        $equipment = Equipment::all();
        return view('farmer.borrowed_equipment.create', compact('equipment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'borrowed_date' => 'required|date',
        ]);

        $borrowedEquipment = BorrowedEquipment::create([
            'equipment_id' => $request->equipment_id,
            'user_id' => Auth::id(),
            'borrowed_date' => $request->borrowed_date,
            'status' => 'pending',
        ]);

        // Fetch the admin email
        $adminEmail = User::where('role', 'admin')->value('email');

        // Get details for the email
        $farmerName = Auth::user()->name;
        $equipmentName = $borrowedEquipment->equipment->name;
        $borrowedDate = $borrowedEquipment->borrowed_date;

        // Send email notification to the admin
        Mail::to($adminEmail)->send(new BorrowRequestMail($farmerName, $equipmentName, $borrowedDate));

        return redirect()->route('farmer.borrowed_equipment.index')->with('success', 'Borrow request submitted successfully.');
    }

    public function destroy(BorrowedEquipment $borrowedEquipment)
    {
        $borrowedEquipment->delete();
        return redirect()->route('farmer.borrowed_equipment.index')->with('success', 'Borrow request canceled successfully.');
    }

    public function destroyHistory(BorrowedEquipment $borrowedEquipment)
    {
        $borrowedEquipment->delete();
        return redirect()->route('farmer.borrowed_equipment.history')->with('success', 'Borrow history record deleted successfully.');
    }
}
