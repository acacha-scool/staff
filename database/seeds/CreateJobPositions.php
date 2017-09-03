<?php

use Illuminate\Database\Seeder;

/**
 * Class CreateJobPositions.
 */
class CreateJobPositions extends Seeder
{
    /**
     * Run the database permission seeds.
     *
     * @return void
     */
    public function run()
    {
            seed_job_positions();
    }
}
