<?php

namespace App;

class DomainEventDispatcher {
    private static $handlersMap = [];

    public static function register($eventClassName, $handler): void {
        if (!isset(self::$handlersMap[$eventClassName])) {
            self::$handlersMap[$eventClassName] = [];
        }
        self::$handlersMap[$eventClassName][] = $handler;
    }

    public static function dispatchAggregateEvents(AggregateRoot $aggregate): void {
        foreach ($aggregate->getDomainEvents() as $domainEvent) {
            self::dispatch($domainEvent);
        }
        $aggregate->clearEvents();
    }

    public static function dispatch(DomainEvent $domainEvent): void {
        $eventClassName = get_class($domainEvent);
        if (isset(self::$handlersMap[$eventClassName])) {
            foreach (self::$handlersMap[$eventClassName] as $handler) {
                $handler($domainEvent);
            }
        }
    }
}
