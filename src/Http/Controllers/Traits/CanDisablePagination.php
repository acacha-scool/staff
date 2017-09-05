<?php

namespace Acacha\Scool\Staff\Http\Controllers\Traits;

use Illuminate\Http\Request;

/**
 * Class CanDisablePagination
 */
trait CanDisablePagination
{
    /**
     * Check if pagination is disabled.
     *
     * @param Request $request
     * @return bool
     */
    protected function paginationIsDisabled(Request $request) {
        return $request->has('paginate') && ($request->input('paginate') === "false");
    }
}