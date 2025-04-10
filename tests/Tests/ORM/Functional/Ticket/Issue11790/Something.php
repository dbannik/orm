<?php

declare(strict_types=1);

namespace Doctrine\Tests\ORM\Functional\Ticket\Issue11790;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'Something')]
class Something
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    public int $id;

    /** @var Collection<int, SomethingElse> */
    #[ORM\OneToMany(targetEntity: SomethingElse::class, mappedBy: 'something', fetch: 'LAZY')]
    public Collection $somethingElseCollection;

    public function __construct()
    {
        $this->somethingElseCollection = new ArrayCollection();
    }
}
