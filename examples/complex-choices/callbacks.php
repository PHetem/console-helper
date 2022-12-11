<?php

use ConsoleTools\{Callback, Console, Menu};

function wants() {
    Console::clear();
    Console::printColor('Ok. Here we go.', 'green');
    Console::awaitKeypress();
}

function doesNotWant() {
    Console::clear();
    Console::printColor('Ok. Closing up the module.', 'green');
    Console::awaitKeypress();
    exit;
}

function selectedYes() {
    Console::clear();
    Console::printColor('You have selected Yes', 'green');
}

function selectedNo() {
    Console::clear();
    Console::printColor('You have selected no', 'red');
}

function optionSelected($SelectedOption) {
    Console::clear();
    Console::printColor('You have selected the ' . $SelectedOption . ' option', 'cyan');
}

