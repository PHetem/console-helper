<?php

namespace Utils\ConsoleTools;

class Menu {
    public $Title;
    public $Options = [];
    private $Validation;

    public function __construct(string $Title = null, array $Options = [], string $Validation = null) {
        $this->Title = $Title ?? 'Choose an option';
        $this->Validation = $Validation ?? null;

        foreach ($Options as $Option) {
            $this->Options[$Option->Identifier] = $Option;
        }
    }

    public function getValidation(): ?string {
        return $this->Validation;
    }

    /**
     * Add a cancel option to Menu
     *
     * @param Callback $Callback Callback object for option
     * @param string $Text Option text [Default: 'Cancel']
     * @param string $Identifier Option number [Default: '99']
     * @param bool $Color If true, the option will be shown in red [Default: true]
     *
     * @return string
    */
    public function addCancel(Callback $Callback, string $Text = 'Cancel', string $Identifier = '99', bool $Color = true) {

        if ($Color)
            $Text = Console::printColor($Text, 'red', false, false);

        $this->addOption($Identifier, $Text, $Callback);
    }

    /**
     * Add a custom option to Menu
     *
     * @param string $Identifier Option number
     * @param string $Text Option text
     * @param Callback $Callback Callback object for option [Default: null]
     *
     * @return string
    */
    public function addOption(string $Identifier, string $Text, Callback $Callback = null) {
        $this->Options[$Identifier] = new Option($Identifier, $Text, $Callback);
    }

    /**
     * Add a boolean option to Menu
     *
     * @param Callback $FirstCallback Callback object for first option
     * @param Callback $SecondCallback Callback object for second option
     * @param string $FirstText Option text [Default: 'Yes']
     * @param string $SecondText Option text [Default: 'No']
     *
     * @return string
    */
    public function addBoolOption(Callback $FirstCallback, Callback $SecondCallback, string $FirstText = 'Yes', string $SecondText = 'No') {
        $this->addOption('1', $FirstText, $FirstCallback);
        $this->addOption('2', $SecondText, $SecondCallback);
    }
}