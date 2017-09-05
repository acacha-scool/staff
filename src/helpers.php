<?php

use Acacha\Scool\Staff\Models\AdministrativeStatus;
use Acacha\Scool\Staff\Models\Position;
use Acacha\Scool\Staff\Models\Teacher;
use Acacha\Scool\Staff\Models\Vacancy;
use App\User;
use Scool\Curriculum\Models\Speciality;
use Spatie\Permission\PermissionRegistrar;

if (! function_exists('initialize_staff_management_permissions')) {

    /**
     * Initialize staff management permissions and roles.
     */
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

if (! function_exists('position_first_or_create')) {
    /**
     * Create position if not exists and return new o already existing position.
     */
    function position_first_or_create($name)
    {
        try {
            return Position::create(['name' => $name]);
        } catch (Illuminate\Database\QueryException $e) {
            return Position::where('name', $name);
        }
    }
}

if (! function_exists('seed_positions')) {
    /**
     * Seed positions.
     */
    function seed_positions()
    {
        position_first_or_create('Tutora CAM');
        position_first_or_create('Resp. Atenció a la diversitat');
        position_first_or_create('Tutor CAS B');
        position_first_or_create('Resp. Biblioteca');
        position_first_or_create('Coord. Mobilitat / Erasmus+');
    }
}

if (! function_exists('teacher_first_or_create')) {
    /**
     * Create teacher if not exists and return new o already existing teacher.
     */
    function teacher_first_or_create($code, $state,  $specialityId, $positionIds = null)
    {
        try {
            $teacher = Teacher::create([
                'code' => $code,
                'state' => $state,
                'speciality_id' => $specialityId,
            ]);

            if ($positionIds) $teacher->positions()->sync($positionIds);

            return $teacher;
        } catch (Illuminate\Database\QueryException $e) {
            return Teacher::where([
                ['code', '=', $code]
            ]);
        }
    }
}

if (! function_exists('obtainSpecialityIdByCode')) {
    /**
     * Obtain speciality by code.
     */
    function obtainSpecialityIdByCode($code)
    {
        return Speciality::where('code', $code)->first()->id;
    }
}

if (! function_exists('obtainPositionIdByName')) {
    /**
     * Obtain position by name.
     */
    function obtainPositionIdByName($name)
    {
        return Position::where('name', $name)->first()->id;
    }
}

if (! function_exists('administrative_statuses_first_or_create')) {
    /**
     * Create administrative status if not exists and return new o already existing status.
     */
    function administrative_statuses_first_or_create($code, $name)
    {
        try {
            $status = AdministrativeStatus::create([
                'code' => $code,
                'name' => $name
            ]);

            return $status;
        } catch (Illuminate\Database\QueryException $e) {
            return AdministrativeStatus::where([
                ['code', '=', $code]
            ]);
        }
    }
}

if (! function_exists('seed_administrative_statuses')) {
    /**
     * Seed administrative statuses for teachers.
     */
    function seed_administrative_statuses()
    {
        administrative_statuses_first_or_create('F','Funcionari/a amb plaça definitiva');
        administrative_statuses_first_or_create('FProv','Funcionari/a propietari provisional');
        administrative_statuses_first_or_create('FP','Funcionari/a en pràctiques');
        administrative_statuses_first_or_create('CS','Comissió de serveis');
        administrative_statuses_first_or_create('I','Interí/na');
        administrative_statuses_first_or_create('S','Substitut/Substituta');
        administrative_statuses_first_or_create('E','Expert/a');
    }
}

if (! function_exists('vacancy_first_or_create')) {
    /**
     * Seed teacher vacancies.
     */
    function vacancy_first_or_create($code, $state, $speciality)
    {
        try {
            $vacancy = Vacancy::create([
                'code' => $code,
                'state' => $state,
                'speciality_id' => $speciality->id,
            ]);

            return $vacancy;
        } catch (Illuminate\Database\QueryException $e) {
            return Vacancy::where([
                ['code', '=', $code]
            ]);
        }
    }
}

if (! function_exists('seed_vacancies')) {
    /**
     * Seed teacher vacancies.
     */
    function seed_vacancies()
    {
        vacancy_first_or_create('LLE_1', 'pending', obtainSpecialityIdByCode('CAS'));
        vacancy_first_or_create('FOL_1', 'pending', obtainSpecialityIdByCode('505'));
        vacancy_first_or_create('LLE_2', 'pending', obtainSpecialityIdByCode('AN'));
        vacancy_first_or_create('LLE_3', 'pending', obtainSpecialityIdByCode('AN'));
        vacancy_first_or_create('LLE_4', 'pending', obtainSpecialityIdByCode('AN'));
        vacancy_first_or_create('LLE_5', 'pending', obtainSpecialityIdByCode('AN'));
        vacancy_first_or_create('LLE_2', 'pending', obtainSpecialityIdByCode('MA'));
        vacancy_first_or_create('INF_3', 'pending', obtainSpecialityIdByCode('507'));
    }
}

if (! function_exists('seed_teachers')) {
    /**
     * Seed teachers.
     */
    function seed_teachers()
    {
        seed_specialities();
        seed_positions();
        seed_administrative_statuses();
        seed_vacancies();

        //TODO
        // Qualifications -> Assign specialities to teachers. Define the main speciality
        // Charges -> Assign positions to users.
        // Teacher procedure:
        // Assign user-id to teacher
        // Assign vacancy to a teacher (set user_id to vacancy vacancy state pending -> assigned)
        // Assign qualifications (specialities to teacher)
        // Assign administrative status to teacher
        // Assign formation to teacher
        teacher_first_or_create(
            '02',
            'active',
            obtainSpecialityIdByCode('CAS'),
            [
                obtainPositionIdByName('Tutora CAM')
            ]
        );
        teacher_first_or_create(
            '03',
            'active',
            obtainSpecialityIdByCode('505'),
            [
                obtainPositionIdByName('Resp. Atenció a la diversitat')
            ]
        );
        teacher_first_or_create(
            '04',
            'active',
            obtainSpecialityIdByCode('AN')
        );
        teacher_first_or_create(
            '05',
            'active',
            obtainSpecialityIdByCode('AN'),
            [
                obtainPositionIdByName('Tutor CAS B'),
                obtainPositionIdByName('Resp. Biblioteca'),
            ]
        );
        teacher_first_or_create(
            '06',
            'active',
            obtainSpecialityIdByCode('AN'),
            [
                obtainPositionIdByName('Coord. Mobilitat / Erasmus+')
            ]
        );

    }
}

if (! function_exists('first_user_as_staff_manager')) {
    /**
     * Seed teachers.
     */
    function first_user_as_staff_manager()
    {
        initialize_staff_management_permissions();
        $user = User::all()->first();
        $user->assignRole('manage-staff');
    }
}

