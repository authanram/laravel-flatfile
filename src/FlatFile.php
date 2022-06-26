<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Authanram\FlatFile\Contracts\FlatFileAdapterContract as AdapterContract;
use Authanram\FlatFile\Contracts\FlatFileContract;
use InvalidArgumentException;
use Throwable;

final class FlatFile implements FlatFileContract
{
    private AdapterContract $storageAdapter;

    private array $eventHandlers;

    /**
     * @throws Throwable
     */
    public function getStorageAdapter(): AdapterContract
    {
        return $this->storageAdapter;
    }

    public function setStorageAdapter(AdapterContract $storageAdapter): self
    {
        $this->storageAdapter = $storageAdapter;

        return $this;
    }

    public function getEventHandlers(): array
    {
        return $this->eventHandlers;
    }

    /**
     * @throws Throwable
     */
    public function setEventHandlers(array|string $eventHandlers): self
    {
        self::authorizeEventHandlers($eventHandlers);

        if (is_string($eventHandlers)) {
            $eventHandlers = collect(get_class_methods($eventHandlers))
                ->mapWithKeys(fn (string $method) => [
                    $method => fn (...$args) => $eventHandlers::{$method}(...$args),
                ])->toArray();
        }

        $this->eventHandlers = collect($eventHandlers)
            ->mapWithKeys(static function ($eventHandlers, string $key) {
                throw_if(
                    is_callable($eventHandlers) === false,
                    InvalidArgumentException::class,
                    'Expected a callable. Got: '. gettype($eventHandlers),
                );

                return [$key => $eventHandlers];
            })->toArray();

        return $this;
    }

    /**
     * @throws Throwable
     */
    private static function authorizeEventHandlers(array|string $eventHandlers): void
    {
        throw_if(
            is_array($eventHandlers) && array_is_list($eventHandlers),
            InvalidArgumentException::class,
            'Expected map - associative array with string keys.',
        );

        throw_if(
            is_string($eventHandlers) && class_exists($eventHandlers) === false,
            InvalidArgumentException::class,
            'Class not found: '.$eventHandlers,
        );
    }
}
