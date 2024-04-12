<?php
declare(strict_types=1);

namespace mrsatik\NullCache;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\CacheItemInterface;

class CachePool implements CacheItemPoolInterface, PoolInterface
{
    public const DEFAULT_TIME_TO_REBUILD = 0;

    public const DEFAULT_REBUILD_CHECK_COUNT = 0;

    public const EXPIRE_DELAY = 0;

    /**
     * {@inheritDoc}
     * @see CacheItemPoolInterface::getItem()
     */
    public function getItem($key)
    {
        return null;
    }

    /**
     * {@inheritDoc}
     * @see CacheItemPoolInterface::getItems()
     */
    public function getItems(array $keys = [])
    {
        return [];
    }

    /**
     * {@inheritDoc}
     * @see CacheItemPoolInterface::hasItem()
     */
    public function hasItem($key)
    {
        return false;
    }

    /**
     * {@inheritDoc}
     * @see CacheItemPoolInterface::clear()
     */
    public function clear()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     * @see CacheItemPoolInterface::deleteItem()
     */
    public function deleteItem($key)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     * @see CacheItemPoolInterface::deleteItems()
     */
    public function deleteItems(array $keys)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     * @see PoolInterface::deleteItemDelay()
     */
    public function deleteItemDelay(string $key, int $timeInSeconds = CachePool::EXPIRE_DELAY): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     * @see CacheItemPoolInterface::save()
     */
    public function save(CacheItemInterface $item)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     * @see CacheItemPoolInterface::saveDeferred()
     */
    public function saveDeferred(CacheItemInterface $item)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     * @see CacheItemPoolInterface::commit()
     */
    public function commit()
    {
        return true;
    }

    public function getTimeToRebuild(): int
    {
        return self::DEFAULT_TIME_TO_REBUILD;
    }

    public function setTimeToRebuild(?int $time = CachePool::DEFAULT_TIME_TO_REBUILD): void
    {
        // empty
    }

    public function getCountToRebuild(): int
    {
        return self::DEFAULT_REBUILD_CHECK_COUNT;
    }

    public function setCountToRebuild(?int $count = CachePool::DEFAULT_REBUILD_CHECK_COUNT): void
    {
        //empty
    }

    public function getRebuildCheckPeriod(): ?float
    {
        return null;
    }

    public function setRebuildCheckPeriod(?float $period = null): void
    {
        // empty
    }

    public function deleteByTag(string $tag): bool
    {
        return true;
    }

    public function deleteByTags(array $tags): bool
    {
        return true;
    }
}