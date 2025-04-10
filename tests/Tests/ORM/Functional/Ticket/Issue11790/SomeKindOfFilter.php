<?php

declare(strict_types=1);

namespace Doctrine\Tests\ORM\Functional\Ticket\Issue11790;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class SomeKindOfFilter extends SQLFilter
{
    public const NAME = 'someKindOfFilter';

    public function addFilterConstraint(ClassMetadata $targetEntity, string $targetTableAlias): string
    {
        /**
         * This should be enough to change the filter hash
         */
        return 'TRUE';
    }
}
