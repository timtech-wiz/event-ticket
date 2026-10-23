<?php

namespace App\Services\GitHub;

use App\Collections\GitHub\RepoCollection;
use App\DataTransferObjects\GitHub\NewRepoData;
use App\DataTransferObjects\GitHub\Repo;
use App\Http\Integrations\GitHub\Requests\GetRepo;
use App\DataTransferObjects\GitHub\UpdateRepoData;
use App\Http\Integrations\GitHub\GitHubConnector;
use App\Http\Integrations\GitHub\Requests\GetRepoLanguages;
use App\Interfaces\GitHub;

final readonly class GitHubService implements GitHub
{

    public function __construct(private readonly string $token) {}

     private function connector(): GitHubConnector
    {
        return new GitHubConnector($this->token);
    }

    public function getRepos(): RepoCollection
    {

    }

    public function getRepo(string $owner, string $repoName): Repo
    {
 
         return $this->connector()->send(new GetRepo($owner, $repoName))->dtoOrFail();
   }

    public function getRepoLanguages(string $owner, string $repoName): array
    {
        return $this->connector()->send(new GetRepoLanguages($owner, $repoName))
            ->collect()
            ->keys()
            ->all();;
    }

    public function createRepo(NewRepoData $repoData): Repo
    {
        //return $this->github->createRepo($repoData);
    }

    public function updateRepo(
        string $owner,
        string $repoName,
        UpdateRepoData $repoData
    ): Repo {
        //return $this->github->updateRepo($owner, $repoName, $repoData);
    }

    public function deleteRepo(string $owner, string $repoName): void
    {
        //$this->github->deleteRepo($owner, $repoName);
    }
}
