<?php

namespace App\Transformers;

use App\Entities\Occurrence;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class OccurrenceTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'status'
    ];

    /**
     *
     * @param Occurrence $occurrence
     * @return array
     */
    public function transform(Occurrence $occurrence)
    {
        Carbon::setToStringFormat('Y-m-d H:i:s');

        return [
            'id' => $occurrence->getId(),
            'description' => $occurrence->getDescription(),
            'startedAt' => (string) $occurrence->getStartedAt(),
            'finishedAt' => (string) $occurrence->getFinishedAt()
        ];

        Carbon::resetToStringFormat();
    }

    /**
     * Include status
     *
     * @return League\Fractal\ItemResource
     */
    public function includeStatus(Occurrence $occurrence)
    {
        $status = $occurrence->getStatus();

        return $this->item($status, new StatusTransformer())->setResourceKey('status');
    }
}
