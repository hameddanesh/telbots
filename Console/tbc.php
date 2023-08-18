<?php
session_start();

use Telbots\Console\Commands\Base;
use Telbots\Console\Commands\Create;
use Telbots\Console\Commands\Init;
use Telbots\Core\Constant;
use Telbots\Core\Model;
use Telbots\Console\Commands\Authenticator;
use Telbots\Console\Migrations\Mig000_users;

require_once(dirname(dirname(__FILE__)) . '/vendor/autoload.php');
require_once(dirname(dirname(__FILE__)) . '/config.php');

$base = new Base();

new Constant();
$model = new Model();
if (!$model->connect($database)) exit;

$_SESSION['valid_user'] = false;

new Mig000_users($database, $model);
$authenticator = new Authenticator($database, $model);

if (new Init($authenticator))
    while (true) {

        if ($_SESSION['valid_user']) {
            $base->welcome();
            $input = $base->getInput();

            switch ($input[0]) {
                case 'exit':
                    exit;
                    break;
                case 'clear':
                    $base->clear();
                    break;
                case 'clear-h':
                    $base->clearHistory();
                    break;
                case 'tbc':
                    $base->welcome();
                    break;
                case 'create':
                    new Create($input);
                    break;
                case 'help':
                    $base->help();
                    break;
                default:
                    echo "\n\e[0;31minvalid command !!\ntype help to see list of commands\n\n\e[0m";
                    break;
            }
        } else {
            $username = readline("please enter your username: ");
            $password = readline("password: ");
            $authenticator->login($username, $password);
        }
    }
