<?php


namespace App\Services;


use Illuminate\Http\Request;

interface BaseServiceInterface
{
    /**
     * Prepares the data for creating a new record.
     *
     * @param Request $request
     * @return mixed
     */
    public function prepareDataForCreate(Request $request);

    /**
     * Prepares the data for updating an existing record.
     *
     * @param Request $request
     * @return mixed
     */
    public function prepareDataForUpdate(Request $request);

    /**
     * Creates a new entry on the database.
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);

    /**
     * Updates an existing entry on the database.
     *
     * @param Request $request
     * @param $id
     * @param string $primaryKey
     * @return mixed
     */
    public function update(Request $request, $id, string $primaryKey = 'id');

    /**
     * Deletes an existing entry on the database.
     *
     * @param $id
     * @param string $primaryKey
     * @return mixed
     */
    public function delete($id, string $primaryKey = 'id');

    /**
     * Returns a success redirect with success message
     *
     * @param string $operationType
     * @param string $route
     * @param bool $success
     * @param string $msg
     * @return mixed
     */
    public function redirectWithResponse(string $operationType, string $route, bool $success = true, string $msg = null);
}
