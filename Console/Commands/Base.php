<?php

namespace Telbots\Console\Commands;

class Base
{

    public function __construct()
    {
        $this->clear();
        echo "TelBots Console\n\n";
    }

    public function getInput()
    {
        $command = readline($_SESSION['username'] . "@TelBots# ");
        readline_add_history($command);
        return explode(' ', $command);
    }

    public function welcome()
    {
        echo "\n\e[0;32m"
            . " ************************************"
            . "\n|                                    |"
            . "\n|     Welcome to TelBots Console     |"
            . "\n|                                    |"
            . "\n ************************************ "
            . "\e[0m\n\n";
    }

    public function clear()
    {
        echo chr(27) . chr(91) . 'H' . chr(27) . chr(91) . 'J';
    }

    public function help()
    {
        echo "\n\e[0;34m"
            . " ____________________________________ "
            . "\n|                                    |"
            . "\n|                                    |"
            . "\n|      \e[0;32mConsole Commands Manual!\e[0;34m      |"
            . "\n|                                    |"
            . "\n|____________________________________|"
            . "\n|                                    |"
            . "\n|  \e[0mclear: clear console screen.\e[0;34m      |"
            . "\n|____________________________________|"
            . "\n|                                    |"
            . "\n|  \e[0mclear-h: clear console history.\e[0;34m   |"
            . "\n|____________________________________|"
            . "\n|                                    |"
            . "\n|  \e[0mexit: exit the console.\e[0;34m           |"
            . "\n|____________________________________|"
            . "\n|                                    |"
            . "\n|  \e[0mtbc: re-open TelBot Console.\e[0;34m      |"
            . "\n|____________________________________|"
            . "\n|                                    |"
            . "\n|  \e[0mcreate: create a new controller,\e[0;34m  |"
            . "\n|          \e[0mmodel or engin\e[0;34m            |"
            . "\n|____________________________________|"
            . "\e[0m\n\n";
    }

    public function clearHistory()
    {
        readline_clear_history();
    }
}
