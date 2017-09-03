<?php

use Spatie\Permission\PermissionRegistrar;

if (! function_exists('initialize_staff_management_permissions')) {
    function initialize_staff_management_permissions()
    {
        $manageStaff = role_first_or_create('manage-staff');

        //STAFF MANAGEMENT
        permission_first_or_create('assign-user-to-teacher');

        give_permission_to_role($manageStaff,'assign-user-to-teacher');

        app(PermissionRegistrar::class)->registerPermissions();

    }
}

