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
     */
    function vacancy_first_or_create($code, $state, $speciality)
    {
        try {
            $vacancy = Vacancy::create([
                'code' => $code,
                'state' => $state,
                'speciality_id' => $speciality,
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
        user_teacher_first_or_create('Carme Aznar', 'carmenaznar@iesebre.com');
        user_teacher_first_or_create('Julià Curto', 'jcurto@iesebre.com');
        user_teacher_first_or_create('Teresa Lasala', 'tlasala@iesebre.com');
        user_teacher_first_or_create('Carmina Andreu', 'candreu@iesebre.com');
        user_teacher_first_or_create('Jose Andrés Brocal', 'jbrocal@iesebre.com');
        user_teacher_first_or_create('Pilar Fadurdo', 'pilarfadurdo@iesebre.com');
        user_teacher_first_or_create('Carlos Querol', 'carlosquerol@iesebre.com');
        user_teacher_first_or_create('Oscar Samo', 'oscarsamo@iesebre.com');
        user_teacher_first_or_create('Enric García', 'egarci@iesebre.com');
        user_teacher_first_or_create('Eduard Ralda', 'eralda@iesebre.com');
        user_teacher_first_or_create('Pili Nuez', 'mnuez@iesebre.com');
        user_teacher_first_or_create('Mª Rosa Ubalde', 'mariarosaubalde@iesebre.com');
        user_teacher_first_or_create('Paqui Pinyol', 'fpinyol@iesebre.com');
        user_teacher_first_or_create('Dolors Subirats', 'dsubirats@iesebre.com');
        user_teacher_first_or_create('Ferran Sabaté', 'fsabate@iesebre.com');
        user_teacher_first_or_create('Araceli Esteller', 'aesteller@iesebre.com');
        user_teacher_first_or_create('Mavi Santamaria', 'mavisantamaria@iesebre.com');
        user_teacher_first_or_create('Agustí Moreso', 'amoreso@iesebre.com');
        user_teacher_first_or_create('Carme Vega', 'cvega@iesebre.com');
        user_teacher_first_or_create('Just Pérez', 'aperez@iesebre.com');
        user_teacher_first_or_create('Armand Pons', 'apons@iesebre.com');
        user_teacher_first_or_create('Núria Bordes', 'nbordes@iesebre.com');
        user_teacher_first_or_create('Laura Llopis', 'laurallopis@iesebre.com');
        user_teacher_first_or_create('Vicent Favà', 'vfava@iesebre.com');
        user_teacher_first_or_create('Agustí Babuí', 'agustinbabuin@iesebre.com');
        user_teacher_first_or_create('Rafael Puig', 'rafaelpuig@iesebre.com');
        user_teacher_first_or_create('Laurea Ferré', 'lferrer@iesebre.com');
        user_teacher_first_or_create('Manel Canalda', 'manelcanalda@iesebre.com');
        user_teacher_first_or_create('Xavi Bel', 'xbel@iesebre.com');
        user_teacher_first_or_create('José Luís Colomé', 'jcolome@iesebre.com');
        user_teacher_first_or_create('Àngel Portillo', 'angelportillo@iesebre.com');
        user_teacher_first_or_create('Santi Sabaté', 'ssabate@iesebre.com');
        user_teacher_first_or_create('Jordi Varas', 'jvaras@iesebre.com');
        user_teacher_first_or_create('Sergi Tur Badenas', 'stur@iesebre.com');
        user_teacher_first_or_create('Jaume Ramos', 'jaumeramos@iesebre.com');
        user_teacher_first_or_create('Mireia Consarnau', 'mireiaconsarnau@iesebre.com');
        user_teacher_first_or_create('Manel Macías', 'manelmacias@iesebre.com');
        user_teacher_first_or_create('Luis Pérez', 'luisperez@iesebre.com');
        user_teacher_first_or_create('José Diego Cervellera', 'josediegocervellera@iesebre.com');
        user_teacher_first_or_create('Quique Lorente', 'quiquelorente@iesebre.com');
        user_teacher_first_or_create('Pere Ferré', 'pereferre@iesebre.com');
        user_teacher_first_or_create('Pedro Guerrero', 'pedroguerrero@iesebre.com');
        user_teacher_first_or_create('Rosendo Ferri', 'rosendoferri@iesebre.com');
        user_teacher_first_or_create('Jordi Sanchez', 'jordisanchez@iesebre.com');
        user_teacher_first_or_create('Jose Luíz Calderón', 'jcaldero@iesebre.com');
        user_teacher_first_or_create('Salvaor Jareño', 'sjareño@iesebre.com');
        user_teacher_first_or_create('Jordi Brau', 'jordibrau@iesebre.com');
        user_teacher_first_or_create('Joan Josep Tirón', 'jtiron@iesebre.com');
        user_teacher_first_or_create('Ricard Fernàndez', 'rfernand@iesebre.com');
        user_teacher_first_or_create('Ubaldo Arroyo', 'ubaldoarroyo@iesebre.com');
        user_teacher_first_or_create('Fernando Segura', 'fernandosegura@iesebre.com');
        user_teacher_first_or_create('Fransesc Besalduch', 'sbesalduch@iesebre.com');
        user_teacher_first_or_create('Manel Segarra', 'msegarra@iesebre.com');
        user_teacher_first_or_create('Mª Jesús Sales', 'msales@iesebre.com');
        user_teacher_first_or_create('Mª Luisa Asensi', 'mariaansensi@iesebre.com');
        user_teacher_first_or_create('Berta Safont', 'bertasafont@iesebre.com');
        user_teacher_first_or_create('Santiago Lopez', 'santiagolopez@iesebre.com');
        user_teacher_first_or_create('Anna Valls', 'avalls@iesebre.com');
        user_teacher_first_or_create('Anna Benaiges', 'anabenaiges@iesebre.com');
        user_teacher_first_or_create('Pepa Cugat', 'pepacugat@iesebre.com');
        user_teacher_first_or_create('Salomé Figueres', 'salomefigueres@iesebre.com');
        user_teacher_first_or_create('Sandra Salvador', 'sandrasalvador@iesebre.com');
        user_teacher_first_or_create('Lluís Ventura', 'lventura@iesebre.com');
        user_teacher_first_or_create('Joan Antoni Pons', 'jpons@iesebre.com');
        user_teacher_first_or_create('Alícia Fàbrega', 'aliciafabrega@iesebre.com');
        user_teacher_first_or_create('Segismundo Benavent', 'sbenavent@iesebre.com');
        user_teacher_first_or_create('Mª LluÏsa Ramon', 'mramon@iesebre.com');
        user_teacher_first_or_create('Mª José Caballé', 'mcaballe@iesebre.com');
        user_teacher_first_or_create('Elisa Puig', 'epuig@iesebre.com');
        user_teacher_first_or_create('Ruth Hidalgo', 'rhidalgo@iesebre.com');
        user_teacher_first_or_create('Anna Sambartolomé', 'annasambartolome@iesebre.com');
        user_teacher_first_or_create('Cinta Mestre', 'cintamestre@iesebre.com');
        user_teacher_first_or_create('Trinidad Tomás', 'trinidadtomas@iesebre.com');
        user_teacher_first_or_create('Adonay Pérez', 'aperez@iesebre.com');
        user_teacher_first_or_create('Tarsi Royo', 'troyo@iesebre.com');
        user_teacher_first_or_create('Iris Maturana', 'irismaturana@iesebre.com');
        user_teacher_first_or_create('Llàtzer Carbó', 'llatzercarbo@iesebre.com');
        user_teacher_first_or_create('Mercè Gilo', 'mercegilo@iesebre.com');
        user_teacher_first_or_create('Cristina Cardona', 'ccardona99@iesebre.com');
        user_teacher_first_or_create('David Gàmez', 'dgamez1@iesebre.com');
        user_teacher_first_or_create('Àngels Garrido', 'mgarrido2@iesebre.com');
        user_teacher_first_or_create('Alícia Gamundi', 'aliciagamundi@iesebre.com');
        user_teacher_first_or_create('Ricard González', 'rgonzalez1@iesebre.com');
        user_teacher_first_or_create('Elena Mauri', 'elenamauri@iesebre.com');
        user_teacher_first_or_create('Irene Alegre', 'irenealegre@iesebre.com');
        user_teacher_first_or_create('Marta Grau', 'martagrau@iesebre.com');
        user_teacher_first_or_create('Gerard Domènech', 'gerarddomenech@iesebre.com');
        user_teacher_first_or_create('Jose Antonio Fernández', 'joseantoniofernandez1@iesebre.com');
        user_teacher_first_or_create('Mònica Moreno', 'monicamoreno@iesebre.com');
        user_teacher_first_or_create('Eduardo Serra', 'eduardserra@iesebre.com');
        user_teacher_first_or_create('Raquel Planell', 'raquelplanell@iesebre.com');
        user_teacher_first_or_create('Dolors Ferreres', 'dolorsferreres@iesebre.com');
        user_teacher_first_or_create('Juan de Dios Abad', 'juandediosabad@iesebre.com');
        user_teacher_first_or_create('Maria Castells', 'mariacastells1@iesebre.com');
        user_teacher_first_or_create('Joan Cid', 'joancid1@iesebre.com');
        user_teacher_first_or_create('Gonzalo Verge', 'goncalverge@iesebre.com');
        user_teacher_first_or_create('Begoña Castillo', 'begonaelvira@iesebre.com');
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
