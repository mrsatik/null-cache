<?php
declare(strict_types=1);

namespace mrsatik\NullCache;

interface PoolInterface
{
    public function getTimeToRebuild(): int;

    public function setTimeToRebuild(?int $time = CachePool::DEFAULT_TIME_TO_REBUILD): void;

    public function getCountToRebuild(): int;

    public function setCountToRebuild(?int $count = CachePool::DEFAULT_REBUILD_CHECK_COUNT): void;

    public function getRebuildCheckPeriod(): ?float;

    public function setRebuildCheckPeriod(?float $period = null): void;

    public function deleteByTag(string $tag): bool;

    public function deleteByTags(array $tags): bool;
    
    /**
     * Дает сбросить кеш отложено
     * @param string $key
     * @param int $timeInSeconds
     * @return bool
     */
    public function deleteItemDelay(string $key, int $timeInSeconds = CachePool::EXPIRE_DELAY): bool;
}
