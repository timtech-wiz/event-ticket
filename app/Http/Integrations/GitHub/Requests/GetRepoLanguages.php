<?php

namespace App\Http\Integrations\GitHub\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRepoLanguages extends Request
{

    public function __construct(
        private readonly string $owner,
        private readonly string $repo
    ) {}
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/repos/'.$this->owner.'/'.$this->repo.'/languages';
    }
}
