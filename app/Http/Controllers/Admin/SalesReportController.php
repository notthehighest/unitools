<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowedEquipment;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // Filters
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();
        $equipmentId = $request->input('equipment_id');

        // Query for total and monthly sales
        $query = BorrowedEquipment::selectRaw('SUM(equipment.price) as total_sales')
            ->join('equipment', 'borrowed_equipment.equipment_id', '=', 'equipment.id')
            ->where('borrowed_equipment.status', 'approved')
            ->whereBetween('borrowed_equipment.updated_at', [$startDate, $endDate]);

        if ($equipmentId) {
            $query->where('borrowed_equipment.equipment_id', $equipmentId);
        }

        $totalSales = $query->value('total_sales') ?: 0;

        // Monthly Sales (grouped by month)
        $monthlySales = BorrowedEquipment::selectRaw('YEAR(borrowed_equipment.updated_at) as year, MONTH(borrowed_equipment.updated_at) as month, SUM(equipment.price) as monthly_sales')
            ->join('equipment', 'borrowed_equipment.equipment_id', '=', 'equipment.id')
            ->where('borrowed_equipment.status', 'approved')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Table Data: Sales per Equipment
        $equipmentSales = BorrowedEquipment::selectRaw('equipment.name as equipment_name, equipment.price as equipment_price, COUNT(borrowed_equipment.id) as total_borrowed, SUM(equipment.price) as total_sales')
            ->join('equipment', 'borrowed_equipment.equipment_id', '=', 'equipment.id')
            ->where('borrowed_equipment.status', 'approved')
            ->groupBy('equipment.id', 'equipment.name', 'equipment.price')
            ->orderBy('total_sales', 'desc')
            ->get();

        $equipments = Equipment::all();

        return view('admin.sales_report.index', compact('totalSales', 'monthlySales', 'equipmentSales', 'equipments', 'startDate', 'endDate', 'equipmentId'));
    }
}