<?php

namespace Acacha\Scool\Staff;

/**
 * Class ScoolStaff.
 *
 * @package Acacha\Scool\Staff\Providers
 */
class ScoolStaff
{
    /**
     * Views copy path.
     *
     * @return array
     */
    public function views()
    {
        return [
            SCOOLSTAFF_PATH.'/resources/views/assign-user-to-teacher.blade.php' =>
                resource_path('views/vendor/acacha_scool_staff/assign-user-to-teacher.blade.php')
        ];
    }

    /**
     * Seeds copy path.
     *
     * @return array
     */
    public function seeds()
    {
        return [
            SCOOLSTAFF_PATH.'/database/seeds' =>
                database_path('seeds')
        ];
    }
}