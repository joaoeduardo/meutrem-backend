<?php

namespace App\Transformers;

use App\Entities\Company;
use League\Fractal\TransformerAbstract;

class CompanyTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'line'
    ];

    /**
     *
     * @param Company $company
     * @return array
     */
    public function transform(Company $company)
    {
        return [
            'id'   => $company->getId(),
            'name' => $company->getName(),
            'slug' => $company->getSlug()
        ];
    }

    /**
     * Include line
     *
     * @return League\Fractal\ItemResource
     */
    public function includeLine(Company $company)
    {
        $lines = $company->getLines();

        return $this->collection($lines, new LineTransformer())->setResourceKey('line');
    }
}
