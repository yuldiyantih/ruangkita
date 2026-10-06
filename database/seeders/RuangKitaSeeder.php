<?php

namespace Database\Seeders;

use App\Models\ArAsset;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectArea;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RuangKitaSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // ADMIN
        // =========================
        $admin = User::updateOrCreate(
            ['email' => 'admin@ruangkita.test'],
            [
                'name' => 'Admin RuangKita',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // =========================
        // CLIENT
        // =========================
        $clientUser = User::updateOrCreate(
            ['email' => 'andi@ruangkita.test'],
            [
                'name' => 'Bapak Andi',
                'password' => Hash::make('password'),
                'role' => 'client',
                'is_active' => true,
            ]
        );

        $client = Client::updateOrCreate(
            ['user_id' => $clientUser->id],
            [
                'address' => 'Jakarta',
                'notes' => 'Client contoh RuangKita',
            ]
        );

        // =========================
        // PROJECT
        // =========================
        $project = Project::updateOrCreate(
            [
                'client_id' => $client->id,
                'project_name' => 'Renovasi Rumah Bapak Andi',
            ],
            [
                'admin_id' => $admin->id,
                'description' => 'Proyek renovasi rumah contoh untuk sistem RuangKita.',
                'location' => 'Jakarta',
                'status' => 'planning',
                'progress_percentage' => 0,
                'budget_total' => 0,
            ]
        );

        // =========================
        // PROJECT AREAS
        // =========================
        $areas = [
            [
                'area_name' => 'Ruang Tamu',
                'description' => 'Area ruang tamu rumah.',
            ],
            [
                'area_name' => 'Kamar Tidur',
                'description' => 'Area kamar tidur utama.',
            ],
            [
                'area_name' => 'Dapur',
                'description' => 'Area dapur rumah.',
            ],
        ];

        foreach ($areas as $area) {
            ProjectArea::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'area_name' => $area['area_name'],
                ],
                [
                    'description' => $area['description'],
                ]
            );
        }

        // =========================
        // AR ASSETS
        // =========================
        $arAssets = [
            [
                'name' => 'Beige',
                'asset_type' => 'color',
                'category' => 'Wall Color',
                'color_code' => '#D8C3A5',
                'is_active' => true,
            ],
            [
                'name' => 'Kayu Oak',
                'asset_type' => 'material',
                'category' => 'Wood',
                'is_active' => true,
            ],
            [
                'name' => 'Sofa Modern',
                'asset_type' => 'furniture',
                'category' => 'Living Room',
                'is_active' => true,
            ],
        ];

        foreach ($arAssets as $asset) {
            ArAsset::updateOrCreate(
                [
                    'name' => $asset['name'],
                ],
                $asset
            );
        }
    }
}
