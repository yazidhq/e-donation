<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ShipmentStatus;

class ShipmentStatusController extends Controller
{
    public function index()
    {
        $shipment_status = ShipmentStatus::get();
        return view("admin.shipment_status", compact("shipment_status"));
    }

    public function store(Request $request)
    {
        ShipmentStatus::create(["status" => Str::lower($request->status)]);
        return redirect()->back()->with('shipment_status', 'The shipment status has been created successfully!');
    }

    public function update(Request $request, string $id)
    {
        ShipmentStatus::where('id', $id)->update(["status" => $request->status]);
        return redirect()->back()->with('shipment_status', 'The shipment status has been updated successfully!');
    }

    public function destroy(string $id)
    {
        ShipmentStatus::where('id', $id)->delete();
        return redirect()->back()->with('shipment_status', 'The shipment status has been deleted successfully!');
    }
}
