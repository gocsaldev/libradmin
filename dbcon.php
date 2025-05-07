<?php
    require __DIR__.'/vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Auth;
    
    $factory = (new Factory)
    ->withServiceAccount('libradmin-firebase-adminsdk-fbsvc-a3a8ee517f.json')
    ->withDatabaseUri('https://libradmin-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();
    $auth = $factory->createAuth();
    $loaners = $database->getReference('loaners')->getValue();


?>