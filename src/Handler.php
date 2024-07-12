<?php

namespace App;

abstract class Handler {
    public function __construct() {
        $this->setup();
    }

    abstract protected function setup(): void;
}
