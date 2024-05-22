<?php

namespace Database\Seeders;

use App\Models\ShipmentStatus;
use Illuminate\Database\Seeder;

class ShipmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShipmentStatus::insert([
            'status' => 'ready for pickup',
        ]);
        ShipmentStatus::insert([
            'status' => 'picked up by courier',
        ]);
        ShipmentStatus::insert([
            'status' => 'in transit',
        ]);
        ShipmentStatus::insert([
            'status' => 'out for delivery',
        ]);
        ShipmentStatus::insert([
            'status' => 'delayed',
        ]);
        ShipmentStatus::insert([
            'status' => 'at local distribution center',
        ]);
        ShipmentStatus::insert([
            'status' => 'delivery attempt failed',
        ]);
        ShipmentStatus::insert([
            'status' => 'delivered',
        ]);
        ShipmentStatus::insert([
            'status' => 'cancelled',
        ]);
    }
}
