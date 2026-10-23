<?php

namespace App\DataTransferObjects\GitHub;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

final readonly class Repo
{
    public function __construct(
    public int $id,
    public string $owner,
    public string $name,
    public string $fullName,
    public bool $private,
    public string $description,
    public CarbonInterface $createdAt,

) {}


    public static function fromResponse(array $response): static
    {
        return new static(
            id: $response['id'],
            owner: $response['owner']['login'],
            name: $response['name'],
            fullName: $response['full_name'],
            private: $response['private'],
            description: $response['description'] ?? '',
            createdAt: Carbon::parse($response['created_at']),
        );
    }
}