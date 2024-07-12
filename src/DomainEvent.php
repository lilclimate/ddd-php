<?php

namespace App;

use DateTime;
use Ramsey\Uuid\Uuid;

abstract class DomainEvent {
    public $eventId;
    public $timestamp;

    public function __construct() {
        $this->eventId = Uuid::uuid4()->toString();
        $this->timestamp = new DateTime();
    }
}
