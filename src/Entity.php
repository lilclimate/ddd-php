<?php

namespace App;

abstract class Entity {
    protected $_id;
    protected $props;
    public $isNew = false;

    public function __construct($props, UniqueEntityId $id = null) {
        $this->props = $props;
        $this->_id = $id ?: new UniqueEntityId();
        if (!$id) {
            $this->isNew = true;
        }
    }

    public function equals(Entity $entity = null): bool {
        if ($entity === null) return false;
        if ($this === $entity) return true;

        return $this->_id->equals($entity->_id);
    }
}
