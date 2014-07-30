<?php

namespace ITDoors\CommonBundle\MyClass;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * FileCommandor
 *
 * This class has to create conditions
 */
class FileCommandor
{
    public function createArchive($newArchivePath, $files) {
        $zip_name = $newArchivePath; //the real path of your final zip file on your system
        $zip = new ZipArchive;
        $zip->open($zip_name, ZIPARCHIVE::CREATE);
        foreach($files as $file)
        {
            $zip->addFile($file);
        }
        $zip->close();
    }

}