<?php


namespace App\Services\Profile;


use App\Models\Profile;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProfileService extends BaseService implements ProfileServiceInterface
{


    public function __construct(Profile $profile)
    {
        parent::__construct($profile);
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

            // get file name
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();

            // patch image name in $data variable to store in table;
            $data['image'] = $imageName;

            // move file to public folder
            request()->image->move(public_path('images'), $imageName);

            // store in table
            $profile = $this->model->create($data);

            // store in education qualification table
            foreach ($request['qualification'] as $q) {
                $q['profile_id'] = $profile->id;
                $this->model->qualification_create()->create($q);
            }

            // CSV start
            $filePath = base_path() . '/public/csv/';
            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }
            $csvFile = $filePath . $profile->id . '.csv';
            $fp = fopen($csvFile, 'w');

            $columns = array('name', 'gender', 'phone', 'email', 'nationality', 'date_of_birth', 'mode_of_contact');

            $binds = array($columns,
                array(
                    $profile->name,
                    $profile->gender,
                    $profile->phone,
                    $profile->email,
                    $profile->nationality,
                    $profile->date_of_birth,
                    $profile->mode_of_contact,
                )
            );
            foreach ($binds as $fields) {
                fputcsv($fp, $fields);
            }

            fclose($fp);


            DB::commit();

            return $profile;
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

            // get file name
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();

            // patch image name in $data variable to store in table;
            $data['image'] = $imageName;

            // move file to public folder
            request()->image->move(public_path('images'), $imageName);

            // store in table
            $profile = $this->model->where($primaryKey, '=', $id)->update($data);


            // update in education qualification table
            foreach ($request['qualification'] as $q) {
                $q['profile_id'] = $id;
                $this->model->qualification_create()->create($q);
            }
            DB::commit();

            return $profile;
        } catch (\Exception $e) {
            return $this->handleDatabaseException($e);
        }
    }

    /**
     * Prepares the data for deleting an existing record.
     *
     * @param $id
     * @param string $primaryKey
     * @return mixed
     */
    public function delete($id, string $primaryKey = 'id')
    {
        DB::beginTransaction();
        try {
            $data = $this->model->where($primaryKey, '=', $id)->first();
            $data->delete();
            DB::commit();

            return $data;
        } catch (\Exception $e) {
            return $this->handleDatabaseException($e);
        }
    }


}
