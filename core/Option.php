<?php

namespace Utils\ConsoleTools;

class Option {
    public $Identifier;
    public $Text;
    public $Callback;

    public function __construct($Identifier, $Text, $Callback = null) {
        $this->Identifier = $Identifier;
        $this->Text = $Text;
        $this->Callback = $Callback;
    }
}