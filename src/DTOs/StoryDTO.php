<?php
declare(strict_types=1);

namespace Denitsa\ShitGotDone;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class StoryDTO extends DataTransferObject
{
    public string $name;
    public string $state;
    public string $type;
    public ?string $completedAt;

    public static function fromResponse(array $data, string $state) {
         return new self([
            'name' => $data['name'],
            'state' => $state,
            'type' => $data['story_type'],
            'completedAt' => $data['completed_at'] ? Carbon::parse($data['completed_at'])->format('Y-m-d') : null,
        ]);
    }
}
