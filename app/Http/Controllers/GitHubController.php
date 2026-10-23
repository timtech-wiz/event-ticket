<?php

namespace App\Http\Controllers;

use App\Interfaces\GitHub;
use Illuminate\Http\Request;

final class GitHubController extends Controller
{
    
    public function show(string $owner, string $name, GitHub $gitHub) {
            $repo = $gitHub->getRepo(
            owner: $owner,
            repoName: $name,
        );
        return response()->json($repo);
    }

    public function getLanguages(string $owner, string $name, GitHub $gitHub) {
            $repo = $gitHub->getRepoLanguages(
            owner: $owner,
            repoName: $name,
        );
        return response()->json($repo);
    }
}
