<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Services\Profile\ProfileServiceInterface;
use Illuminate\Http\Request;

class ProfileController extends ApiBaseController
{


    protected $profileRepository;
    protected $profileService;

    public function __construct(ProfileServiceInterface $profileService,
                                ProfileRepositoryInterface $profileRepository
    )
    {
        $this->profileRepository = $profileRepository;
        $this->profileService = $profileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "test";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = $this->profileService->create($request);
        return $this->respondWithMessage('Created Successfully', $profile);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $profile = $this->profileService->update($request, $profile->id);
        return $this->respondWithMessage('Updated Successfully', $profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile = $this->profileService->delete($profile->id);
        return $this->respondWithMessage('Deleted Successfully', $profile);
    }
}
