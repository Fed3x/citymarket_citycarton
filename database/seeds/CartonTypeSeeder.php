<?php

use Illuminate\Database\Seeder;
use App\CartonType;
use Carbon\Carbon;

class CartonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carton_type = New CartonType;
        $carton_type->description = 'SENETÉ';
        $carton_type->save();

        $carton_type = New CartonType;
        $carton_type->description = 'TELEBINGO';
        $carton_type->save();
    }
}
