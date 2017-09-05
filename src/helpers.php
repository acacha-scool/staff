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
        position_first_or_create('Cap dep. Lleng. estrangeres');
        position_first_or_create('Tutor CAS A');
        position_first_or_create('Coord CAS/CAM');
        position_first_or_create('Coord. Informàtica');
    }
}

if (! function_exists('teacher_first_or_create')) {
    /**
     * Create teacher if not exists and return new o already existing teacher.
     */
    function teacher_first_or_create(
        $code,
        $user_id,
        $vacancy_id,
        $state,
        $specialities,
        $administrative_status,
        $administrative_start_year,
        $opossitions_pass_year,
        $start_date
    )
    {
        try {
            $teacher = Teacher::create([
                'code' => $code,
                'user_id' => $user_id,
                'vacancy_id' => $vacancy_id,
                'state' => $state,
                'administrative_status_id' => $administrative_status,
                'administrative_start_year' => $administrative_start_year,
                'opossitions_pass_year' => $opossitions_pass_year,
                'start_date' => $start_date
            ]);

            if ($specialities) $teacher->specialities()->sync($specialities);

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

if (! function_exists('user_teacher_first_or_create')) {
    /**
     * Seed user teachers.
     */
    function user_teacher_first_or_create($name, $email, $password = null)
    {
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password ?: $password = bcrypt('secret'),
                'remember_token' => str_random(10),
            ]);

            return $user;
        } catch (Illuminate\Database\QueryException $e) {
            return User::where([
                ['code', '=', $name]
            ]);
        }
    }
}

if (! function_exists('seed_user_teachers')) {
    /**
     * Seed user teachers.
     */
    function seed_user_teachers()
    {
        user_teacher_first_or_create('Dolors Sanjuan', 'dsanjuan@iesebre.com');
        user_teacher_first_or_create('Marisa Grau', 'mgrau@iesebre.com');
        user_teacher_first_or_create('Isabel Jordà', 'ijorda@iesebre.com');
        user_teacher_first_or_create('Enric Querol Sanjuan', 'equerol@iesebre.com');
        user_teacher_first_or_create('Lara Melich', 'lmelich@iesebre.com');
        user_teacher_first_or_create('Carme Aznar', 'carmeaznar@iesebre.com');
        user_teacher_first_or_create('Julià Curto', 'jcurto@iesebre.com');
        user_teacher_first_or_create('Sergi Tur Badenas', 'stur@iesebre.com');
    }
}

if (! function_exists('obtainUserIdByName')) {
    /**
     * Obtain user id by name.
     */
    function obtainUserIdByName($name)
    {
        return User::where('name', $name)->first()->id;
    }
}

if (! function_exists('obtainUserIdByEmail')) {
    /**
     * Obtain user id by email.
     */
    function obtainUserIdByEmail($email)
    {
        return User::where('email', $email)->first()->id;
    }
}

if (! function_exists('obtainVacancyIdByCode')) {
    /**
     * Obtain vacancy id by code.
     */
    function obtainVacancyIdByCode($code)
    {
        return Vacancy::where('code', $code)->first()->id;
    }
}

if (! function_exists('seed_teachers')) {
    /**
     * Seed teachers.
     */
    function seed_teachers()
    {
        seed_user_teachers();
        //TODO seed_personal_info
//        seed_personal_info_teachers();
        seed_specialities();
        seed_positions();
        seed_administrative_statuses();
        seed_vacancies();

        //TODO
        //Seed languages
//        seed_languages();
        //Seed degress
//        seed_degrees();
        //Seed profiles
//        seed_profiles();
        //Seed qualifications
//        seed_qualifications();
        //TODO
        // Qualifications -> Assign specialities to teachers. Define the main speciality
        // Charges -> Assign positions to users.
        // Teacher procedure:
        // Assign user-id to teacher
        // Assign vacancy to a teacher (set user_id to vacancy vacancy state pending -> assigned)
        // Assign qualifications (specialities to teacher)
        // Assign administrative status to teacher
        // Assign formation to teacher

        $teacher = teacher_first_or_create(
            '02',
            obtainUserIdByEmail('dsanjuan@iesebre.com'),
            obtainVacancyIdByCode('LLE_1'),
            'active',
            [
                [ obtainSpecialityIdByCode('CAS')  => ['main' => true]]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions->sync([obtainPositionIdByName('Tutora CAM')]);

        $teacher = teacher_first_or_create(
            '03',
            obtainUserIdByEmail('mgrau@iesebre.com'),
            obtainVacancyIdByCode('FOL_1'),
            'active',
            [
                [ obtainSpecialityIdByCode('505')  => ['main' => true]]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions->sync([obtainPositionIdByName('Resp. Atenció a la diversitat')]);

        $teacher = teacher_first_or_create(
            '04',
            obtainUserIdByEmail('ijorda@iesebre.com'),
            obtainVacancyIdByCode('LLE_2'),
            'active',
            [
                [ obtainSpecialityIdByCode('505')  => ['main' => true]]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        $teacher = teacher_first_or_create(
            '05',
            obtainUserIdByEmail('equerol@iesebre.com'),
            obtainVacancyIdByCode('LLE_3'),
            'active',
            [
                [ obtainSpecialityIdByCode('AN')  => ['main' => true]]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions->sync(
            [
                obtainPositionIdByName('Tutor CAS B'),
                obtainPositionIdByName('Resp. Biblioteca'),
            ]
        );

        $teacher = teacher_first_or_create(
            '06',
            obtainUserIdByEmail('lmelich@iesebre.com'),
            obtainVacancyIdByCode('LLE_4'),
            'active',
            [
                [ obtainSpecialityIdByCode('AN')  => ['main' => true]]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions->sync(
            [
                obtainPositionIdByName('Coord. Mobilitat / Erasmus+')
            ]
        );

        $teacher = teacher_first_or_create(
            '07',
            obtainUserIdByEmail('carmenaznar@iesebre.com'),
            obtainVacancyIdByCode('LLE_4'),
            'active',
            [
                [ obtainSpecialityIdByCode('AN')  => ['main' => true]]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions->sync(
            [
                obtainPositionIdByName('Cap dep. Lleng. estrangeres')
            ]
        );

        $teacher = teacher_first_or_create(
            '08',
            obtainUserIdByEmail('jcurto@iesebre.com'),
            obtainVacancyIdByCode('LLE_3'),
            'active',
            [
                [ obtainSpecialityIdByCode('MA')  => ['main' => true]]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions->sync(
            [
                obtainPositionIdByName('Tutor CAS A'),
                obtainPositionIdByName('Coord CAS/CAM')
            ]
        );

        $teacher = teacher_first_or_create(
            '40',
            obtainUserIdByEmail('stur@iesebre.com'),
            obtainVacancyIdByCode('INF_3'),
            'active',
            [
                [ obtainSpecialityIdByCode('507')  => ['main' => true]]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2009',
            "2007",
            "2009-09-01 00:00:00"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions->sync(
            [
                obtainPositionIdByName('Coord. Informàtica')
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

