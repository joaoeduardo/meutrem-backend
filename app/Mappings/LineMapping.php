<?php

namespace App\Mappings;

use App\Entities\Company;
use App\Entities\Line;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Occurrence;

class LineMapping extends EntityMapping
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \LaravelDoctrine\Fluent\Mapping::mapFor()
     */
    public function mapFor()
    {
        return Line::class;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \LaravelDoctrine\Fluent\Mapping::map()
     */
    public function map(Fluent $builder)
    {
        $builder->table('line');

        $builder->integer('id')->unsigned()->primary();
        $builder->string('name');
        $builder->string('color');
        $builder->belongsTo(Company::class)->inversedBy('lines');
        $builder->hasMany(Occurrence::class)->mappedBy('line');
    }
}
