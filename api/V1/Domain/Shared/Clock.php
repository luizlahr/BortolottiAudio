<?php

declare(strict_types = 1);

namespace Borto\Domain\Shared;

use DateInterval;
use DateTimeImmutable;

class Clock
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    private DateTimeImmutable $date;

    public function __construct(DateTimeImmutable $date)
    {
        $this->date = $date;
    }

    public static function createFromString(string $date)
    {
        return new static(new DateTimeImmutable($date));
    }

    public static function now(): self
    {
        return new static(new DateTimeImmutable());
    }

    public function addDays(int $days): self
    {
        $date = $this->toDateTime();
        $interval = new DateInterval("P{$days}D");
        $this->date = $date->add($interval);
        return $this;
    }

    public function addDay(): self
    {
        return $this->addDays(1);
    }

    public function subDays(int $days): self
    {
        $date = $this->toDateTime();
        $interval = new DateInterval("P{$days}D");
        $this->date = $date->sub($interval);
        return $this;
    }

    public function subDay(): self
    {
        return $this->subDays(1);
    }

    public function toDateTime(): DateTimeImmutable
    {
        if (empty($this->date)) {
            $this->date = new DateTimeImmutable();
        }
        return $this->date;
    }

    public function toString(string $format = null): string
    {
        return $this->date->format($format ?? self::DATE_FORMAT);
    }
}
