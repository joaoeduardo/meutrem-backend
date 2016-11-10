<?php

namespace App\Transformers;

use App\Entities\Line;
use League\Fractal\TransformerAbstract;

class LineTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'occurrence',
        'company'
    ];

    /**
     *
     * @param Line $line
     * @return array
     */
    public function transform(Line $line)
    {
        return [
            'id' => $line->getId(),
            'name' => $line->getName(),
            'color' => $line->getColor()
        ];
    }

    /**
     * Include occurrence
     *
     * @return League\Fractal\ItemResource
     */
    public function includeOccurrence(Line $line)
    {
        $occurrences = $line->getOccurrences();

        return $this->collection($occurrences, new OccurrenceTransformer())->setResourceKey('occurrence');
    }

    /**
     * Include company
     *
     * @return League\Fractal\ItemResource
     */
    public function includeCompany(Line $line)
    {
        $company = $line->getCompany();

        return $this->item($company, new CompanyTransformer())->setResourceKey('company');
    }
}
