<?php

namespace App\Collections\GitHub;

use App\DataTransferObjects\GitHub\Repo;
use Illuminate\Support\Collection;

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
