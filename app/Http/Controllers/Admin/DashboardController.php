<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowedEquipment;
use App\Models\User;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total number of farmers
        $totalFarmers = User::where('role', 'farmer')->count();

        // Total pending borrowed equipment
        $totalPending = BorrowedEquipment::where('status', 'pending')->count();

        // Total sales (sum of equipment price for approved borrowings)
        $totalSales = BorrowedEquipment::where('status', 'approved')
            ->join('equipment', 'borrowed_equipment.equipment_id', '=', 'equipment.id')
            ->sum('equipment.price');

        // Sales per equipment
        $salesPerEquipment = BorrowedEquipment::where('status', 'approved')
            ->join('equipment', 'borrowed_equipment.equipment_id', '=', 'equipment.id')
            ->select(DB::raw('equipment.name as equipment_name, SUM(equipment.price) as total_sales'))
            ->groupBy('equipment.name')
            ->get();

        // Pass data to the view
        return view('admin.dashboard', compact('totalFarmers', 'totalPending', 'totalSales', 'salesPerEquipment'));
    }
}


