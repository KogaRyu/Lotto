<?php
return
[# Array of Database Settings
    'db_lottery' => [# DB Settings
        'Driver'    =>  'mysql',
        'Host'      =>  'localhost',
        'DB'        =>  'db_lottery',
        'User'      =>  'usr_devuser',
        'Password'  =>  'DevPass@von24',
        'Sitekey'   =>  '',
        'charset'   =>  'utf8mb4',
        'Query'     =>  '',
        'Options'   =>  [ # PDO Options
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => False]],
    'database_db1' => [# DB Settings
        'Driver'    =>  'mysql',
        'Host'      =>  'localhost',
        'DB'        =>  'db_lottery',
        'User'      =>  'usr_devuser',
        'Password'  =>  'DevPass@von24',
        'Sitekey'   =>  '',        
        'charset'   =>  'utf8mb4',
        'Query'     =>  '',
        'Options'   =>  [ # PDO Options
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false]],
    'database_db2' => [# DB Settings
        'Driver'    =>  'mysql',
        'Host'      =>  'localhost',
        'DB'        =>  'db_lottery',
        'User'      =>  'usr_devuser',
        'Password'  =>  'DevPass@von24',
        'Sitekey'   =>  '',
        'charset'   =>  'utf8mb4',
        'Query'     =>  '',
        'Options'   =>  [ # PDO Options
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false]]
];
?>