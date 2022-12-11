<?php

namespace ConsoleTools;

class Console {

    private static $ColorSufix = "\e[0m";
    private static $ForegroundColors = ['red' => "0;31", 'green' => "0;32",
                                        'purple' => "0;35", 'cyan' => "0;36"];

    /**
     * Return bash code for given color
     *
     * @param string $Color Color name
     *
     * @return string
    */
    private static function getColorPrefix(string $Color) {
        if (!array_key_exists($Color, self::$ForegroundColors)) {
            return false;
        } else {
            return "\e[" . self::$ForegroundColors[$Color] . "m";
        }
    }

    /**
     * Add bash color code around given string
     *
     * @param string $Text Text to be colored
     * @param string $Color Color name
     * @param bool $Print If true, echoes result [Default: true]
     * @param bool $Newline If true, appends EOL to result [Default: true]
     *
     * @return string
    */
    public static function printColor(string $Text, string $Color, bool $Print = true, bool $NewLine = true): string {

        $ColorPrefix = self::getColorPrefix($Color);
        $Result = $Text;

        if ($Color)
            $Result = $ColorPrefix . $Text . self::$ColorSufix;

        if ($NewLine)
            $Result .= PHP_EOL;

        if ($Print)
            echo $Result;

        return $Result;
    }

    /**
     * Print menu options, then read and validate response
     *
     * @param Menu $Menu
     *
     * @return mixed
    */
    public static function getInput(Menu $Menu) {
        self::showOptions($Menu);
        $Response = self::checkInput($Menu);

        if (isset($Menu->Options[$Response]->Callback))
            return self::handleResponse($Menu, $Response);

        return $Response;
    }

    /**
     * Print menu options
     *
     * @param Menu $Menu
     *
     * @return null
    */
    public static function showOptions(Menu $Menu) {

        echo $Menu->Title ?? 'Choose an option';
        echo PHP_EOL;

        if (isset($Menu->Options)) {
            foreach ($Menu->Options as $Option) {
                echo $Option->Identifier . ') ' . $Option->Text . PHP_EOL;
            }
        }

        echo PHP_EOL;
    }

    /**
     * Read and validate responde
     *
     * @param Menu $Menu
     *
     * @return string
    */
    public static function checkInput(Menu $Menu): string {

        do {
            $Action = readline();
            $Validation = $Menu->getValidation();
            echo PHP_EOL;

            if (!empty($Menu->Options)) {
                if (!isset($Menu->Options[$Action])) {
                    system('clear');
                    Console::printColor('Invalid Option', 'red');
                    echo PHP_EOL;
                    $Action = false;
                    self::showOptions($Menu);
                }
            } elseif (isset($Validation) && !($Validation($Action))) {

                system('clear');
                Console::printColor('Wrong input type', 'red');
                echo PHP_EOL;

                $Action = false;
                self::showOptions($Menu);
            }
        } while ($Action == false);

        return $Action;
    }

    /**
     * Print message and wait for user keypress before continuing
     *
     * @param string $Text Text to be printed [Default: 'Press enter to continue...']
     *
     * @return null
    */
    public static function awaitKeypress($Text = 'Press enter to continue...') {
        readline($Text);
    }

    /**
     * Clear terminal screen
     *
     * @return null
    */
    public static function clear() {
        system('clear');
    }

    /**
     * Run callback based on user input
     *
     * @return null
    */
    public static function handleResponse(Menu $Menu, string $Response) {
        return $Menu->Options[$Response]->Callback->run();
    }
}