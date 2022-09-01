<?php

include_once dirname(__FILE__, 2) . '/config/config.php';

use Utils\ConsoleTools\Console;

// Printing a simple string
Console::printColor('Hi there', 'cyan');

// Saving multiple results in a single string to print later
$Text = Console::printColor('Success', 'green', false);
$Text .= Console::printColor('Failure', 'red', false);

// Print simple text before the saved string
Console::printColor('The test has been a ', 'purple');

// Print saved string
echo($Text);