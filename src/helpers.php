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

        //Vacancies
        permission_first_or_create('list-vacancies');
        permission_first_or_create('create-vacancies');
        permission_first_or_create('view-vacancies');
        permission_first_or_create('edit-vacancies');
        permission_first_or_create('delete-vacancies');
        permission_first_or_create('massive-delete-vacancies');

        give_permission_to_role($manageStaff,'list-vacancies');
        give_permission_to_role($manageStaff,'create-vacancies');
        give_permission_to_role($manageStaff,'view-vacancies');
        give_permission_to_role($manageStaff,'edit-vacancies');
        give_permission_to_role($manageStaff,'delete-vacancies');
        give_permission_to_role($manageStaff,'massive-delete-vacancies');

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
            ])->first();
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

if (! function_exists('obtainAdministrativeStatusIdByName')) {
    /**
     * Obtain administrative status id by name.
     */
    function obtainAdministrativeStatusIdByName($name)
    {
        return AdministrativeStatus::where('name', $name)->first()->id;
    }
}

if (! function_exists('vacancy_first_or_create')) {
    /**
     * Seed teacher vacancies.
     *
     * @param $code
     * @param $speciality
     * @param $state
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    function vacancy_first_or_create($code, $speciality, $state)
    {
        try {
            $vacancy = Vacancy::create([
                'code' => $code,
                'speciality_id' => $speciality,
                'state' => $state,
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
        seed_specialities();
        vacancy_first_or_create("501_1", obtainSpecialityIdByCode("501"), "active");
        vacancy_first_or_create("501_2", obtainSpecialityIdByCode("501"), "active");
        vacancy_first_or_create("501_3", obtainSpecialityIdByCode("501"), "active");
        vacancy_first_or_create("501_4", obtainSpecialityIdByCode("501"), "active");
        vacancy_first_or_create("501_5", obtainSpecialityIdByCode("501"), "active");
        vacancy_first_or_create("504_1", obtainSpecialityIdByCode("504"), "active");
        vacancy_first_or_create("505_1", obtainSpecialityIdByCode("505"), "active");
        vacancy_first_or_create("505_2", obtainSpecialityIdByCode("505"), "active");
        vacancy_first_or_create("505_3", obtainSpecialityIdByCode("505"), "active");
        vacancy_first_or_create("505_4", obtainSpecialityIdByCode("505"), "active");
        vacancy_first_or_create("505_5", obtainSpecialityIdByCode("505"), "active");
        vacancy_first_or_create("505_6", obtainSpecialityIdByCode("505"), "active");
        vacancy_first_or_create("507_1", obtainSpecialityIdByCode("507"), "active");
        vacancy_first_or_create("507_2", obtainSpecialityIdByCode("507"), "active");
        vacancy_first_or_create("507_3", obtainSpecialityIdByCode("507"), "active");
        vacancy_first_or_create("507_4", obtainSpecialityIdByCode("507"), "active");
        vacancy_first_or_create("507_5", obtainSpecialityIdByCode("507"), "active");
        vacancy_first_or_create("507_6", obtainSpecialityIdByCode("507"), "active");
        vacancy_first_or_create("508_1", obtainSpecialityIdByCode("508"), "active");
        vacancy_first_or_create("508_2", obtainSpecialityIdByCode("508"), "active");
        vacancy_first_or_create("508_3", obtainSpecialityIdByCode("508"), "active");
        vacancy_first_or_create("508_4", obtainSpecialityIdByCode("508"), "active");
        vacancy_first_or_create("508_5", obtainSpecialityIdByCode("508"), "active");
        vacancy_first_or_create("508_6", obtainSpecialityIdByCode("508"), "active");
        vacancy_first_or_create("510_1", obtainSpecialityIdByCode("510"), "active");
        vacancy_first_or_create("510_2", obtainSpecialityIdByCode("510"), "active");
        vacancy_first_or_create("510_3", obtainSpecialityIdByCode("510"), "active");
        vacancy_first_or_create("510_4", obtainSpecialityIdByCode("510"), "active");
        vacancy_first_or_create("512_1", obtainSpecialityIdByCode("512"), "active");
        vacancy_first_or_create("512_2", obtainSpecialityIdByCode("512"), "active");
        vacancy_first_or_create("512_3", obtainSpecialityIdByCode("512"), "active");
        vacancy_first_or_create("513_1", obtainSpecialityIdByCode("513"), "active");
        vacancy_first_or_create("517_1", obtainSpecialityIdByCode("517"), "active");
        vacancy_first_or_create("517_2", obtainSpecialityIdByCode("517"), "active");
        vacancy_first_or_create("517_3", obtainSpecialityIdByCode("517"), "active");
        vacancy_first_or_create("517_4", obtainSpecialityIdByCode("517"), "active");
        vacancy_first_or_create("517_5", obtainSpecialityIdByCode("517"), "active");
        vacancy_first_or_create("518_1", obtainSpecialityIdByCode("518"), "active");
        vacancy_first_or_create("518_2", obtainSpecialityIdByCode("518"), "active");
        vacancy_first_or_create("518_3", obtainSpecialityIdByCode("518"), "active");
        vacancy_first_or_create("518_4", obtainSpecialityIdByCode("518"), "active");
        vacancy_first_or_create("518_5", obtainSpecialityIdByCode("518"), "active");
        vacancy_first_or_create("522_1", obtainSpecialityIdByCode("522"), "active");
        vacancy_first_or_create("522_2", obtainSpecialityIdByCode("522"), "active");
        vacancy_first_or_create("524_1", obtainSpecialityIdByCode("524"), "active");
        vacancy_first_or_create("524_2", obtainSpecialityIdByCode("524"), "active");
        vacancy_first_or_create("525_1", obtainSpecialityIdByCode("525"), "active");
        vacancy_first_or_create("525_2", obtainSpecialityIdByCode("525"), "active");
        vacancy_first_or_create("525_3", obtainSpecialityIdByCode("525"), "active");
        vacancy_first_or_create("525_4", obtainSpecialityIdByCode("525"), "active");
        vacancy_first_or_create("602_1", obtainSpecialityIdByCode("602"), "active");
        vacancy_first_or_create("602_2", obtainSpecialityIdByCode("602"), "active");
        vacancy_first_or_create("605_1", obtainSpecialityIdByCode("605"), "active");
        vacancy_first_or_create("606_1", obtainSpecialityIdByCode("606"), "active");
        vacancy_first_or_create("606_2", obtainSpecialityIdByCode("606"), "active");
        vacancy_first_or_create("606_3", obtainSpecialityIdByCode("606"), "active");
        vacancy_first_or_create("611_1", obtainSpecialityIdByCode("611"), "active");
        vacancy_first_or_create("611_2", obtainSpecialityIdByCode("611"), "active");
        vacancy_first_or_create("611_3", obtainSpecialityIdByCode("611"), "active");
        vacancy_first_or_create("611_4", obtainSpecialityIdByCode("611"), "active");
        vacancy_first_or_create("611_5", obtainSpecialityIdByCode("611"), "active");
        vacancy_first_or_create("611_6", obtainSpecialityIdByCode("611"), "active");
        vacancy_first_or_create("611_7", obtainSpecialityIdByCode("611"), "active");
        vacancy_first_or_create("611_8", obtainSpecialityIdByCode("611"), "active");
        vacancy_first_or_create("612_1", obtainSpecialityIdByCode("612"), "active");
        vacancy_first_or_create("619_1", obtainSpecialityIdByCode("619"), "active");
        vacancy_first_or_create("619_2", obtainSpecialityIdByCode("619"), "active");
        vacancy_first_or_create("619_3", obtainSpecialityIdByCode("619"), "active");
        vacancy_first_or_create("619_4", obtainSpecialityIdByCode("619"), "active");
        vacancy_first_or_create("619_5", obtainSpecialityIdByCode("619"), "active");
        vacancy_first_or_create("620_1", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_2", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_3", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_4", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_5", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_6", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_7", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_8", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_9", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_10", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_11", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_12", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("620_13", obtainSpecialityIdByCode("620"), "active");
        vacancy_first_or_create("621_1", obtainSpecialityIdByCode("621"), "active");
        vacancy_first_or_create("621_2", obtainSpecialityIdByCode("621"), "active");
        vacancy_first_or_create("621_3", obtainSpecialityIdByCode("621"), "active");
        vacancy_first_or_create("622_1", obtainSpecialityIdByCode("622"), "active");
        vacancy_first_or_create("622_2", obtainSpecialityIdByCode("622"), "active");
        vacancy_first_or_create("622_3", obtainSpecialityIdByCode("622"), "active");
        vacancy_first_or_create("622_4", obtainSpecialityIdByCode("622"), "active");
        vacancy_first_or_create("622_5", obtainSpecialityIdByCode("622"), "active");
        vacancy_first_or_create("623_1", obtainSpecialityIdByCode("623"), "active");
        vacancy_first_or_create("623_2", obtainSpecialityIdByCode("623"), "active");
        vacancy_first_or_create("623_3", obtainSpecialityIdByCode("623"), "active");
        vacancy_first_or_create("625_1", obtainSpecialityIdByCode("625"), "active");
        vacancy_first_or_create("625_2", obtainSpecialityIdByCode("625"), "active");
        vacancy_first_or_create("625_3", obtainSpecialityIdByCode("625"), "active");
        vacancy_first_or_create("625_4", obtainSpecialityIdByCode("625"), "active");
        vacancy_first_or_create("625_5", obtainSpecialityIdByCode("625"), "active");
        vacancy_first_or_create("625_6", obtainSpecialityIdByCode("625"), "active");
        vacancy_first_or_create("625_7", obtainSpecialityIdByCode("625"), "active");
        vacancy_first_or_create("625_8", obtainSpecialityIdByCode("625"), "active");
        vacancy_first_or_create("627_1", obtainSpecialityIdByCode("627"), "active");
        vacancy_first_or_create("627_2", obtainSpecialityIdByCode("627"), "active");
        vacancy_first_or_create("627_3", obtainSpecialityIdByCode("627"), "active");
        vacancy_first_or_create("627_4", obtainSpecialityIdByCode("627"), "active");
        vacancy_first_or_create("627_5", obtainSpecialityIdByCode("627"), "active");
        vacancy_first_or_create("AN_1", obtainSpecialityIdByCode("AN"), "active");
        vacancy_first_or_create("AN_2", obtainSpecialityIdByCode("AN"), "active");
        vacancy_first_or_create("AN_3", obtainSpecialityIdByCode("AN"), "active");
        vacancy_first_or_create("AN_4", obtainSpecialityIdByCode("AN"), "active");
        vacancy_first_or_create("CAS_1", obtainSpecialityIdByCode("CAS"), "active");
        vacancy_first_or_create("MA_1", obtainSpecialityIdByCode("MA"), "active");

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
        user_teacher_first_or_create('Carme Aznar', 'carmenaznar@iesebre.com');
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
                obtainSpecialityIdByCode('CAS')  => ['main' => true]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions()->sync([obtainPositionIdByName('Tutora CAM')]);

        $teacher = teacher_first_or_create(
            '03',
            obtainUserIdByEmail('mgrau@iesebre.com'),
            obtainVacancyIdByCode('FOL_1'),
            'active',
            [
                obtainSpecialityIdByCode('505')  => ['main' => true]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed

        $teacher->user->positions()->sync([obtainPositionIdByName('Resp. Atenció a la diversitat')]);

        $teacher = teacher_first_or_create(
            '04',
            obtainUserIdByEmail('ijorda@iesebre.com'),
            obtainVacancyIdByCode('LLE_2'),
            'active',
            [
                obtainSpecialityIdByCode('505')  => ['main' => true]
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
                obtainSpecialityIdByCode('AN')  => ['main' => true]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions()->sync(
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
                obtainSpecialityIdByCode('AN')  => ['main' => true]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions()->sync(
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
                obtainSpecialityIdByCode('AN')  => ['main' => true]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions()->sync(
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
                obtainSpecialityIdByCode('MA')  => ['main' => true]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2000',
            "2000",
            "2015-10-28 19:18:44"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions()->sync(
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
                obtainSpecialityIdByCode('507')  => ['main' => true]
            ],
            obtainAdministrativeStatusIdByName('Funcionari/a amb plaça definitiva'),
            '2009',
            "2007",
            "2009-09-01 00:00:00"
        );

        //Assign positions to teacher if needed
        $teacher->user->positions()->sync(
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

