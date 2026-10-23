<?php

namespace App\Interfaces;
 
use App\Collections\GitHub\RepoCollection;
use App\DataTransferObjects\GitHub\NewRepoData;
use App\DataTransferObjects\GitHub\Repo;
use App\DataTransferObjects\GitHub\UpdateRepoData;
 
interface GitHub
{
    public function getRepos(): RepoCollection;
 
    public function getRepo(string $owner, string $repoName): Repo;
 
    public function getRepoLanguages(string $owner, string $repoName): array;
 
    public function createRepo(NewRepoData $repoData): Repo;
 
    public function updateRepo(
        string $owner,
        string $repoName,
        UpdateRepoData $repoData
    ): Repo;
 
    public function deleteRepo(string $owner, string $repoName): void;
}