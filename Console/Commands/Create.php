<?php

namespace Telbots\Console\Commands;

class Create
{
    public function __construct($input)
    {
        if (isset($input[1])) {
            if ($input[1] == 'controller' || $input[1] == 'model' || $input[1] == 'engine') {
                $className = null;
                if (!isset($input[2])) {
                    echo "what should we call it: ";
                    $className = readline();
                } else $className = $input[2];

                call_user_func_array(array($this, $input[1]), [$className]);
            } else echo "\ncreate what?\n\n";
        } else echo "\ncreate what?\n\n";
    }

    public function controller(string $name)
    {
        $name = ucfirst($name);
        file_put_contents(
            dirname(__FILE__, 3) . '//Controllers//' . $name . '.php',
            "<?php\n"
                . "\n"
                . "namespace telbots\Controllers;\n"
                . "\n"
                . "use Telbots\Core\Bot;\n"
                . "use Telbots\Core\Controller;\n"
                . "\n"
                . "class $name extends Controller\n"
                . "{\n"
                . "    public function __construct(Bot \$bot)\n"
                . "    {\n"
                . "    }\n"
                . "}\n"
        );
        echo "controller " . $name . " created.\n\n";
    }

    public function model(string $name)
    {
        $name = ucfirst($name);
        file_put_contents(
            dirname(__FILE__, 3) . '//Models//' . $name . '.php',
            "<?php\n"
                . "\n"
                . "namespace TelBots\Models;\n"
                . "\n"
                . "use Telbots\Core\Model;\n"
                . "\n"
                . "class UserModel extends Model\n"
                . "{\n"
                . "    \n"
                . "}\n"
        );
        echo "model " . $name . " created.\n\n";
    }

    public function engine(string $name)
    {
        file_put_contents(
            dirname(__FILE__, 3) . '//Engines//' . $name . '.php',
            "<?php\n"
                . "\n"
                . "use Telbots\Core\Bot;\n"
                . "\n"
                . "require_once '../vendor/autoload.php';\n"
                . "require_once '../config.php';\n"
                . "\n"
                . "\$bot = new Bot();\n"
                . "//\$bot->route('route_key', 'controller_name');\n"
        );
        echo "engin " . $name . " created.\n\n";
    }
}
