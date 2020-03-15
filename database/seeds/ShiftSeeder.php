<?php

use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\Shift;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $staff =  Staff::create([
            'name'=>'support',
            'nrc' => '9/MaHaMa(N)058537'
        ]);

        Shift::create([
            'start_time' => '13:00',
            'end_time' => '17:00',
            'staff_id' =>$staff->id
        ]);
    }
}
