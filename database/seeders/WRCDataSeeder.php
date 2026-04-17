<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WRCDataSeeder extends Seeder
{
    public function run(): void
    {
        $rallies = [
            [
                'rally_name' => 'Rally Croatia',
                'country' => 'Croatia',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Stojdraga', 'distance_km' => 10.24],
                    ['stage_number' => 2, 'stage_name' => 'Hartje', 'distance_km' => 7.79],
                    ['stage_number' => 3, 'stage_name' => 'Krašić', 'distance_km' => 8.77],
                    
                ]
            ],
            [
                'rally_name' => 'Rally Estonia',
                'country' => 'Estonia',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Nüpli', 'distance_km' => 8.60],
                    ['stage_number' => 2, 'stage_name' => 'Koigu', 'distance_km' => 8.47],
                    ['stage_number' => 3, 'stage_name' => 'Vahessaare', 'distance_km' => 8.60],
                    ['stage_number' => 4, 'stage_name' => 'Vissi', 'distance_km' => 11.82],
                ]
            ],
            [
                'rally_name' => 'Central European Rally',
                'country' => 'Czech Republic',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Vítová', 'distance_km' => 8.77],
                    ['stage_number' => 2, 'stage_name' => 'Líbošvary', 'distance_km' => 14.73],
                    ['stage_number' => 3, 'stage_name' => 'Osičko', 'distance_km' => 8.94],
                    
                    
                ]
            ],
            [
                'rally_name' => 'Rally Finland',
                'country' => 'Finland',
                'total_distance' => null,
                'stages' => [
                    
                    ['stage_number' => 1, 'stage_name' => 'Honkanen', 'distance_km' => 10.41],
                    ['stage_number' => 2, 'stage_name' => 'Vehmas', 'distance_km' => 12.57],
                    ['stage_number' => 3, 'stage_name' => 'Saakoski', 'distance_km' => 4.83],
                    ['stage_number' => 4, 'stage_name' => 'Painaa', 'distance_km' => 6.41],
                    
                    
                ]
            ],
            [
                'rally_name' => 'EKO Acropolis Rally Greece',
                'country' => 'Greece',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Mariolata', 'distance_km' => 13.51],
                    ['stage_number' => 2, 'stage_name' => 'Viniani', 'distance_km' => 11.12],
                    ['stage_number' => 3, 'stage_name' => 'Parnassos', 'distance_km' => 5.57],
                    ['stage_number' => 4, 'stage_name' => 'Drosochori', 'distance_km' => 8.68],
                    
                ]
            ],
            [
                'rally_name' => 'Forum8 Rally Japan',
                'country' => 'Japan',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Oninokotaira', 'distance_km' => 11.38],
                    ['stage_number' => 2, 'stage_name' => 'Habu Dam', 'distance_km' => 10.27],
                    ['stage_number' => 3, 'stage_name' => 'Higashino', 'distance_km' => 6.96],
                    ['stage_number' => 4, 'stage_name' => 'Nenoue Highlands', 'distance_km' => 6.81],
                    
                ]
            ],
            [
                'rally_name' => 'Safari Rally Kenya',
                'country' => 'Kenya',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Moi North', 'distance_km' => 5.46],
                    ['stage_number' => 2, 'stage_name' => 'Wileli', 'distance_km' => 4.92],
                    ['stage_number' => 3, 'stage_name' => 'Sugunoi', 'distance_km' => 9.74],
                    ['stage_number' => 4, 'stage_name' => 'Kanyawa', 'distance_km' => 10.70],
                ]
            ],
            [
                'rally_name' => 'Rally Guanajuato México',
                'country' => 'Mexico',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Ortega', 'distance_km' => 13.10],
                    ['stage_number' => 2, 'stage_name' => 'Ibarrilla', 'distance_km' => 12.92],
                    ['stage_number' => 3, 'stage_name' => 'Alfaro', 'distance_km' => 8.00],
                
                ]
            ],
            [
                'rally_name' => 'Rallye Monte-Carlo',
                'country' => 'Monaco',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'La Bollène Vésubie - Col De Turini', 'distance_km' => 9.21],
                    ['stage_number' => 2, 'stage_name' => 'La Maïris', 'distance_km' => 9.30],
                    ['stage_number' => 3, 'stage_name' => 'La Moissière', 'distance_km' => 8.18],
                    ['stage_number' => 4, 'stage_name' => 'Ravin de Coste Belle', 'distance_km' => 8.60],
                ]
            ],
            [
                'rally_name' => 'Vodafone Rally de Portugal',
                'country' => 'Portugal',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Fridão', 'distance_km' => 16.72],
                    ['stage_number' => 2, 'stage_name' => 'Touca', 'distance_km' => 7.51],
                    ['stage_number' => 3, 'stage_name' => 'Carrazedo de Montenegro', 'distance_km' => 7.48],
                ]
            ],
            [
                'rally_name' => 'Rally Italia Sardegna',
                'country' => 'Italy',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Littichedda', 'distance_km' => 13.30],
                    ['stage_number' => 2, 'stage_name' => 'Bortigiadas', 'distance_km' => 9.02],
                    ['stage_number' => 3, 'stage_name' => 'Monte Muvri', 'distance_km' => 7.51],
            
                ]
            ],
            [
                'rally_name' => 'Rally Sweden',
                'country' => 'Sweden',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Spikbrenna', 'distance_km' => 11.07],
                    ['stage_number' => 2, 'stage_name' => 'Åslia', 'distance_km' => 10.39],
                    ['stage_number' => 3, 'stage_name' => 'Älgsjön', 'distance_km' => 3.37],
                    ['stage_number' => 4, 'stage_name' => 'Stora Jangen', 'distance_km' => 4.86],
                ]
            ],
        ];

        foreach ($rallies as $rallyData) {
            $stages = $rallyData['stages'];
            unset($rallyData['stages']);
            
            $rallyId = DB::table('rallies')->insertGetId($rallyData);
            
            foreach ($stages as $stage) {
                $stage['rally_id'] = $rallyId;
                $stage['created_at'] = now();
                $stage['updated_at'] = now();
                DB::table('stages')->insert($stage);
            }
        }
        
        $this->command->info('WRC rallies and stages seeded successfully!');
    }
}