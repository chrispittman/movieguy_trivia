<?php

use Illuminate\Database\Seeder;

class PsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->truncate();

        $path = base_path().'/database/seeds/psvdata.txt';
        $fn = fopen($path,"r");

        while(! feof($fn))  {
            $line = fgets($fn);
            $parts = explode('|', $line);
            if (count($parts)<5) { continue; }
            $title = trim($parts[0]);
            $year = trim($parts[1]);
            $runtime = trim($parts[2]);
            $stars = trim($parts[3]);
            $description = trim($parts[4]);
            DB::table('reviews')->insert([
                'title' => $title,
                'year' => $year,
                'runtime' => $runtime,
                'stars' => $stars,
                'description_fulltext' => $description
            ]);
        }

        fclose($fn);
    }
}
