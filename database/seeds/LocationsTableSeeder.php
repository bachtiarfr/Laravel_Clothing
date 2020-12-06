<?php

use Illuminate\Database\Seeder;
use App\Province;
use App\City;
use Kavist\RajaOngkir\Facades\RajaOngkir;


class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProfinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProfinsi as $proviceRow) {
            Province::create([
                'provinces_id' => $proviceRow['province_id'],
                'title' => $proviceRow['province']
            ]);

            $daftarKota = RajaOngkir::kota()->dariProvinsi($proviceRow['province_id'])->get();
            foreach ($daftarKota as $cityRow) {
                City::create([
                    'provinces_id' => $proviceRow['province_id'],
                    'city_id' => $cityRow['city_id'],
                    'title' => $cityRow['city_name']
                ]);
            }
        }
    }
}
