<?php

declare(strict_types=1);

namespace Doctrine\Tests\ORM\Functional\Ticket\Issue11790;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'SomethingElse')]
class SomethingElse
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    public int $id;

    #[ORM\ManyToOne(targetEntity: Something::class, inversedBy: 'somethingElseCollection')]
    #[ORM\JoinColumn(referencedColumnName: 'id')]
    public Something $something;

    public function __construct(Something $something)
    {
        $this->something = $something;
    }
}
