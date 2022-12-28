<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Webpage Title -->
     <title>copy directory</title>

     <link rel="stylesheet" href="/css/bootstrap.css">
</head>

<?php

if(isset($_POST['sourcePath'])&&isset($_POST["destinationPath"])){
    $sourcePath = $_POST['sourcePath'];
    $destinationPath = $_POST["destinationPath"];
    $excludedPath = $_POST["excludedPath"];

    echo 'excludedPath : ' . $excludedPath . '<br>';

    $result = full_copy($sourcePath, $destinationPath, $excludedPath);

    

    if(($result != null)&&($result != false)){
        echo "<H3>Copy directories completed!</H3> <br>" . $result; //output when done
    }
    else{
        echo "<h3>copy failed: " . $result;
    }

}







function full_copy( $source, $target, $excludedPath ) {
    $bRes = false;
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        echo ' source: ' . $source . '<br>';
        if($source != $excludedPath){
            while ( FALSE !== ( $entry = $d->read() ) ) {
                if ( $entry == '.' || $entry == '..' ) {
                    continue;
                }

                $EntryForm1 = $source . '\\' . $entry;
                $Entry = $source . '/' . $entry;

                if (
                    ($Entry != $excludedPath) && 
                    ($EntryForm1 != $excludedPath) && 
                    ($Entry . '/' != $excludedPath)&&
                    ($EntryForm1 . '/' != $excludedPath)
                    ) {
                        if ( is_dir( $Entry ) ) {
                            $bRes = full_copy( $Entry, $target . '/' . $entry, $excludedPath );
                            continue;
                        }
                    echo '<br><span>copy file or directory' . $Entry . '</span>';
                        $bRes = copy( $Entry, $target . '/' . $entry );
                }
                
            }
        }
       

        $d->close();
    }else {
        $bRes = copy( $source, $target );
    }

    return $bRes;
}




function recurseCopy(
    string $sourceDirectory,
    string $destinationDirectory,
    string $childFolder = ''
): void {
    $directory = opendir($sourceDirectory);

    if (is_dir($destinationDirectory) === false) {
        mkdir($destinationDirectory);
    }

    if ($childFolder !== '') {
        if (is_dir("$destinationDirectory/$childFolder") === false) {
            mkdir("$destinationDirectory/$childFolder");
        }

        while (($file = readdir($directory)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            if (is_dir("$sourceDirectory/$file") === true) {
                recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
            } else {
                copy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
            }
        }

        closedir($directory);

        return;
    }

    while (($file = readdir($directory)) !== false) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        if (is_dir("$sourceDirectory/$file") === true) {
            recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$file");
        }
        else {
            copy("$sourceDirectory/$file", "$destinationDirectory/$file");
        }
    }

    closedir($directory);
}