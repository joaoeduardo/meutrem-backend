<?php
namespace App\Transformers;

use App\Entities\Status;
use League\Fractal\TransformerAbstract;

class StatusTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'occurrence'
    ];

    /**
     *
     * @param Status $status            
     * @return array
     */
    public function transform(Status $status)
    {
        return [
            'id' => $status->getId(),
            'name' => $status->getName()
        ];
    }

    /**
     * Include occurrence
     *
     * @return League\Fractal\ItemResource
     */
    public function includeOccurrence(Status $status)
    {
        $occurrences = $status->getOccurrences();
        
        return $this->collection($occurrences, new OccurrenceTransformer())->setResourceKey('occurrence');
    }
}
