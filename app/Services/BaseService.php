<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseService implements BaseServiceInterface
{
    /**
     * Model for which the service is provided.
     */
    protected $model;

    /**
     * BaseService constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Prepares the data for creating a new record.
     *
     * @param Request $request
     * @return mixed
     */
    public function prepareDataForCreate(Request $request)
    {
        return $request->only($this->model->getFillable());
    }

    /**
     * Prepares the data for updating an existing record.
     *
     * @param Request $request
     * @return mixed
     */
    public function prepareDataForUpdate(Request $request)
    {

        return $this->prepareDataForCreate($request);
    }

    /**
     * Creates a new entry on the database.
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $this->prepareDataForCreate($request);
            $entry = $this->model->create($data);
            DB::commit();
            return $entry;
        } catch (\Exception $e) {
            return $this->handleDatabaseException($e);
        }
    }

    /**
     * Updates an existing entry on the database.
     *
     * @param Request $request
     * @param $id
     * @param string $primaryKey
     * @return mixed
     */
    public function update(Request $request, $id, string $primaryKey = 'id')
    {
        DB::beginTransaction();
        try {
            $data = $this->prepareDataForUpdate($request);
            $entry = $this->model->where($primaryKey, '=', $id)->update($data);
            DB::commit();
            return $entry;
        } catch (\Exception $e) {
            return $this->handleDatabaseException($e);
        }
    }

    /**
     * Deletes an existing entry on the database.
     *
     * @param $id
     * @param string $primaryKey
     * @return mixed
     */
    public function delete($id, string $primaryKey = 'id')
    {
        DB::beginTransaction();
        try {
            $operation = $this->model->where($primaryKey, '=', $id)->delete();
            DB::commit();
            return $operation;
        } catch (\Exception $e) {
            return $this->handleDatabaseException($e);
        }
    }

    /**
     * Returns a success redirect with success message
     *
     * @param string $operationType
     * @param string $route
     * @param bool $success
     * @param string|null $msg
     * @return mixed
     */
    public function redirectWithResponse(string $operationType, string $route, bool $success = true, string $msg = null)
    {
        $message = '';
        switch ($operationType) {
            case 'create':
                $message = $success ? __('Record created successfully') : __('Record could not be created.');
                break;
            case 'edit':
                $message = $success ? __('Record updated successfully') : __('Record could not be updated.');
                break;
            case 'delete':
                $message = $success ? __('Record deleted successfully') : __('Record could not be deleted.');
                break;
            default:
                $message = __('Invalid operation');
        }
        return redirect($route)->with($success ? 'status' : 'error', !empty($msg) ? $msg : $message);
    }

    /**
     * Handles the exception by rolling back database transaction and logging the exception.
     *
     * @param \Exception $e
     * @return |null
     */
    protected function handleDatabaseException(\Exception $e)
    {
        \Log::info($e);
        DB::rollBack();
        return null;
    }

}
