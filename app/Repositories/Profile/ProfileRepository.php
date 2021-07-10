<?php


namespace App\Repositories\Profile;


use App\Models\Profile;
use App\Repositories\BaseRepository;

class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface
{
    /**
     * ProfileRepository constructor.
     *
     * @param Profile $profile
     */
    public function __construct(Profile $profile)
    {
        parent::__construct($profile);
    }
}
