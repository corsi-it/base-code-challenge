<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'name' => 'Ferrari F40',
                'image' => '/assets/images/cars/F40-ferrari.jpg',
                'price' => '2467459.00',
                'description' => 'The Ferrari F40 (Type F120) is a mid-engine, rear-wheel drive sports car engineered by Nicola Materazzi with styling by Pininfarina. It was built from 1987 until 1992, with the LM and GTE race car versions continuing production until 1994 and 1996 respectively.',
                'category_id' => '4',
            ],
            [
                'name' => 'Enzo Ferrari',
                'image' => '/assets/images/cars/enco-ferrari.jpg',
                'price' => '3376277.00',
                'description' => "The Enzo's engine was a completely new 65° V12 that drew on Ferrari's F1 experience and as a result featured some unique technical solutions. It had an overall displacement of 5998 cc, a maximum power output of 660 hp at 7800 rpm and maximum torque of 67 kgm at 5500 rpm.",
                'category_id' => '4',
            ],
            [
                'name' => 'BMW M6',
                'image' => '/assets/images/cars/bmw.jpg',
                'price' => '119900.00',
                'description' => "The base trim levels of the 2023 BMW M6 for sale are powered by a 567-horsepower 4.4-liter Twin-Turbo V8 engine that delivers 502 lb-ft of torque and pairs with either a 7-speed automatic transmission or a 6-speed manual transmission. All trims feature adaptive suspension dampers, too.",
                'category_id' => '1',
            ],
            [
                'name' => 'Audi Rs7',
                'image' => '/assets/images/cars/audi-rs7.jpg',
                'price' => '156695.00',
                'description' => "Overview. With coupe-like styling, SUV-like utility and blazing speed, the 2024 Audi RS 7 offers a unique combination of fun and functionality. Four doors and five seats mask its family-sedan roots, while a 621-hp turbocharged V8 signals supercar ability, propelling the RS 7 from 0 to 60 mph in about 3 seconds.",
                'category_id' => '2',
            ],
            [
                'name' => 'Audi R8',
                'image' => '/assets/images/cars/audi.jpg',
                'price' => '253290.00',
                'description' => "The Audi R8 is a mid-engine, 2-seater sports car, which uses Audi's trademark quattro permanent all-wheel drive system. It was introduced by the German car manufacturer Audi AG in 2006. Production ended in 2023.",
                'category_id' => '2',
            ],
            [
                'name' => 'Mercedes C63 AMG',
                'image' => '/assets/images/cars/mercedes.jpg',
                'price' => '95000.00',
                'description' => "It is equipped with a 3.0-liter V6 engine that produces 390 horsepower and 520 Nm of torque and comes with a 9-speed automatic transmission and all-wheel drive as standard.",
                'category_id' => '5',
            ],
            [
                'name' => 'Subaru WRX STI',
                'image' => '/assets/images/cars/subaru.jpg',
                'price' => '37245.00',
                'description' => "The 2021 Subaru WRX STI features sport-tuned suspension, speed-sensing steering and the Subaru Symmetrical All-Wheel Drive, which is one of the highest-rated all-wheel drive systems by consumers and experienced motorists alike.",
                'category_id' => '3',
            ],
        ];
        //
        foreach ($cars as $car){
            Inventory::create($car);
        }
    }
}
