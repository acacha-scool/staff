<?php

use Illuminate\Database\Seeder;

/**
 * Class CreateStaffManagementPermissions.
 */
class CreateStaffManagementPermissions extends Seeder
{
    /**
     * Run the database permission seeds.
     *
     * @return void
     */
    public function run()
    {
        initialize_staff_management_permissions();
    }
}
