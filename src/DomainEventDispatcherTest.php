<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\DomainEvent;
use App\DomainEventDispatcher;

class TestDomainEvent extends DomainEvent {
    public $str;
    public $n;

    public function __construct($str, $n) {
        parent::__construct();
        $this->str = $str;
        $this->n = $n;
    }
}

class DomainEventDispatcherTest extends TestCase {
    public function testRegisterAndDispatch() {
        $event = new TestDomainEvent('str', 0);
        $handler = $this->getMockBuilder('stdClass')
                        ->addMethods(['__invoke'])
                        ->getMock();
        $handler->expects($this->once())
                ->method('__invoke')
                ->with($event);

        DomainEventDispatcher::register(TestDomainEvent::class, [$handler, '__invoke']);
        DomainEventDispatcher::dispatch($event);
    }
}
