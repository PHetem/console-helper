<?php

namespace Utils\ConsoleTools;

class Callback {
    public $Method;
    public $Parameters;

    public function __construct($Method, $Parameters = []) {
        $this->Method = $Method;
        $this->Parameters = $Parameters;
    }

    /**
     * Run object method
     *
     * @return string
    */
    public function run() {
        $Method = $this->Method;
        return $Method(...$this->Parameters);
    }
}