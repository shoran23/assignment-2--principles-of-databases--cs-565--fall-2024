<?php

class Dates {
    public $announced;
    public $released;
    public $latest;

    function __construct($announced, $released, $latest) {
        $this->announced = $announced;
        $this->released = $released;
        $this->latest = $latest;
    }
}
