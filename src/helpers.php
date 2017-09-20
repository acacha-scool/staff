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
        position_first_or_create("Administradora");
        position_first_or_create("Cap Dep. Admin.");
        position_first_or_create("Cap Dep. Comerç");
        position_first_or_create("Cap Dep. Edif. i Obra");
        position_first_or_create("Cap Dep. Inform");
        position_first_or_create("Cap Dep. Sanit.");
        position_first_or_create("Cap Seminari Serv. Com.");
        position_first_or_create("Cap d'estudis FP");
        position_first_or_create("Cap d'estudis adjunt");
        position_first_or_create("Cap de seminari Inform.");
        position_first_or_create("Cap dep. Arts gràf.");
        position_first_or_create("Cap dep. FOL");
        position_first_or_create("Cap dep. Lleng. estrangeres");
        position_first_or_create("Cap seminari");
        position_first_or_create("Cap. Dep. Electric.");
        position_first_or_create("Cap. Dep. Fabric. Mec.");
        position_first_or_create("Mant.");
        position_first_or_create("Cap. Dep. Serv. Com.");
        position_first_or_create("Cap. Sem. Dep. Electric.");
        position_first_or_create("Cap. seminari  Fabric. Mec.");
        position_first_or_create("Coord. FP");
        position_first_or_create("Coord. Inform.");
        position_first_or_create("Coord. Mobilitat");
        position_first_or_create("Erasmus+");
        position_first_or_create("Coord. Qualitat");
        position_first_or_create("Coord. pedagògica");
        position_first_or_create("Director");
        position_first_or_create("Resp. Atenció a la diversitat");
        position_first_or_create("Resp. Escoles Verdes");
        position_first_or_create("Resp. Validació experiència prof.");
        position_first_or_create("Secretària");
        position_first_or_create("Suport Mobilitat internacional");
        position_first_or_create("Tutor 1 INS B");
        position_first_or_create("Tutor 1ACO");
        position_first_or_create("Tutor 1EIN");
        position_first_or_create("Tutor 1IEA");
        position_first_or_create("Tutor 1LCB");
        position_first_or_create("Tutor 1MEC");
        position_first_or_create("Tutor 1MEM");
        position_first_or_create("Tutor 1PPFM");
        position_first_or_create("Tutor 1SMX A");
        position_first_or_create("C");
        position_first_or_create("Tutor 1SMX B");
        position_first_or_create("Tutor 2 INS A");
        position_first_or_create("Tutor 2 PRID");
        position_first_or_create("Tutor 2ADI");
        position_first_or_create("Tutor 2AF");
        position_first_or_create("Tutor 2APD");
        position_first_or_create("Tutor 2ASIX");
        position_first_or_create("Tutor 2DAM");
        position_first_or_create("Tutor 2DIE");
        position_first_or_create("Coord. Prev. Riscos");
        position_first_or_create("Tutor 2EE");
        position_first_or_create("CC mant. general");
        position_first_or_create("Tutor 2EIN");
        position_first_or_create("Tutor 2FAR");
        position_first_or_create("Tutor 2IEA");
        position_first_or_create("Tutor 2MEC");
        position_first_or_create("Tutor 2MEM");
        position_first_or_create("Tutor 2PPFM.");
        position_first_or_create("Tutor 2PRO");
        position_first_or_create("1EE");
        position_first_or_create("Tutor 2SIC");
        position_first_or_create("Tutor 2SMX A i B");
        position_first_or_create("Tutor CAS A");
        position_first_or_create("Coord CAS");
        position_first_or_create("CAM");
        position_first_or_create("Tutor CAS B");
        position_first_or_create("Resp. Biblioteca");
        position_first_or_create("Tutor IT");
        position_first_or_create("CC  Audiovisuals");
        position_first_or_create("Tutora  1MAP");
        position_first_or_create("Tutora 1 DEP");
        position_first_or_create("Tutora 1 PRID");
        position_first_or_create("Tutora 1ADI");
        position_first_or_create("Tutora 1AF");
        position_first_or_create("Tutora 1APD");
        position_first_or_create("Resp. orientació");
        position_first_or_create("Tutora 1ARI");
        position_first_or_create("CC Activ. extraes.");
        position_first_or_create("Tutora 1ASIX-DAM");
        position_first_or_create("Tutora 1DIE");
        position_first_or_create("Tutora 1ES");
        position_first_or_create("Tutora 1FAR");
        position_first_or_create("Tutora 1GAD");
        position_first_or_create("Tutora 1INS A");
        position_first_or_create("Tutora 2 INS B");
        position_first_or_create("Tutora 2ACO-Resp. Emprenedoria");
        position_first_or_create("Tutora 2ARI");
        position_first_or_create("CC pag. Web- Moodle");
        position_first_or_create("Tutora 2ES");
        position_first_or_create("Tutora 2GAD");
        position_first_or_create("Tutora 2LCB");
        position_first_or_create("Tutora 2MAP");
        position_first_or_create("Tutora CAI A");
        position_first_or_create("Tutora CAI C");
        position_first_or_create("Tutora CAM");
        position_first_or_create("Tutora de CAI B");
    }
}

if (! function_exists('teacher_first_or_create')) {
    /**
     * Create teacher if not exists and return new o already existing teacher.
     *
     * @param $code
     * @param $user_id
     * @param $specialities
     * @param $state
     * @param $administrative_status
     * @param $administrative_start_year
     * @param $opossitions_pass_year
     * @param $start_date
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    function teacher_first_or_create(
        $code,
        $user_id,
        $specialities,
        $state = 'pending',
        $administrative_status = null,
        $administrative_start_year = null,
        $opossitions_pass_year= null,
        $start_date = null
    )
    {
        try {
            $teacher = Teacher::create([
                'code' => $code,
                'user_id' => $user_id,
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
     * @param $speciality
     * @param $department
     * @param $order
     * @param $owner
     * @param $state
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    function vacancy_first_or_create($speciality, $department, $order, $owner, $state = 'pending' )
    {
        try {
            $vacancy = Vacancy::create([
                'speciality_id' => $speciality,
                'department_id' => $department,
                'order' => $order,
                'owner' => $owner,
            ]);
            $vacancy->teachers()->save($teacher = Teacher::findOrFail($owner));
            if ($state == 'assigned') $vacancy->assign();
            $teacher->activate();
            return $vacancy;
        } catch (Illuminate\Database\QueryException $e) {
            return Vacancy::where([
                ['owner', '=', $owner]
            ]);
        }
    }
}
if (! function_exists('count_vacancies')) {
    /**
     * Count vacancies.
     */
    function count_vacancies()
    {
        return Vacancy::all()->count();
    }
}

if (! function_exists('obtainTeacherIdByCode')) {

    /**
     * obtainTeacherIdByCode.
     *
     * @param $code
     * @return mixed
     */
    function obtainTeacherIdByCode($code) {
        return Teacher::where('code',$code)->first()->id;
    }
}

if (! function_exists('seed_vacancies')) {
    /**
     * Seed teacher vacancies.
     */
    function seed_vacancies()
    {
        seed_departments();
        seed_user_teachers();
        seed_teachers();

        vacancy_first_or_create( obtainSpecialityIdByCode("501"), obtainDepartmentIdByEspecialityCode("501"), 1, obtainTeacherIdByCode("14"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("501"), obtainDepartmentIdByEspecialityCode("501"), 2, obtainTeacherIdByCode("15"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("501"), obtainDepartmentIdByEspecialityCode("501"), 3, obtainTeacherIdByCode("16"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("501"), obtainDepartmentIdByEspecialityCode("501"), 4, obtainTeacherIdByCode("17"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("501"), obtainDepartmentIdByEspecialityCode("501"), 5, obtainTeacherIdByCode("18"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("504"), obtainDepartmentIdByEspecialityCode("504"), 1, obtainTeacherIdByCode("47"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("505"), obtainDepartmentIdByEspecialityCode("505"), 1, obtainTeacherIdByCode("03"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("505"), obtainDepartmentIdByEspecialityCode("505"), 2, obtainTeacherIdByCode("09"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("505"), obtainDepartmentIdByEspecialityCode("505"), 3, obtainTeacherIdByCode("10"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("505"), obtainDepartmentIdByEspecialityCode("505"), 4, obtainTeacherIdByCode("12"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("505"), obtainDepartmentIdByEspecialityCode("505"), 5, obtainTeacherIdByCode("13"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("505"), obtainDepartmentIdByEspecialityCode("505"), 6, obtainTeacherIdByCode("11"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("507"), obtainDepartmentIdByEspecialityCode("507"), 1, obtainTeacherIdByCode("38"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("507"), obtainDepartmentIdByEspecialityCode("507"), 2, obtainTeacherIdByCode("39"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("507"), obtainDepartmentIdByEspecialityCode("507"), 3, obtainTeacherIdByCode("40"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("507"), obtainDepartmentIdByEspecialityCode("507"), 4, obtainTeacherIdByCode("41"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("507"), obtainDepartmentIdByEspecialityCode("507"), 5, obtainTeacherIdByCode("46"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("507"), obtainDepartmentIdByEspecialityCode("507"), 6, obtainTeacherIdByCode("117"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("508"), obtainDepartmentIdByEspecialityCode("508"), 1, obtainTeacherIdByCode("82"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("508"), obtainDepartmentIdByEspecialityCode("508"), 2, obtainTeacherIdByCode("83"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("508"), obtainDepartmentIdByEspecialityCode("508"), 3, obtainTeacherIdByCode("84"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("508"), obtainDepartmentIdByEspecialityCode("508"), 4, obtainTeacherIdByCode("85"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("508"), obtainDepartmentIdByEspecialityCode("508"), 5, obtainTeacherIdByCode("86"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("508"), obtainDepartmentIdByEspecialityCode("508"), 6, obtainTeacherIdByCode("112"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("510"), obtainDepartmentIdByEspecialityCode("510"), 1, obtainTeacherIdByCode("24"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("510"), obtainDepartmentIdByEspecialityCode("510"), 2, obtainTeacherIdByCode("25"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("510"), obtainDepartmentIdByEspecialityCode("510"), 3, obtainTeacherIdByCode("106"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("510"), obtainDepartmentIdByEspecialityCode("510"), 4, obtainTeacherIdByCode("107"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("512"), obtainDepartmentIdByEspecialityCode("512"), 1, obtainTeacherIdByCode("52"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("512"), obtainDepartmentIdByEspecialityCode("512"), 2, obtainTeacherIdByCode("53"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("512"), obtainDepartmentIdByEspecialityCode("512"), 3, obtainTeacherIdByCode("51"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("513"), obtainDepartmentIdByEspecialityCode("513"), 1, obtainTeacherIdByCode("116"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("517"), obtainDepartmentIdByEspecialityCode("517"), 1, obtainTeacherIdByCode("64"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("517"), obtainDepartmentIdByEspecialityCode("517"), 2, obtainTeacherIdByCode("65"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("517"), obtainDepartmentIdByEspecialityCode("517"), 3, obtainTeacherIdByCode("66"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("517"), obtainDepartmentIdByEspecialityCode("517"), 4, obtainTeacherIdByCode("67"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("517"), obtainDepartmentIdByEspecialityCode("517"), 5, obtainTeacherIdByCode("99"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("518"), obtainDepartmentIdByEspecialityCode("518"), 6, obtainTeacherIdByCode("60"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("518"), obtainDepartmentIdByEspecialityCode("518"), 7, obtainTeacherIdByCode("61"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("518"), obtainDepartmentIdByEspecialityCode("518"), 8, obtainTeacherIdByCode("62"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("518"), obtainDepartmentIdByEspecialityCode("518"), 9, obtainTeacherIdByCode("63"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("518"), obtainDepartmentIdByEspecialityCode("518"), 10, obtainTeacherIdByCode("110"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("522"), obtainDepartmentIdByEspecialityCode("522"), 1, obtainTeacherIdByCode("94"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("522"), obtainDepartmentIdByEspecialityCode("522"), 2, obtainTeacherIdByCode("98"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("524"), obtainDepartmentIdByEspecialityCode("524"), 2, obtainTeacherIdByCode("28"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("524"), obtainDepartmentIdByEspecialityCode("524"), 3, obtainTeacherIdByCode("115"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("525"), obtainDepartmentIdByEspecialityCode("525"), 4, obtainTeacherIdByCode("29"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("525"), obtainDepartmentIdByEspecialityCode("525"), 5, obtainTeacherIdByCode("30"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("525"), obtainDepartmentIdByEspecialityCode("525"), 6, obtainTeacherIdByCode("31"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("525"), obtainDepartmentIdByEspecialityCode("525"), 7, obtainTeacherIdByCode("114"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("602"), obtainDepartmentIdByEspecialityCode("602"), 8, obtainTeacherIdByCode("32"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("602"), obtainDepartmentIdByEspecialityCode("602"), 9, obtainTeacherIdByCode("33"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("605"), obtainDepartmentIdByEspecialityCode("605"), 10, obtainTeacherIdByCode("34"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("606"), obtainDepartmentIdByEspecialityCode("606"), 11, obtainTeacherIdByCode("35"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("606"), obtainDepartmentIdByEspecialityCode("606"), 12, obtainTeacherIdByCode("36"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("606"), obtainDepartmentIdByEspecialityCode("606"), 13, obtainTeacherIdByCode("37"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("611"), obtainDepartmentIdByEspecialityCode("611"), 4, obtainTeacherIdByCode("49"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("611"), obtainDepartmentIdByEspecialityCode("611"), 5, obtainTeacherIdByCode("50"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("611"), obtainDepartmentIdByEspecialityCode("611"), 6, obtainTeacherIdByCode("54"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("611"), obtainDepartmentIdByEspecialityCode("611"), 7, obtainTeacherIdByCode("55"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("611"), obtainDepartmentIdByEspecialityCode("611"), 8, obtainTeacherIdByCode("56"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("611"), obtainDepartmentIdByEspecialityCode("611"), 9, obtainTeacherIdByCode("57"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("611"), obtainDepartmentIdByEspecialityCode("611"), 10, obtainTeacherIdByCode("58"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("611"), obtainDepartmentIdByEspecialityCode("611"), 11, obtainTeacherIdByCode("59"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("612"), obtainDepartmentIdByEspecialityCode("612"), 2, obtainTeacherIdByCode("48"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("619"), obtainDepartmentIdByEspecialityCode("619"), 11, obtainTeacherIdByCode("68"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("619"), obtainDepartmentIdByEspecialityCode("619"), 12, obtainTeacherIdByCode("69"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("619"), obtainDepartmentIdByEspecialityCode("619"), 13, obtainTeacherIdByCode("70"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("619"), obtainDepartmentIdByEspecialityCode("619"), 14, obtainTeacherIdByCode("71"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("619"), obtainDepartmentIdByEspecialityCode("619"), 15, obtainTeacherIdByCode("72"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 16, obtainTeacherIdByCode("100"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 17, obtainTeacherIdByCode("73"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 18, obtainTeacherIdByCode("74"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 19, obtainTeacherIdByCode("75"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 20, obtainTeacherIdByCode("76"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 21, obtainTeacherIdByCode("77"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 22, obtainTeacherIdByCode("78"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 23, obtainTeacherIdByCode("79"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 24, obtainTeacherIdByCode("80"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 25, obtainTeacherIdByCode("81"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 26, obtainTeacherIdByCode("101"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 27, obtainTeacherIdByCode("102"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("620"), obtainDepartmentIdByEspecialityCode("620"), 28, obtainTeacherIdByCode("109"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("621"), obtainDepartmentIdByEspecialityCode("621"), 5, obtainTeacherIdByCode("26"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("621"), obtainDepartmentIdByEspecialityCode("621"), 6, obtainTeacherIdByCode("27"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("621"), obtainDepartmentIdByEspecialityCode("621"), 7, obtainTeacherIdByCode("105"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("622"), obtainDepartmentIdByEspecialityCode("622"), 6, obtainTeacherIdByCode("19"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("622"), obtainDepartmentIdByEspecialityCode("622"), 7, obtainTeacherIdByCode("20"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("622"), obtainDepartmentIdByEspecialityCode("622"), 8, obtainTeacherIdByCode("21"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("622"), obtainDepartmentIdByEspecialityCode("622"), 9, obtainTeacherIdByCode("22"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("622"), obtainDepartmentIdByEspecialityCode("622"), 10, obtainTeacherIdByCode("23"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("623"), obtainDepartmentIdByEspecialityCode("623"), 3, obtainTeacherIdByCode("95"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("623"), obtainDepartmentIdByEspecialityCode("623"), 4, obtainTeacherIdByCode("96"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("623"), obtainDepartmentIdByEspecialityCode("623"), 5, obtainTeacherIdByCode("97"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("625"), obtainDepartmentIdByEspecialityCode("625"), 7, obtainTeacherIdByCode("108"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("625"), obtainDepartmentIdByEspecialityCode("625"), 8, obtainTeacherIdByCode("87"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("625"), obtainDepartmentIdByEspecialityCode("625"), 9, obtainTeacherIdByCode("88"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("625"), obtainDepartmentIdByEspecialityCode("625"), 10, obtainTeacherIdByCode("89"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("625"), obtainDepartmentIdByEspecialityCode("625"), 11, obtainTeacherIdByCode("90"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("625"), obtainDepartmentIdByEspecialityCode("625"), 12, obtainTeacherIdByCode("91"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("625"), obtainDepartmentIdByEspecialityCode("625"), 13, obtainTeacherIdByCode("92"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("625"), obtainDepartmentIdByEspecialityCode("625"), 14, obtainTeacherIdByCode("93"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("627"), obtainDepartmentIdByEspecialityCode("627"), 7, obtainTeacherIdByCode("42"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("627"), obtainDepartmentIdByEspecialityCode("627"), 8, obtainTeacherIdByCode("43"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("627"), obtainDepartmentIdByEspecialityCode("627"), 9, obtainTeacherIdByCode("44"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("627"), obtainDepartmentIdByEspecialityCode("627"), 10, obtainTeacherIdByCode("45"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("627"), obtainDepartmentIdByEspecialityCode("627"), 11, obtainTeacherIdByCode("118"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("AN"), obtainDepartmentIdByEspecialityCode("AN"), 1, obtainTeacherIdByCode("04"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("AN"), obtainDepartmentIdByEspecialityCode("AN"), 2, obtainTeacherIdByCode("05"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("AN"), obtainDepartmentIdByEspecialityCode("AN"), 3, obtainTeacherIdByCode("06"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("AN"), obtainDepartmentIdByEspecialityCode("AN"), 4, obtainTeacherIdByCode("07"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("CAS"), obtainDepartmentIdByEspecialityCode("CAS"), 5, obtainTeacherIdByCode("02"), "assigned");
        vacancy_first_or_create( obtainSpecialityIdByCode("MA"), obtainDepartmentIdByEspecialityCode("MA"), 6, obtainTeacherIdByCode("08"), "assigned");


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

if (! function_exists('obtainTeacherIdByCode')) {
    /**
     * Obtain teacher id by.
     */
    function obtainTeacherIdByCode($code)
    {

    }
}

if (! function_exists('seed_user_teachers')) {
    /**
     * Seed user teachers.
     */
    function seed_user_teachers()
    {
        user_teacher_first_or_create('Òscar Samo Franch', 'oscarsamo@iesebre.com');
        user_teacher_first_or_create('Enric Garcia Carcelén', 'egarci@iesebre.com');
        user_teacher_first_or_create('Eduard Ralda Simó', 'eralda@iesebre.com');
        user_teacher_first_or_create('Pilar Nuez Garcia', 'mnuez@iesebre.com');
        user_teacher_first_or_create('Maria rosa Ubalde Bellot', 'mariarosaubalde@iesebre.com');
        user_teacher_first_or_create('Pere Ferré Pujol', 'pereferre@iesebre.com');
        user_teacher_first_or_create('MCinta Luisa Grau Campeon', 'cgrau@iesebre.com');
        user_teacher_first_or_create('Teresa Lasala Descarrega', 'tlasala@iesebre.com');
        user_teacher_first_or_create('Carmina Andreu Pons', 'candreu@iesebre.com');
        user_teacher_first_or_create('Pilar Fadurdo Estrada', 'pilarfadurdo@iesebre.com');
        user_teacher_first_or_create('Carlos Querol Bel', 'carlosquerol@iesebre.com');
        user_teacher_first_or_create('José Andrés Brocal Safont', 'jbrocal@iesebre.com');
        user_teacher_first_or_create('Santiago Sabaté Sanz', 'ssabate@iesebre.com');
        user_teacher_first_or_create('Jordi Varas Aliau', 'jvaras@iesebre.com');
        user_teacher_first_or_create('Sergi Tur Badenas', 'admin@iesebre.com');
        user_teacher_first_or_create('Jaume Ramos Prades', 'jaumeramos@iesebre.com');
        user_teacher_first_or_create('Quique Lorente Fuertes', 'quiquelorente@iesebre.com');
        user_teacher_first_or_create('Gonçal Verge Arnau', 'goncalverge@iesebre.com');
        user_teacher_first_or_create('Tarsici Royo Cruselles', 'troyo@iesebre.com');
        user_teacher_first_or_create('Carme Lorenzo Monfó', 'carmelorenzo@iesebre.com');
        user_teacher_first_or_create('Iris Maturana Andreu', 'irismaturana@iesebre.com');
        user_teacher_first_or_create('Llàtzer Carbó Bertomeu', 'llatzercarbo@iesebre.com');
        user_teacher_first_or_create('Mercè Gilo Ortiz', 'mercegilo@iesebre.com');
        user_teacher_first_or_create('Mercè Ferré Aixalà', 'merceferre1@iesebre.com');
        user_teacher_first_or_create('Agustí Moreso García', 'amoreso@iesebre.com');
        user_teacher_first_or_create('Carmen Vega Guerra', 'cvega@iesebre.com');
        user_teacher_first_or_create('Dolors Ferreres Gasulla', 'dolorsferreres@iesebre.com');
        user_teacher_first_or_create('Juan de Dios Abad Bueno', 'juandediosabad@iesebre.com');
        user_teacher_first_or_create('Salvador Jareño Gas', 'sjareno@iesebre.com');
        user_teacher_first_or_create('Jordi Brau Marza', 'jordibrau@iesebre.com');
        user_teacher_first_or_create('José Luís Calderón Furió', 'jcaldero@iesebre.com');
        user_teacher_first_or_create('Joan Cid Castellà', 'joancid1@iesebre.com');
        user_teacher_first_or_create('Anna Valls Montagut', 'avalls@iesebre.com');
        user_teacher_first_or_create('Ana Benaiges Bertomeu', 'anabenaiges@iesebre.com');
        user_teacher_first_or_create('Pepa Cugat Tomàs', 'pepacugat@iesebre.com');
        user_teacher_first_or_create('Salomé Figueres Brescolí', 'salomefigueres@iesebre.com');
        user_teacher_first_or_create('Marta Delgado Escura', 'martadelgado@iesebre.com');
        user_teacher_first_or_create('MJesús Sales Beire', 'msales@iesebre.com');
        user_teacher_first_or_create('Maria Asensi Montalva', 'mariaasensi@iesebre.com');
        user_teacher_first_or_create('Berta Safont Recatalà', 'bertasafont@iesebre.com');
        user_teacher_first_or_create('Santiago López Garcia', 'santiagolopez@iesebre.com');
        user_teacher_first_or_create('Patricia Prado Villegas', 'patriciaprado@iesebre.com');
        user_teacher_first_or_create('Noemí Oms Munuera', 'noemioms@iesebre.com');
        user_teacher_first_or_create('Eduard Serra Pons', 'eduardserra@iesebre.com');
        user_teacher_first_or_create('Nuria Bordes Vidal', 'nbordes@iesebre.com');
        user_teacher_first_or_create('Carlos Montesó Esmel', 'carlosmonteso@iesebre.com');
        user_teacher_first_or_create('Laura Llopis Lozano', 'laurallopis@iesebre.com');
        user_teacher_first_or_create('Vicent Favà Figueres', 'vfava@iesebre.com');
        user_teacher_first_or_create('Agustin Baubi Rovira', 'agustinbaubi@iesebre.com');
        user_teacher_first_or_create('Lluc Ulldemolins Nolla', 'lluculldemolins@iesebre.com');
        user_teacher_first_or_create('Rafel Puig Ríos', 'rafelpuig@iesebre.com');
        user_teacher_first_or_create('Laureà Ferré Menasanch', 'lferre@iesebre.com');
        user_teacher_first_or_create('Manel Canalda Vidal', 'manelcanalda@iesebre.com');
        user_teacher_first_or_create('Xavier Bel Fernández', 'xbel@iesebre.com');
        user_teacher_first_or_create('Francesc Audi Povedano', 'francescaudi@iesebre.com');
        user_teacher_first_or_create('Àngel Portillo Lucas', 'angelportillo@iesebre.com');
        user_teacher_first_or_create('Rosendo Ferri Marzo', 'rosendoferri@iesebre.com');
        user_teacher_first_or_create('Jordi Sanchez Bel', 'jordisanchez@iesebre.com');
        user_teacher_first_or_create('Joan Josep Tirón Ferre', 'jtiron@iesebre.com');
        user_teacher_first_or_create('Ricard Fernández Burato', 'rfernand@iesebre.com');
        user_teacher_first_or_create('Ubaldo Arroyo Martinez', 'ubaldoarroyo@iesebre.com');
        user_teacher_first_or_create('Fernando Segura Venezia', 'fernandosegura@iesebre.com');
        user_teacher_first_or_create('Francisco José Besalduch Piñol', 'sbesalduch@iesebre.com');
        user_teacher_first_or_create('Manel Segarra Capera', 'msegarra@iesebre.com');
        user_teacher_first_or_create('Pedro Guerrero Lopez', 'pedroguerrero@iesebre.com');
        user_teacher_first_or_create('Sandra Salvador Jovani', 'sandrasalvador@iesebre.com');
        user_teacher_first_or_create('Lluís Ventura Forner', 'lventura@iesebre.com');
        user_teacher_first_or_create('Joan Antoni Pons Albalat', 'jpons@iesebre.com');
        user_teacher_first_or_create('Alícia Fàbrega Martínez', 'aliciafabrega@iesebre.com');
        user_teacher_first_or_create('Segismundo Benavent Gil', 'sbenavent@iesebre.com');
        user_teacher_first_or_create('Cristina Arnau Oset', 'cristinaarnau@iesebre.com');
        user_teacher_first_or_create('MLluisa Ramón Pérez', 'mramon@iesebre.com');
        user_teacher_first_or_create('MJosé Caballé Valverde', 'mcaballe@iesebre.com');
        user_teacher_first_or_create('Elisa Puig Moll', 'epuig@iesebre.com');
        user_teacher_first_or_create('Ruth Hidalgo Vilar', 'rhidalgo@iesebre.com');
        user_teacher_first_or_create('Anna Sambartolomé Sancho', 'annasambartolome@iesebre.com');
        user_teacher_first_or_create('Cinta Mestre Escorihuela', 'cintamestre@iesebre.com');
        user_teacher_first_or_create('Fabiola Grau Talens', 'fgrau@iesebre.com');
        user_teacher_first_or_create('Trinidad Tomas Forcadell', 'trinidadtomas@iesebre.com');
        user_teacher_first_or_create('Adonay Pérez López', 'aperez@iesebre.com');
        user_teacher_first_or_create('María josé Domínguez Rodríguez', 'mariajosedominguez@iesebre.com');
        user_teacher_first_or_create('Eva Benet Escoda', 'evabenet@iesebre.com');
        user_teacher_first_or_create('Núria Suñé Alañá', 'nuriasune@iesebre.com');
        user_teacher_first_or_create('Just Pérez Santiago', 'justperez@iesebre.com');
        user_teacher_first_or_create('Armando Pons Roda', 'apons@iesebre.com');
        user_teacher_first_or_create('Raquel Planell Tolós', 'raquelplanell@iesebre.com');
        user_teacher_first_or_create('Francesca Pinyol Moreso', 'fpinyol@iesebre.com');
        user_teacher_first_or_create('Dolors Subirats Fabra', 'dsubirats@iesebre.com');
        user_teacher_first_or_create('Ferran Sabaté Borras', 'fsabate@iesebre.com');
        user_teacher_first_or_create('Araceli Esteller Hierro', 'aesteller@iesebre.com');
        user_teacher_first_or_create('Mavi Santamaria Andreu', 'mavisantamaria@iesebre.com');
        user_teacher_first_or_create('Gerard Domènech Vendrell', 'gerarddomenech@iesebre.com');
        user_teacher_first_or_create('Jose Antonio Fernàndez Herraez', 'joseantoniofernandez1@iesebre.com');
        user_teacher_first_or_create('Monica Moreno Dionis', 'monicamoreno@iesebre.com');
        user_teacher_first_or_create('Maria Castells Gilabert', 'mariacastells1@iesebre.com');
        user_teacher_first_or_create('Cristina Cardona Romero', 'ccardona99@iesebre.com');
        user_teacher_first_or_create('David Gàmez Balaguer', 'dgamez1@iesebre.com');
        user_teacher_first_or_create('MAngeles Garrido Borja', 'mgarrido2@iesebre.com');
        user_teacher_first_or_create('Alicia Gamundi Vilà', 'aliciagamundi@iesebre.com');
        user_teacher_first_or_create('Ricard Gonzàlez Castelló', 'rgonzalez1@iesebre.com');
        user_teacher_first_or_create('Elena Mauri Cuenca', 'elenamauri@iesebre.com');
        user_teacher_first_or_create('Irene Alegre Chavarria', 'irenealegre@iesebre.com');
        user_teacher_first_or_create('Mireia Consarnau Pallarés', 'mireiaconsarnau@iesebre.com');
        user_teacher_first_or_create('Manel Macias Valanzuela', 'manelmacias@iesebre.com');
        user_teacher_first_or_create('Luis Pérez Càrcel', 'luisperez@iesebre.com');
        user_teacher_first_or_create('José Diego Cervellera Forcadell', 'josediegocervellera@iesebre.com');
        user_teacher_first_or_create('Begoña Elvira Bilbao', 'begonaelvira@iesebre.com');
        user_teacher_first_or_create('Nuria Vallés Machirant', 'nuriavalles@iesebre.com');
        user_teacher_first_or_create('Enric Querol Coll', 'equerol@iesebre.com');
        user_teacher_first_or_create('Lara Melich Cañadó', 'laramelich@iesebre.com');
        user_teacher_first_or_create('Carme Aznar ', 'carmeaznar@iesebre.com');
        user_teacher_first_or_create('Dolors Sanjuán Aubà', 'dsanjuan@iesebre.com');
        user_teacher_first_or_create('Julià Curto DelaVega', 'jcurto@iesebre.com');
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
//        seed_vacancies();

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

        // Sanjuan, Dolors (D) | Castellà | CAS
        teacher_first_or_create("02", obtainUserIdByEmail("dsanjuan@iesebre.com"), [
            obtainSpecialityIdByCode('CAS')  => ['main' => true],
        ], "pending");
// Grau, Marisa (CS) | For. Org. Lab. | 505
        teacher_first_or_create("03", obtainUserIdByEmail("cgrau@iesebre.com"), [
            obtainSpecialityIdByCode('505')  => ['main' => true],
        ], "pending");
// Jordà, Isabel (D) | Anglès | AN
        teacher_first_or_create("04", obtainUserIdByEmail("nuriavalles@iesebre.com"), [
            obtainSpecialityIdByCode('AN')  => ['main' => true],
        ], "pending");
// Querol, Enric (D) | Anglès | AN
        teacher_first_or_create("05", obtainUserIdByEmail("equerol@iesebre.com"), [
            obtainSpecialityIdByCode('AN')  => ['main' => true],
        ], "pending");
// Melich, Lara (CS) | Anglès | AN
        teacher_first_or_create("06", obtainUserIdByEmail("laramelich@iesebre.com"), [
            obtainSpecialityIdByCode('AN')  => ['main' => true],
        ], "pending");
// Aznar, Carme (CS) | Anglès | AN
        teacher_first_or_create("07", obtainUserIdByEmail("carmeaznar@iesebre.com"), [
            obtainSpecialityIdByCode('AN')  => ['main' => true],
        ], "pending");
// Curto, Julià (D) | Matemàtiques | MA
        teacher_first_or_create("08", obtainUserIdByEmail("jcurto@iesebre.com"), [
            obtainSpecialityIdByCode('MA')  => ['main' => true],
        ], "pending");
// Lasala, Teresa (D) | For. Org. Lab. | 505
        teacher_first_or_create("09", obtainUserIdByEmail("tlasala@iesebre.com"), [
            obtainSpecialityIdByCode('505')  => ['main' => true],
        ], "pending");
// Andreu, Carmina (D) | For. Org. Lab. | 505
        teacher_first_or_create("10", obtainUserIdByEmail("candreu@iesebre.com"), [
            obtainSpecialityIdByCode('505')  => ['main' => true],
        ], "pending");
// Brocal, J. Andrés (D) | For. Org. Lab. | 505
        teacher_first_or_create("11", obtainUserIdByEmail("jbrocal@iesebre.com"), [
            obtainSpecialityIdByCode('505')  => ['main' => true],
        ], "pending");
// Fadurdo, Pilar (D) | For. Org. Lab. | 505
        teacher_first_or_create("12", obtainUserIdByEmail("pilarfadurdo@iesebre.com"), [
            obtainSpecialityIdByCode('505')  => ['main' => true],
        ], "pending");
// Querol, Carlos (D) | For. Org. Lab. | 505
        teacher_first_or_create("13", obtainUserIdByEmail("carlosquerol@iesebre.com"), [
            obtainSpecialityIdByCode('505')  => ['main' => true],
        ], "pending");
// Samo, Oscar (I) | Ad. Empreses | 501
        teacher_first_or_create("14", obtainUserIdByEmail("oscarsamo@iesebre.com"), [
            obtainSpecialityIdByCode('501')  => ['main' => true],
        ], "pending");
// García, Enric( D) | Ad. Empreses | 501
        teacher_first_or_create("15", obtainUserIdByEmail("egarci@iesebre.com"), [
            obtainSpecialityIdByCode('501')  => ['main' => true],
        ], "pending");
// Ralda, Eduard (D) | Ad. Empreses | 501
        teacher_first_or_create("16", obtainUserIdByEmail("eralda@iesebre.com"), [
            obtainSpecialityIdByCode('501')  => ['main' => true],
        ], "pending");
// Nuez, Pili (D) | Ad. Empreses | 501
        teacher_first_or_create("17", obtainUserIdByEmail("mnuez@iesebre.com"), [
            obtainSpecialityIdByCode('501')  => ['main' => true],
        ], "pending");
// Ubalde, Mª Rosa (I) | Ad. Empreses | 501
        teacher_first_or_create("18", obtainUserIdByEmail("mariarosaubalde@iesebre.com"), [
            obtainSpecialityIdByCode('501')  => ['main' => true],
        ], "pending");
// Pinyol, Paqui (D) | P. Gest. Adm. | 622
        teacher_first_or_create("19", obtainUserIdByEmail("fpinyol@iesebre.com"), [
            obtainSpecialityIdByCode('622')  => ['main' => true],
        ], "pending");
// Subirats, Dolors (D) | P. Gest. Adm. | 622
        teacher_first_or_create("20", obtainUserIdByEmail("dsubirats@iesebre.com"), [
            obtainSpecialityIdByCode('622')  => ['main' => true],
        ], "pending");
// Sabaté, Ferran (D) | P. Gest. Adm. | 622
        teacher_first_or_create("21", obtainUserIdByEmail("fsabate@iesebre.com"), [
            obtainSpecialityIdByCode('622')  => ['main' => true],
        ], "pending");
// Esteller, Araceli (D) | P. Gest. Adm. | 622
        teacher_first_or_create("22", obtainUserIdByEmail("aesteller@iesebre.com"), [
            obtainSpecialityIdByCode('622')  => ['main' => true],
        ], "pending");
// Santamaria, Mavi (I) | P. Gest. Adm. | 622
        teacher_first_or_create("23", obtainUserIdByEmail("mavisantamaria@iesebre.com"), [
            obtainSpecialityIdByCode('622')  => ['main' => true],
        ], "pending");
// Moreso, Agustí (D) | Org. Gest. Com. | 510
        teacher_first_or_create("24", obtainUserIdByEmail("amoreso@iesebre.com"), [
            obtainSpecialityIdByCode('510')  => ['main' => true],
        ], "pending");
// Vega, Carme (D) | Org. Gest. Com. | 510
        teacher_first_or_create("25", obtainUserIdByEmail("cvega@iesebre.com"), [
            obtainSpecialityIdByCode('510')  => ['main' => true],
        ], "pending");
// Pérez, Just (D) | Proc. Comerc. | 621
        teacher_first_or_create("26", obtainUserIdByEmail("justperez@iesebre.com"), [
            obtainSpecialityIdByCode('621')  => ['main' => true],
        ], "pending");
// Pons, Armand (D) | Proc. Comerc. | 621
        teacher_first_or_create("27", obtainUserIdByEmail("apons@iesebre.com"), [
            obtainSpecialityIdByCode('621')  => ['main' => true],
        ], "pending");
// Bordes, Núria (D) | Sist. Electro. | 524
        teacher_first_or_create("28", obtainUserIdByEmail("nbordes@iesebre.com"), [
            obtainSpecialityIdByCode('524')  => ['main' => true],
        ], "pending");
// Llopis, Laura (D) | S. Elect. Auto. | 525
        teacher_first_or_create("29", obtainUserIdByEmail("laurallopis@iesebre.com"), [
            obtainSpecialityIdByCode('525')  => ['main' => true],
        ], "pending");
// Favà, Vicent (D) | S. Elect. Auto. | 525
        teacher_first_or_create("30", obtainUserIdByEmail("vfava@iesebre.com"), [
            obtainSpecialityIdByCode('525')  => ['main' => true],
        ], "pending");
// Baubí, Agustí (D) | S. Elect. Auto. | 525
        teacher_first_or_create("31", obtainUserIdByEmail("agustinbaubi@iesebre.com"), [
            obtainSpecialityIdByCode('525')  => ['main' => true],
        ], "pending");
// Puig, Rafel (D) | Eq.Electrònic | 602
        teacher_first_or_create("32", obtainUserIdByEmail("rafelpuig@iesebre.com"), [
            obtainSpecialityIdByCode('602')  => ['main' => true],
        ], "pending");
// Ferré, Laureà (CS) | Eq.Electrònic | 602
        teacher_first_or_create("33", obtainUserIdByEmail("lferre@iesebre.com"), [
            obtainSpecialityIdByCode('602')  => ['main' => true],
        ], "pending");
// Canalda, Manel (I) | I. eq.t | 605
        teacher_first_or_create("34", obtainUserIdByEmail("manelcanalda@iesebre.com"), [
            obtainSpecialityIdByCode('605')  => ['main' => true],
        ], "pending");
// Bel, Xavi (D) | Ins. Electro. | 606
        teacher_first_or_create("35", obtainUserIdByEmail("xbel@iesebre.com"), [
            obtainSpecialityIdByCode('606')  => ['main' => true],
        ], "pending");
// Colomé, J. Luís (D) | Ins. Electro. | 606
        teacher_first_or_create("36", obtainUserIdByEmail("francescaudi@iesebre.com"), [
            obtainSpecialityIdByCode('606')  => ['main' => true],
        ], "pending");
// Portillo, Àngel (D) | Ins. Electro. | 606
        teacher_first_or_create("37", obtainUserIdByEmail("angelportillo@iesebre.com"), [
            obtainSpecialityIdByCode('606')  => ['main' => true],
        ], "pending");
// Sabaté, Santi (D) | Informàtica | 507
        teacher_first_or_create("38", obtainUserIdByEmail("ssabate@iesebre.com"), [
            obtainSpecialityIdByCode('507')  => ['main' => true],
        ], "pending");
// Varas, Jordi (D) | Informàtica | 507
        teacher_first_or_create("39", obtainUserIdByEmail("jvaras@iesebre.com"), [
            obtainSpecialityIdByCode('507')  => ['main' => true],
        ], "pending");
// Tur, Sergi (D) | Informàtica | 507
        teacher_first_or_create("40", obtainUserIdByEmail("admin@iesebre.com"), [
            obtainSpecialityIdByCode('507')  => ['main' => true],
        ], "pending");
// Ramos, Jaume (D) | Informàtica | 507
        teacher_first_or_create("41", obtainUserIdByEmail("jaumeramos@iesebre.com"), [
            obtainSpecialityIdByCode('507')  => ['main' => true],
        ], "pending");
// Consarnau, Mireia (D) | Informàtica | 627
        teacher_first_or_create("42", obtainUserIdByEmail("mireiaconsarnau@iesebre.com"), [
            obtainSpecialityIdByCode('627')  => ['main' => true],
        ], "pending");
// Macías, Manel (CS) | Sist. Apli. Infor | 627
        teacher_first_or_create("43", obtainUserIdByEmail("manelmacias@iesebre.com"), [
            obtainSpecialityIdByCode('627')  => ['main' => true],
        ], "pending");
// Perez, Luis (PP) | Sist. Apli. Infor | 627
        teacher_first_or_create("44", obtainUserIdByEmail("luisperez@iesebre.com"), [
            obtainSpecialityIdByCode('627')  => ['main' => true],
        ], "pending");
// Cervellera, José Diego (I) | Sist. Apli. Infor | 627
        teacher_first_or_create("45", obtainUserIdByEmail("josediegocervellera@iesebre.com"), [
            obtainSpecialityIdByCode('627')  => ['main' => true],
        ], "pending");
// Lorente, Enrique (D) | Sist. Apli. Infor | 507
        teacher_first_or_create("46", obtainUserIdByEmail("quiquelorente@iesebre.com"), [
            obtainSpecialityIdByCode('507')  => ['main' => true],
        ], "pending");
// Ferre, Pere (I) | C. civ. edif. | 504
        teacher_first_or_create("47", obtainUserIdByEmail("pereferre@iesebre.com"), [
            obtainSpecialityIdByCode('504')  => ['main' => true],
        ], "pending");
// Guerrero, Pedro (D) | Of. Pr. Constr. | 612
        teacher_first_or_create("48", obtainUserIdByEmail("pedroguerrero@iesebre.com"), [
            obtainSpecialityIdByCode('612')  => ['main' => true],
        ], "pending");
// Ferri, Rosendo (CS) | Mec. Màquines | 611
        teacher_first_or_create("49", obtainUserIdByEmail("rosendoferri@iesebre.com"), [
            obtainSpecialityIdByCode('611')  => ['main' => true],
        ], "pending");
// Sanchez, Jordi (I) | Mec. Màquines | 611
        teacher_first_or_create("50", obtainUserIdByEmail("jordisanchez@iesebre.com"), [
            obtainSpecialityIdByCode('611')  => ['main' => true],
        ], "pending");
// Calderón, J. Luís (D) | O. P. Fab. Mec. | 512
        teacher_first_or_create("51", obtainUserIdByEmail("jcaldero@iesebre.com"), [
            obtainSpecialityIdByCode('512')  => ['main' => true],
        ], "pending");
// Jareño, Salvador (D) | O. P. Fab. Mec. | 512
        teacher_first_or_create("52", obtainUserIdByEmail("sjareno@iesebre.com"), [
            obtainSpecialityIdByCode('512')  => ['main' => true],
        ], "pending");
// Brau, Jordi (I) | O. P. Fab. Mec. | 512
        teacher_first_or_create("53", obtainUserIdByEmail("jordibrau@iesebre.com"), [
            obtainSpecialityIdByCode('512')  => ['main' => true],
        ], "pending");
// Tirón, Joan (D) | Mec. Màquines | 611
        teacher_first_or_create("54", obtainUserIdByEmail("jtiron@iesebre.com"), [
            obtainSpecialityIdByCode('611')  => ['main' => true],
        ], "pending");
// Fernàndez, Ricard (D) | Mec. Màquines | 611
        teacher_first_or_create("55", obtainUserIdByEmail("rfernand@iesebre.com"), [
            obtainSpecialityIdByCode('611')  => ['main' => true],
        ], "pending");
// Arroyo, Ubaldo (D) | Mec. Màquines | 611
        teacher_first_or_create("56", obtainUserIdByEmail("ubaldoarroyo@iesebre.com"), [
            obtainSpecialityIdByCode('611')  => ['main' => true],
        ], "pending");
// Segura, Fernando (D) | Mec. Màquines | 611
        teacher_first_or_create("57", obtainUserIdByEmail("fernandosegura@iesebre.com"), [
            obtainSpecialityIdByCode('611')  => ['main' => true],
        ], "pending");
// Besalduch, Francesc (D) | Mec. Màquines | 611
        teacher_first_or_create("58", obtainUserIdByEmail("sbesalduch@iesebre.com"), [
            obtainSpecialityIdByCode('611')  => ['main' => true],
        ], "pending");
// Segarra, Manel (CS) | Mec. Màquines | 611
        teacher_first_or_create("59", obtainUserIdByEmail("msegarra@iesebre.com"), [
            obtainSpecialityIdByCode('611')  => ['main' => true],
        ], "pending");
// Sales, Mª Jesús (I) | Proce. Sanitaris | 518
        teacher_first_or_create("60", obtainUserIdByEmail("msales@iesebre.com"), [
            obtainSpecialityIdByCode('518')  => ['main' => true],
        ], "pending");
// Asensi, Mª Luisa (PP) | Proce. Sanitaris | 518
        teacher_first_or_create("61", obtainUserIdByEmail("mariaasensi@iesebre.com"), [
            obtainSpecialityIdByCode('518')  => ['main' => true],
        ], "pending");
// Safont, Berta (D) | Proce. Sanitaris | 518
        teacher_first_or_create("62", obtainUserIdByEmail("bertasafont@iesebre.com"), [
            obtainSpecialityIdByCode('518')  => ['main' => true],
        ], "pending");
// López, Santi (I) | Proce. Sanitaris | 518
        teacher_first_or_create("63", obtainUserIdByEmail("santiagolopez@iesebre.com"), [
            obtainSpecialityIdByCode('518')  => ['main' => true],
        ], "pending");
// Valls, Anna (D) | P. Diag. Clínic | 517
        teacher_first_or_create("64", obtainUserIdByEmail("avalls@iesebre.com"), [
            obtainSpecialityIdByCode('517')  => ['main' => true],
        ], "pending");
// Benaiges, Anna (S) | P. Diag. Clínic | 517
        teacher_first_or_create("65", obtainUserIdByEmail("anabenaiges@iesebre.com"), [
            obtainSpecialityIdByCode('517')  => ['main' => true],
        ], "pending");
// Cugat, Pepa  (I) | P. Diag. Clínic | 517
        teacher_first_or_create("66", obtainUserIdByEmail("pepacugat@iesebre.com"), [
            obtainSpecialityIdByCode('517')  => ['main' => true],
        ], "pending");
// Figueres, Salomé (I) | P. Diag. Clínic | 517
        teacher_first_or_create("67", obtainUserIdByEmail("salomefigueres@iesebre.com"), [
            obtainSpecialityIdByCode('517')  => ['main' => true],
        ], "pending");
// Salvador, Sandra (I) | Pro. Clíni. Ortop. | 619
        teacher_first_or_create("68", obtainUserIdByEmail("sandrasalvador@iesebre.com"), [
            obtainSpecialityIdByCode('619')  => ['main' => true],
        ], "pending");
// Ventura, Lluís (D) | Pro. Clíni. Ortop. | 619
        teacher_first_or_create("69", obtainUserIdByEmail("lventura@iesebre.com"), [
            obtainSpecialityIdByCode('619')  => ['main' => true],
        ], "pending");
// Pons, J. Antoni (D) | Pro. Clíni. Ortop. | 619
        teacher_first_or_create("70", obtainUserIdByEmail("jpons@iesebre.com"), [
            obtainSpecialityIdByCode('619')  => ['main' => true],
        ], "pending");
// Fàbrega, Alícia (I) | Pro. Clíni. Ortop. | 619
        teacher_first_or_create("71", obtainUserIdByEmail("aliciafabrega@iesebre.com"), [
            obtainSpecialityIdByCode('619')  => ['main' => true],
        ], "pending");
// Benavent, Segismundo(D) | Pro. Clíni. Ortop. | 619
        teacher_first_or_create("72", obtainUserIdByEmail("sbenavent@iesebre.com"), [
            obtainSpecialityIdByCode('619')  => ['main' => true],
        ], "pending");
// Ramon, Mª Lluïsa (D) | P. Sanit. Assis. | 620
        teacher_first_or_create("73", obtainUserIdByEmail("mramon@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Caballé, Mª. José(D) | P. Sanit. Assis. | 620
        teacher_first_or_create("74", obtainUserIdByEmail("mcaballe@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Puig, Elisa (D) | P. Sanit. Assis. | 620
        teacher_first_or_create("75", obtainUserIdByEmail("epuig@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Hidalgo, Ruth (D) | P. Sanit. Assis. | 620
        teacher_first_or_create("76", obtainUserIdByEmail("rhidalgo@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Sambartolomé, Anna (D) | P. Sanit. Assis. | 620
        teacher_first_or_create("77", obtainUserIdByEmail("annasambartolome@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Mestre, Cinta (I) | P. Sanit. Assis. | 620
        teacher_first_or_create("78", obtainUserIdByEmail("cintamestre@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Profesor nou  S (620) | P. Sanit. Assis. | 620
        teacher_first_or_create("79", obtainUserIdByEmail("fgrau@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Tomás, Trini (S) | P. Sanit. Assis. | 620
        teacher_first_or_create("80", obtainUserIdByEmail("trinidadtomas@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Pérez, Adonay (I) | P. Sanit. Assis. | 620
        teacher_first_or_create("81", obtainUserIdByEmail("aperez@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Royo, Tarsi (D) | Int. Sociocom. | 508
        teacher_first_or_create("82", obtainUserIdByEmail("troyo@iesebre.com"), [
            obtainSpecialityIdByCode('508')  => ['main' => true],
        ], "pending");
// Prof.nou S  (508) | Int. Sociocom. | 508
        teacher_first_or_create("83", obtainUserIdByEmail("carmelorenzo@iesebre.com"), [
            obtainSpecialityIdByCode('508')  => ['main' => true],
        ], "pending");
// Maturana,Iris (I) | Int. Sociocom. | 508
        teacher_first_or_create("84", obtainUserIdByEmail("irismaturana@iesebre.com"), [
            obtainSpecialityIdByCode('508')  => ['main' => true],
        ], "pending");
// Carbó, Llatzer (I) | Serv. Comunit. | 508
        teacher_first_or_create("85", obtainUserIdByEmail("llatzercarbo@iesebre.com"), [
            obtainSpecialityIdByCode('508')  => ['main' => true],
        ], "pending");
// Gilo, Mercè (I) | Serv. Comunit. | 508
        teacher_first_or_create("86", obtainUserIdByEmail("mercegilo@iesebre.com"), [
            obtainSpecialityIdByCode('508')  => ['main' => true],
        ], "pending");
// Cardona, Cristina (D) | Serv. Comunit. | 625
        teacher_first_or_create("87", obtainUserIdByEmail("ccardona99@iesebre.com"), [
            obtainSpecialityIdByCode('625')  => ['main' => true],
        ], "pending");
// Gàmez, David (D) | Serv. Comunit. | 625
        teacher_first_or_create("88", obtainUserIdByEmail("dgamez1@iesebre.com"), [
            obtainSpecialityIdByCode('625')  => ['main' => true],
        ], "pending");
// Garrido, Àngels (D) | Serv. Comunit. | 625
        teacher_first_or_create("89", obtainUserIdByEmail("mgarrido2@iesebre.com"), [
            obtainSpecialityIdByCode('625')  => ['main' => true],
        ], "pending");
// Gamundi, Alícia (D) | Serv. Comunit. | 625
        teacher_first_or_create("90", obtainUserIdByEmail("aliciagamundi@iesebre.com"), [
            obtainSpecialityIdByCode('625')  => ['main' => true],
        ], "pending");
// González, Ricard (D) | Serv. Comunit. | 625
        teacher_first_or_create("91", obtainUserIdByEmail("rgonzalez1@iesebre.com"), [
            obtainSpecialityIdByCode('625')  => ['main' => true],
        ], "pending");
// Mauri, Elena (D) | Serv. Comunit. | 625
        teacher_first_or_create("92", obtainUserIdByEmail("elenamauri@iesebre.com"), [
            obtainSpecialityIdByCode('625')  => ['main' => true],
        ], "pending");
// Alegre, Irene (I) | Serv. Comunit. | 625
        teacher_first_or_create("93", obtainUserIdByEmail("irenealegre@iesebre.com"), [
            obtainSpecialityIdByCode('625')  => ['main' => true],
        ], "pending");
// Grau, Marta (I) | P. Arts gràfiqu. | 522
        teacher_first_or_create("94", obtainUserIdByEmail("noemioms@iesebre.com"), [
            obtainSpecialityIdByCode('522')  => ['main' => true],
        ], "pending");
// Domènech, Gerard (I) | Preimp. Digital | 623
        teacher_first_or_create("95", obtainUserIdByEmail("gerarddomenech@iesebre.com"), [
            obtainSpecialityIdByCode('623')  => ['main' => true],
        ], "pending");
// Fernández, J. Antonio (D) | Preimp. Digital | 623
        teacher_first_or_create("96", obtainUserIdByEmail("joseantoniofernandez1@iesebre.com"), [
            obtainSpecialityIdByCode('623')  => ['main' => true],
        ], "pending");
// Moreno, Mònica (I) | Preimp. Digital | 623
        teacher_first_or_create("97", obtainUserIdByEmail("monicamoreno@iesebre.com"), [
            obtainSpecialityIdByCode('623')  => ['main' => true],
        ], "pending");
// Serra, Eduardo (I) | P. Arts gràfiqu. | 522
        teacher_first_or_create("98", obtainUserIdByEmail("eduardserra@iesebre.com"), [
            obtainSpecialityIdByCode('522')  => ['main' => true],
        ], "pending");
// 0,33 Pepa Cugat (517) | P. Diag. Clínic | 517
        teacher_first_or_create("99", obtainUserIdByEmail("martadelgado@iesebre.com"), [
            obtainSpecialityIdByCode('517')  => ['main' => true],
        ], "pending");
// 0,83 Anna+Cinta (620) | P. Sanit. Assis. | 620
        teacher_first_or_create("100", obtainUserIdByEmail("cristinaarnau@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// 0,66 Trini +Ruth (620) | P. Sanit. Assis. | 620
        teacher_first_or_create("101", obtainUserIdByEmail("mariajosedominguez@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Prof. nou  (620) | P. Sanit. Assis. | 620
        teacher_first_or_create("102", obtainUserIdByEmail("evabenet@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// Planell, Raquel (CS) | Proc. Comerc. | 621
        teacher_first_or_create("105", obtainUserIdByEmail("raquelplanell@iesebre.com"), [
            obtainSpecialityIdByCode('621')  => ['main' => true],
        ], "pending");
// Ferreres, Dolors (I) | Org. Gest. Com. | 510
        teacher_first_or_create("106", obtainUserIdByEmail("dolorsferreres@iesebre.com"), [
            obtainSpecialityIdByCode('510')  => ['main' => true],
        ], "pending");
// Abad, Juan (I) | Org. Gest. Com. | 510
        teacher_first_or_create("107", obtainUserIdByEmail("juandediosabad@iesebre.com"), [
            obtainSpecialityIdByCode('510')  => ['main' => true],
        ], "pending");
// Castells, Maria (I) | Serv. Comunit. | 625
        teacher_first_or_create("108", obtainUserIdByEmail("mariacastells1@iesebre.com"), [
            obtainSpecialityIdByCode('625')  => ['main' => true],
        ], "pending");
// Prof. nou + PA  (620) | P. Sanit. Assis. | 620
        teacher_first_or_create("109", obtainUserIdByEmail("nuriasune@iesebre.com"), [
            obtainSpecialityIdByCode('620')  => ['main' => true],
        ], "pending");
// 0,33 Santi (518) | Proce. Sanitaris | 518
        teacher_first_or_create("110", obtainUserIdByEmail("patriciaprado@iesebre.com"), [
            obtainSpecialityIdByCode('518')  => ['main' => true],
        ], "pending");
// Prof. nou S2 (508) | Int. Sociocom. | 508
        teacher_first_or_create("112", obtainUserIdByEmail("merceferre1@iesebre.com"), [
            obtainSpecialityIdByCode('508')  => ['main' => true],
        ], "pending");
// 0,5 Prof. (525) Vicent | S. Elect. Auto. | 525
        teacher_first_or_create("114", obtainUserIdByEmail("lluculldemolins@iesebre.com"), [
            obtainSpecialityIdByCode('525')  => ['main' => true],
        ], "pending");
// 0,33 Prof.(524) Núria B. | Sist. Electro. | 524
        teacher_first_or_create("115", obtainUserIdByEmail("carlosmonteso@iesebre.com"), [
            obtainSpecialityIdByCode('524')  => ['main' => true],
        ], "pending");
// Cid, J. Joan (I) | Org. Proj. energ. | 513
        teacher_first_or_create("116", obtainUserIdByEmail("joancid1@iesebre.com"), [
            obtainSpecialityIdByCode('513')  => ['main' => true],
        ], "pending");
// Verge,. Gonzalo  A. (PP) | Informàtica | 507
        teacher_first_or_create("117", obtainUserIdByEmail("goncalverge@iesebre.com"), [
            obtainSpecialityIdByCode('507')  => ['main' => true],
        ], "pending");
// Castillo, Begoña (I) | Sist. Apli. Infor | 627
        teacher_first_or_create("118", obtainUserIdByEmail("begonaelvira@iesebre.com"), [
            obtainSpecialityIdByCode('627')  => ['main' => true],
        ], "pending");


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

if (! function_exists('seed_staff')) {
    /**
     * Seed staff.
     */
    function seed_staff()
    {
        seed_administrative_statuses();
        seed_teachers();
        seed_vacancies();
    }
}

