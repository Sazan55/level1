<?php

namespace Recca0120\Repository\Tests\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Recca0120\Repository\Criteria;

class EloquentBuildsQueriesTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function test_where_key()
    {
        $criteria = Criteria::create()->whereKey($id = 'foo');
        $this->assertEquals($criteria->toArray(), [[
            'method' => 'whereKey',
            'parameters' => [$id],
        ]]);
        $this->assertInstanceOf(Criteria::class, $criteria);
    }

    public function test_where_key_not()
    {
        $criteria = Criteria::create()->whereKeyNot($id = 'foo');
        $this->assertEquals($criteria->toArray(), [[
            'method' => 'whereKeyNot',
            'parameters' => [$id],
        ]]);
        $this->assertInstanceOf(Criteria::class, $criteria);
    }

    public function test_with()
    {
        $criteria = Criteria::create()->with(
            $relations = 'foo'
        );
        $this->assertEquals($criteria->toArray(), [[
            'method' => 'with',
            'parameters' => [$relations],
        ]]);
        $this->assertInstanceOf(Criteria::class, $criteria);
    }

    public function test_without()
    {
        $criteria = Criteria::create()->without(
            $relations = 'foo'
        );
        $this->assertEquals($criteria->toArray(), [[
            'method' => 'without',
            'parameters' => [$relations],
        ]]);
        $this->assertInstanceOf(Criteria::class, $criteria);
    }

    public function test_set_query()
    {
        $criteria = Criteria::create()->setQuery(
            $query = m::mock(Builder::class)
        );
        $this->assertEquals($criteria->toArray(), [[
            'method' => 'setQuery',
            'parameters' => [$query],
        ]]);
        $this->assertInstanceOf(Criteria::class, $criteria);
    }

    public function test_set_model()
    {
        $criteria = Criteria::create()->setModel(
            $model = m::mock(Model::class)
        );
        $this->assertEquals($criteria->toArray(), [[
            'method' => 'setModel',
            'parameters' => [$model],
        ]]);
        $this->assertInstanceOf(Criteria::class, $criteria);
    }

    public function test_on_write_connection()
    {
        $criteria = Criteria::create()->onWriteConnection();
        $this->assertEquals($criteria->toArray(), [[
            'method' => 'useWritePdo',
            'parameters' => [],
        ]]);
        $this->assertInstanceOf(Criteria::class, $criteria);
    }
}
