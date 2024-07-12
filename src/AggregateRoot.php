<?php

namespace App;

abstract class AggregateRoot extends Entity {
    private $domainEvents = [];

    public function getId(): UniqueEntityId {
        return $this->_id;
    }

    public function getDomainEvents(): array {
        return $this->domainEvents;
    }

    protected function addDomainEvent(DomainEvent $domainEvent): void {
        $this->domainEvents[] = $domainEvent;
        $this->logDomainEventAdded($domainEvent);
    }

    public function clearEvents(): void {
        $this->domainEvents = [];
    }

    private function logDomainEventAdded(DomainEvent $domainEvent): void {
        $thisClass = get_class($this);
        $domainEventClass = get_class($domainEvent);
        echo "[Domain Event Created]: $thisClass => $domainEventClass\n";
    }
}
