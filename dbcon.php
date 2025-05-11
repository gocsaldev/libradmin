<?php
    require __DIR__.'/vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Auth;
    
    $factory = (new Factory)
    ->withServiceAccount('final-libradmin-firebase-adminsdk-fbsvc-baf9883481.json')
    ->withDatabaseUri('https://final-libradmin-default-rtdb.europe-west1.firebasedatabase.app');

    $database = $factory->createDatabase();
    $auth = $factory->createAuth();
    $loaners = $database->getReference('loaners')->getValue();


?>