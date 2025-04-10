<?php

declare(strict_types=1);

namespace Doctrine\Tests\ORM\Functional\Ticket\Issue11790;

use Doctrine\Tests\OrmFunctionalTestCase;

final class TestIssue11790 extends OrmFunctionalTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpEntitySchema([
            Something::class,
            SomethingElse::class,
        ]);

        $this->_em->getConfiguration()->addFilter(SomeKindOfFilter::NAME, SomeKindOfFilter::class);
    }

    public function test(): void
    {
        $this->generate();

        $somethingElseCollection = $this->_em->getRepository(SomethingElse::class)->findAll();

        self::assertCount(1, $somethingElseCollection);

        $something = $somethingElseCollection[0]->something;
        self::assertInstanceOf(Something::class, $something);

        $this->_em->getFilters()->enable(SomeKindOfFilter::NAME);
        $collection = $something->somethingElseCollection;

        self::assertCount(1, $collection);

//        $sqlList = array_map(fn (array $query) => $query['sql'], $this->_em->getConnection()->queryLog->queries);
//        print_r($sqlList);
    }

    private function generate(): void
    {
        $something     = new Something();
        $somethingElse = new SomethingElse($something);

        $this->_em->persist($something);
        $this->_em->persist($somethingElse);
        $this->_em->flush();
        $this->_em->clear();
    }
}
