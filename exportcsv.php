<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rick
 * Date: 6/24/13
 * Time: 9:45 PM
 */
require_once 'dbConnection.php';

class exportCsv extends dbConnection
{

    public $table;
    public $csvFolder = 'csv';
    public $filename  ;
    public function __construct()
    {
        $this->table = 'storedetails';
        $this->filename = "user_export_" . time() . ".csv";
        parent::__construct();
    }
    public function exportAsCsv()
    {
        // Remember that the folder where you want to write the file has to be writable

        // Actually create the file
        // The w+ parameter will wipe out and overwrite any existing file with the same name
         $csvFile = $this->csvFolder .'/' .$this->filename;
         $handle = fopen($csvFile, 'w+');

        $results = $this->selectAll($this->table);
        // Write all the user records to the spreadsheet
        $text = "No,Storenumber,Storeaddress,organization,Pickdate,Addeddate\n";
        foreach ($results as $row) {
            //$text .= $row['firstname'].', '.$row['lastname'].', '.$row['email']."\n";
            $text .= '"'.$row['id'].'","'.$row['storename'].'","'.$row['storeaddress'].'","'.$row['organization'].'","'.$row['pickdate'].'","'.$row['addeddate'].'"'."\n";
        }
        fwrite($handle, $text);
        unset($text);
        // Finish writing the file
        fclose($handle);

        $this->downLoadCsv($csvFile);
    }

    public function downLoadCsv($filepath)
    {
        if(!file_exists($filepath))
            return;

        header("Pragma: ");
        header("Content-Type: application/force-download");
        // header("Pragma: no-cache");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: text/plain charset=utf-8");
        header("Content-Disposition: attachment; filename=" . $this->filename . ";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . filesize($filepath));

        $handle = fopen($filepath, 'rb');
        while (!feof($handle)) {
            echo fread($handle, 4096);
        }
    }

}