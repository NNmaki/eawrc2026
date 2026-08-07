<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rally;   // <-- tarvitset nämä mallit
use App\Models\Stage;

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
                    ['stage_number' => 1, 'stage_name' => 'Stojdraga (First Third of Bliznec Stage)', 'distance_km' => 10.24],
                    ['stage_number' => 2, 'stage_name' => 'Hartje (Second Third of Bliznec Stage)', 'distance_km' => 7.79],
                    ['stage_number' => 3, 'stage_name' => 'Krašić (Final Third of Bliznec Stage)', 'distance_km' => 8.77],
                ]
            ],
            [
                'rally_name' => 'Rally Estonia',
                'country' => 'Estonia',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Nüpli (Otepää 1st Leg)', 'distance_km' => 8.60],
                    ['stage_number' => 2, 'stage_name' => 'Koigu (Otepää 2nd Leg)', 'distance_km' => 8.47],
                    ['stage_number' => 3, 'stage_name' => 'Vahessaare (Elva 1st Leg)', 'distance_km' => 8.60],
                    ['stage_number' => 4, 'stage_name' => 'Vissi (Elva 2nd Leg)', 'distance_km' => 11.82],
                ]
            ],
            [
                'rally_name' => 'Central European Rally',
                'country' => 'Czech Republic',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Vítová (First Third of Rouske Stage)', 'distance_km' => 8.77],
                    ['stage_number' => 2, 'stage_name' => 'Líbošvary (Middle Section of Rouske Stage)', 'distance_km' => 14.73],
                    ['stage_number' => 3, 'stage_name' => 'Osičko (Final Third of Rouske Stage)', 'distance_km' => 8.94],
                ]
            ],
            [
                'rally_name' => 'Rally Finland',
                'country' => 'Finland',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Honkanen (Päijälä 1st Leg)', 'distance_km' => 10.41],
                    ['stage_number' => 2, 'stage_name' => 'Vehmas (Päijälä 2nd Leg)', 'distance_km' => 12.57],
                    ['stage_number' => 3, 'stage_name' => 'Saakoski (Leustu 1st Leg)', 'distance_km' => 4.83],
                    ['stage_number' => 4, 'stage_name' => 'Painaa (Leustu 2nd Leg)', 'distance_km' => 6.41],
                ]
            ],
            [
                'rally_name' => 'EKO Acropolis Rally Greece',
                'country' => 'Greece',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Mariolata (First Half of Gravia Stage)', 'distance_km' => 13.51],
                    ['stage_number' => 2, 'stage_name' => 'Viniani (Second Half of Gravia Stage)', 'distance_km' => 11.12],
                    ['stage_number' => 3, 'stage_name' => 'Parnassos (First Half of Eptalofos Stage)', 'distance_km' => 5.57],
                    ['stage_number' => 4, 'stage_name' => 'Drosochori (Second Half of Eptalofos Stage)', 'distance_km' => 8.68],
                ]
            ],
            [
                'rally_name' => 'Forum8 Rally Japan',
                'country' => 'Japan',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Oninokotaira (First Half of Lake Mikawa Stage)', 'distance_km' => 11.38],
                    ['stage_number' => 2, 'stage_name' => 'Habu Dam (Second Half (And 2km Overlapped) of Lake Mikawa Stage)', 'distance_km' => 10.27],
                    ['stage_number' => 3, 'stage_name' => 'Higashino (First Half of Nenoue Plateau Stage)', 'distance_km' => 6.96],
                    ['stage_number' => 4, 'stage_name' => 'Nenoue Highlands (Second Half of Nenoue Plateau Stage)', 'distance_km' => 6.81],
                ]
            ],
            [
                'rally_name' => 'Safari Rally Kenya',
                'country' => 'Kenya',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Moi North (First Half of Malewa Stage)', 'distance_km' => 5.46],
                    ['stage_number' => 2, 'stage_name' => 'Wileli (Second Half of Malewa Stage)', 'distance_km' => 4.92],
                    ['stage_number' => 3, 'stage_name' => 'Sugunoi (First Half of Soysambu Stage)', 'distance_km' => 9.74],
                    ['stage_number' => 4, 'stage_name' => 'Kanyawa (Second Half of Soysambu Stage)', 'distance_km' => 10.70],
                ]
            ],
            [
                'rally_name' => 'Rally Guanajuato México',
                'country' => 'Mexico',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Ortega (First Half of El Chocolate Stage)', 'distance_km' => 13.10],
                    ['stage_number' => 2, 'stage_name' => 'Ibarrilla (First Half of Otates Stage, But Run in the Reverse Direction)', 'distance_km' => 12.92],
                    ['stage_number' => 3, 'stage_name' => 'Alfaro (Stage Follows Otates Route in Reverse Before Turning North Past the San Pedro Church)', 'distance_km' => 8.00],
                ]
            ],
            [
                'rally_name' => 'Rallye Monte-Carlo',
                'country' => 'Monaco',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'La Bollène Vésubie - Col De Turini (La Bollene-Vesubie - Peira Cava 1st Leg)', 'distance_km' => 9.21],
                    ['stage_number' => 2, 'stage_name' => 'La Maïris (La Bollene-Vesubie - Peira Cava 2nd Leg)', 'distance_km' => 9.30],
                    ['stage_number' => 3, 'stage_name' => 'La Moissière (Saint-Leger-Les-Melezes 1st Leg)', 'distance_km' => 8.18],
                    ['stage_number' => 4, 'stage_name' => 'Ravin de Coste Belle (Saint-Leger-Les-Melezes 2nd Leg)', 'distance_km' => 8.60],
                ]
            ],
            [
                'rally_name' => 'Vodafone Rally de Portugal',
                'country' => 'Portugal',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Fridão (First Quarter of Baiao Stage)', 'distance_km' => 16.72],
                    ['stage_number' => 2, 'stage_name' => 'Touca (Second Quarter of Baiao Stage)', 'distance_km' => 7.51],
                    ['stage_number' => 3, 'stage_name' => 'Carrazedo de Montenegro (Third Quarter of Baiao Stage)', 'distance_km' => 7.48],
                ]
            ],
            [
                'rally_name' => 'Rally Italia Sardegna',
                'country' => 'Italy',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Littichedda (First Third of Rena Majore Stage)', 'distance_km' => 13.30],
                    ['stage_number' => 2, 'stage_name' => 'Bortigiadas (Second Third of Rena Majore Stage)', 'distance_km' => 9.02],
                    ['stage_number' => 3, 'stage_name' => 'Monte Muvri (Final Quarter of Rena Majore Stage)', 'distance_km' => 7.51],
                ]
            ],
            [
                'rally_name' => 'Rally Sweden',
                'country' => 'Sweden',
                'total_distance' => null,
                'stages' => [
                    ['stage_number' => 1, 'stage_name' => 'Spikbrenna (Hof-Finnskog 1st Leg)', 'distance_km' => 11.07],
                    ['stage_number' => 2, 'stage_name' => 'Åslia (Hof-Finnskog 2nd Leg)', 'distance_km' => 10.39],
                    ['stage_number' => 3, 'stage_name' => 'Älgsjön (Vargasen 1st Leg)', 'distance_km' => 3.37],
                    ['stage_number' => 4, 'stage_name' => 'Stora Jangen (Vargasen 2nd Leg)', 'distance_km' => 4.86],
                ]
            ],
        ];


        foreach ($rallies as $rallyData) {
            $stages = $rallyData['stages'];
            unset($rallyData['stages']);

            // Hae olemassa oleva tai luo uusi — EI koskaan duplikaattia
            $rally = Rally::firstOrCreate(
                ['rally_name' => $rallyData['rally_name']], // hakuehto
                $rallyData                                   // lisättävät kentät jos ei löydy
            );

            foreach ($stages as $stageData) {
                Stage::updateOrCreate(
                    [
                        'rally_id'     => $rally->id,
                        'stage_number' => $stageData['stage_number'],
                    ],
                    array_merge($stageData, ['rally_id' => $rally->id])
                );
            }
        }

        $this->command->info('WRC rallies and stages seeded successfully!');
    }
}