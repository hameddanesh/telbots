<?php

namespace Telbots\Console\Commands;


class Init
{
    public function __construct(Authenticator $authenticator)
    {
        while (true) {
            if (!$authenticator->checkRootExists()) {
                echo "!! setup incomplete - you need a root account to continue, please set up a root password.\n\n";
                do {
                    $password = readline('password: ');
                    $rePassword = readline('re-enter password: ');

                    if ($password != $rePassword) echo "passwords do not match! try again\n\n";
                    else if (strlen($password) < 6) echo "passwords must be longer than 6 characters! try again\n\n";
                } while (($password != $rePassword) || strlen($password) < 6);

                $authenticator->createRoot($password);
            } else return true;
        }
    }
}
