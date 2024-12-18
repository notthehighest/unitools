<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowEquipment;
use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::with('category')->get();
        return view('admin.equipment.index', compact('equipment'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.equipment.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $picturePath = $request->file('picture') ? $request->file('picture')->store('equipment') : null;

        Equipment::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'picture' => $picturePath,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('equipment.index')->with('success', 'Equipment created successfully.');
    }

    public function edit(Equipment $equipment)
    {
        $categories = Category::all();
        return view('admin.equipment.edit', compact('equipment', 'categories'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('picture')) {
            if ($equipment->picture) {
                Storage::delete($equipment->picture);
            }
            $equipment->picture = $request->file('picture')->store('equipment');
        }

        $equipment->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'picture' => $equipment->picture,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully.');
        }

        public function destroy(Equipment $equipment)
        {
            if ($equipment->picture) {
                Storage::delete($equipment->picture);
            }
            $equipment->delete();
            return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully.');
        }

}
