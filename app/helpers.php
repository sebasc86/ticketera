<?php
function readEmailinEnv($data = array())
{
    
    $pattern = '/([^\=]*)\=[^\n]*/';

    $envFile = base_path() . '/.env';
    $lines = file($envFile);
    $newLines = [];

    foreach ($lines as $line) {
       $s =  preg_match($pattern, $line, $matches);

        if (!count($matches)) {
            $newLines[] = $line;
            
            continue;
        }

        if (!key_exists(trim($matches[1]), $data)) {
            $newLines[] = $line;
            continue;
        }

        $line = trim($matches[1]) . "={$data[trim($matches[1])]}\n";
        $newLines[] = $line;
        
    }
    $explode =  explode("=", $newLines[28]);
    return $explode[1];
    
}

function readPassEmailinEnv($data = array())
{
    
    $pattern = '/([^\=]*)\=[^\n]*/';

    $envFile = base_path() . '/.env';
    $lines = file($envFile);
    $newLines = [];

    foreach ($lines as $line) {
       $s =  preg_match($pattern, $line, $matches);

        if (!count($matches)) {
            $newLines[] = $line;
            
            continue;
        }

        if (!key_exists(trim($matches[1]), $data)) {
            $newLines[] = $line;
            continue;
        }

        $line = trim($matches[1]) . "={$data[trim($matches[1])]}\n";
        $newLines[] = $line;
        
    }
    // $newContent = implode('', $newLines);
    // file_put_contents($envFile, $newContent)
    
    $explode =  explode("=", $newLines[29]);
    return $explode[1];

    // $newContent = implode('', $newLines);
    // file_put_contents($envFile, $newContent)
    
}

function saveEnvEmail($array, $data = array())
{
    
    $pattern = '/([^\=]*)\=[^\n]*/';

    $envFile = base_path() . '/.env';
    $lines = file($envFile);
    $newLines = [];

    foreach ($lines as $line) {
       $s =  preg_match($pattern, $line, $matches);

        if (!count($matches)) {
            $newLines[] = $line;
            
            continue;
        }

        if (!key_exists(trim($matches[1]), $data)) {
            $newLines[] = $line;
            continue;
        }

        $line = trim($matches[1]) . "={$data[trim($matches[1])]}\n";
        $newLines[] = $line;
        
    }
    // $newContent = implode('', $newLines);
    // file_put_contents($envFile, $newContent)
    
    $email =  explode("=", $newLines[28]);
    $email[1] = $array[0];
    $implodeEmail = implode('=',$email);
    $newLines[28] = $implodeEmail . "\n";

    $pass =  explode("=", $newLines[29]);
    $pass[1] = $array[1];
    $implodePass = implode('=',$pass);
    $newLines[29] = $implodePass ."\n";
        
    

    $newContent = implode('', $newLines);
    
    file_put_contents($envFile, $newContent);

    return 1;
     
}