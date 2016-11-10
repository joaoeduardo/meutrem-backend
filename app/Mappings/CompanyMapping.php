<?php

namespace App\Mappings;

use App\Entities\Company;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use App\Entities\Line;

class CompanyMapping extends EntityMapping
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \LaravelDoctrine\Fluent\Mapping::mapFor()
     */
    public function mapFor()
    {
        return Company::class;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \LaravelDoctrine\Fluent\Mapping::map()
     */
    public function map(Fluent $builder)
    {
        $builder->table('company');

        $builder->increments('id');
        $builder->string('name');
        $builder->string('slug');
        $builder->hasMany(Line::class)->mappedBy('company');
    }
}
