<?php

namespace App\Doctrine;

use Carbon\Carbon;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeType;

class CarbonType extends DateTimeType
{

    /**
     * {@inheritDoc}
     * @see \Doctrine\DBAL\Types\DateTimeType::convertToPHPValue()
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return is_null($value) ? null : Carbon::instance(parent::convertToPHPValue($value, $platform));
    }
}

