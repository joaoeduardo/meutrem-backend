<?php

namespace App\Mappings;

use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Occurrence;
use App\Entities\Status;
use App\Entities\Line;

class OccurrenceMapping extends EntityMapping
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \LaravelDoctrine\Fluent\Mapping::mapFor()
     */
    public function mapFor()
    {
        return Occurrence::class;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \LaravelDoctrine\Fluent\Mapping::map()
     */
    public function map(Fluent $builder)
    {
        $builder->table('occurrence');

        $builder->bigIncrements('id');
        $builder->text('description');
        $builder->belongsTo(Status::class)->inversedBy('occurrences');
        $builder->belongsTo(Line::class)->inversedBy('occurrences');
        $builder->dateTime('startedAt');
        $builder->dateTime('finishedAt')->nullable();
    }
}
