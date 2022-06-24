<?php

namespace Authanram\FlatFile;

use InvalidArgumentException;
use Authanram\FlatFile\Contracts\FlatFileAdapterContract as AdapterContract;
use Authanram\FlatFile\Contracts\FlatFileContract;
use Authanram\FlatFile\Serializers\Serializer;
use Throwable;

final class FlatFile implements FlatFileContract
{
    private AdapterContract $adapter;

    private Serializer|string $serializer;

    private array $eventHandlers;

    /**
     * @throws Throwable
     */
    public function getAdapter(): AdapterContract
    {
        if (isset($this->adapter)) {
            return $this->adapter;
        }

        $subject = config('flatfile-model.storage_adapter');

        throw_if(
            is_subclass_of($subject, AdapterContract::class) === false,
            InvalidArgumentException::class,
            sprintf('Expected "%s" got: %s', AdapterContract::class, gettype($subject)),
        );

        $this->adapter = $subject;

        return $this->adapter;
    }

    /**
     * @throws Throwable
     */
    public function getSerializer(): Serializer|string
    {
        if (isset($this->serializer)) {
            return $this->serializer;
        }

        $subject = config('flatfile-model.serializer');

        throw_if(
            is_subclass_of($subject, Serializer::class) === false,
            InvalidArgumentException::class,
            sprintf('Expected "%s" got: %s', Serializer::class, gettype($subject)),
        );

        $this->serializer = $subject;

        return $this->serializer;
    }

    /**
     * @throws Throwable
     */
    public function getEventHandlers(): array
    {
        if (isset($this->eventHandlers)) {
            return $this->eventHandlers;
        }

        $subject = config('flatfile-model.event_handlers');

        throw_if(
            array_is_list($subject),
            InvalidArgumentException::class,
            'Expected map - associative array with string keys.',
        );

        $this->eventHandlers = collect(config('flatfile-model.event_handlers'))
            ->mapWithKeys(static function ($subject, string $key) {
                throw_if(
                    is_callable($subject) === false,
                    InvalidArgumentException::class,
                    sprintf('Expected a callable. Got: %s', gettype($subject)),
                );

                return [$key => $subject];
            })->toArray();

        return $this->eventHandlers;
    }
}
