<?php

use Acacha\Scool\Staff\Models\JobPosition;
use Spatie\Permission\PermissionRegistrar;

if (! function_exists('initialize_staff_management_permissions')) {
    function initialize_staff_management_permissions()
    {
        $manageStaff = role_first_or_create('manage-staff');

        //STAFF MANAGEMENT

        //  Teachers
        permission_first_or_create('assign-user-to-teacher');

//        permission_first_or_create('see-manage-users-view');
        permission_first_or_create('list-teachers');
        permission_first_or_create('create-teachers');
        permission_first_or_create('view-teachers');
        permission_first_or_create('edit-teachers');
        permission_first_or_create('delete-teachers');
        permission_first_or_create('massive-delete-teachers');

        give_permission_to_role($manageStaff,'assign-user-to-teacher');
        give_permission_to_role($manageStaff,'list-teachers');
        give_permission_to_role($manageStaff,'create-teachers');
        give_permission_to_role($manageStaff,'view-teachers');
        give_permission_to_role($manageStaff,'edit-teachers');
        give_permission_to_role($manageStaff,'delete-teachers');
        give_permission_to_role($manageStaff,'massive-delete-teachers');

        app(PermissionRegistrar::class)->registerPermissions();

    }
}

if (! function_exists('seed_job_positions')) {
    function seed_job_positions()
    {
        JobPosition::create(['name' => 'Tutora CAM']);
        JobPosition::create(['name' => 'Resp. Atenció a la diversitat']);
        JobPosition::create(['name' => 'Tutor CAS B/Resp. Biblioteca']);
        JobPosition::create(['name' => 'Coord. Mobilitat / Erasmus+']);

    }
}

