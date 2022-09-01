<?php

include_once dirname(__FILE__, 2) . '/config/config.php';
include_once dirname(__FILE__) . '/callbacks.php';

use Utils\ConsoleTools\{Callback, Console, Menu};

main();

function main() {
    wantsTheTutorial();
    yesOrNo();
    multipleChoices();
    conclusion();
}

function wantsTheTutorial() {
    Console::clear();

    $MenuTitle = Console::printColor('Hello. Would you like to see some of the available options this console has to offer?', 'purple', false);

    $Menu = new Menu($MenuTitle);
    $Menu->addBoolOption(new Callback('wants'), new Callback('doesNotWant'));

    Console::getInput($Menu);
}

function yesOrNo() {
    Console::clear();

    $MenuTitle = Console::printColor('This is a yes or no question', 'purple', false);

    $Menu = new Menu($MenuTitle);
    $Menu->addBoolOption(new Callback('selectedYes'), new Callback('selectedNo'));

    Console::getInput($Menu);
    Console::awaitKeypress();
}


function multipleChoices() {
    Console::clear();

    $MenuTitle = Console::printColor('Now this is a', 'purple', false, false);
    $MenuTitle .= Console::printColor(' multiple choice ', 'red', false, false);
    $MenuTitle .= Console::printColor('question', 'purple', false, false);

    $Menu = new Menu($MenuTitle);
    $Menu->addOption('1', 'First Option', new Callback('optionSelected', ['first']));
    $Menu->addOption('2', 'Second Option', new Callback('optionSelected', ['second']));
    $Menu->addOption('3', 'Third Option', new Callback('optionSelected', ['third']));
    $Menu->addOption('4', 'Fourth Option', new Callback('optionSelected', ['fourth']));
    $Menu->addCancel(new Callback('main'));

    Console::getInput($Menu);
    Console::awaitKeypress();
}

function conclusion() {
    Console::clear();

    Console::printColor('In this simplified script, we\'ve seen examples of:', 'purple');
    Console::printColor(' - A simple way to organize scripts, so the flow can be reused whenever necessary', 'cyan');
    Console::printColor(' - How to work with simple boolean questions', 'cyan');
    Console::printColor(' - How to work with multiple choice questions', 'cyan');
    Console::printColor(' - How to create a multi-colored title for emphasis', 'cyan');
    Console::printColor(' - How to use a callback with parameters', 'cyan');
    Console::printColor(' - How to add a cancel option to your multiple choice question', 'cyan');

    Console::awaitKeypress('Press any key to exit');
}


