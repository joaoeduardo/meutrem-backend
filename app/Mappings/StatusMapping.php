<?php

namespace App\Mappings;

use App\Entities\Status;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Occurrence;

class StatusMapping extends EntityMapping
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \LaravelDoctrine\Fluent\Mapping::mapFor()
     */
    public function mapFor()
    {
        return Status::class;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \LaravelDoctrine\Fluent\Mapping::map()
     */
    public function map(Fluent $builder)
    {
        $builder->table('status');

        $builder->bigIncrements('id');
        $builder->string('name');
        $builder->hasMany(Occurrence::class)->mappedBy('status');
    }
}
