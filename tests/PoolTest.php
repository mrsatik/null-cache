<?php
declare(strict_types=1);

namespace mrsatik\NullCacheTest;

use PHPUnit\Framework\TestCase;
use mrsatik\NullCache\CachePool;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\CacheItemInterface;

class PoolTest extends TestCase
{
    /**
     * @var CacheItemPoolInterface
     */
    private $instance;

    public function setUp(): void
    {
        $this->instance = new CachePool();
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testGetItem(string $key)
    {
        $result = $this->instance->getItem($key);
        $this->assertEquals($result, null);
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testGetItems(string $key)
    {
        $result = $this->instance->getItems([$key]);
        $this->assertEquals($result, []);
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testHasItem(string $key)
    {
        $result = $this->instance->hasItem([$key]);
        $this->assertEquals($result, null);
    }

    public function testClear()
    {
        $result = $this->instance->clear();
        $this->assertEquals($result, true);
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testDeleteItem(string $key)
    {
        $result = $this->instance->deleteItem($key);
        $this->assertEquals($result, true);
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testDeleteItemDelay($key)
    {
        $result = $this->instance->deleteItemDelay($key, 1);
        $this->assertEquals($result, true);
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testDeleteItems(string $key)
    {
        $result = $this->instance->deleteItems([$key]);
        $this->assertEquals($result, true);
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testSave(string $key)
    {
        $saveItem = $this->getMockBuilder(CacheItemInterface::class)->getMock();
        $result = $this->instance->save($saveItem);
        $this->assertEquals($result, true);
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testSaveDeferred(string $key)
    {
        $saveItem = $this->getMockBuilder(CacheItemInterface::class)->getMock();
        $result = $this->instance->saveDeferred($saveItem);
        $this->assertEquals($result, true);
    }

    public function testCommit()
    {
        $result = $this->instance->commit();
        $this->assertEquals($result, true);
    }

    public function testGetTimeToRebuild()
    {
        $result = $this->instance->getTimeToRebuild();
        $reflection = new \ReflectionClass($this->instance);
        $defaultRebuildCount = $reflection->getConstant('DEFAULT_TIME_TO_REBUILD');

        $this->assertEquals($result, $defaultRebuildCount);
    }

    public function testSetTimeToRebuild()
    {
        $result = $this->instance->setTimeToRebuild(0);
        $this->assertEquals($result, null);
    }
    
    public function testGetCountToRebuild()
    {
        $result = $this->instance->getCountToRebuild();
        $reflection = new \ReflectionClass($this->instance);
        $defaultRebuildCount = $reflection->getConstant('DEFAULT_REBUILD_CHECK_COUNT');

        $this->assertEquals($result, $defaultRebuildCount);
    }
    
    public function testSetCountToRebuild()
    {
        $result = $this->instance->setCountToRebuild(0);
        $this->assertEquals($result, null);
    }

    public function testGetRebuildCheckPeriod()
    {
        $result = $this->instance->getRebuildCheckPeriod();
        $this->assertEquals($result, null);
    }
    
    public function testSetRebuildCheckPeriod()
    {
        $result = $this->instance->setRebuildCheckPeriod();
        $this->assertEquals($result, null);
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testDeleteByTag(string $tag)
    {
        $result = $this->instance->deleteByTag($tag);
        $this->assertEquals($result, true);
    }

    /**
     * @dataProvider getKeysDataProvider
     */
    public function testDeleteByTags(string $tag)
    {
        $result = $this->instance->deleteByTags([$tag]);
        $this->assertEquals($result, true);
    }

    public function getKeysDataProvider()
    {
        return [
            [md5(microtime())],
            [md5('123')],
            [md5('test')],
            ['test'],
        ];
    }
}