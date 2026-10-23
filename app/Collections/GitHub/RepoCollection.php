<?php

namespace App\Collections\GitHub;

use Illuminate\Support\Collection;
use App\DataTransferObjects\GitHub\Repo;

/** @extends Collection<int,Repo> */
class RepoCollection extends Collection
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
}
