<?php

namespace App;

use Ramsey\Uuid\Uuid;

class UniqueEntityId {
    private $value;

    public function __construct($value = null) {
        if ($value === null) {
            $this->value = Uuid::uuid4()->toString();
        } else {
            $this->value = $value;
        }
    }

    public function equals(UniqueEntityId $id = null): bool {
        if ($id === null) return false;
        return $id->toValue() === $this->value;
    }

    public function __toString(): string {
        return get_class($this) . "($this->value)";
    }

    public function toValue(): string {
        return $this->value;
    }
}
