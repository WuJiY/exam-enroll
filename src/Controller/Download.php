<?php
namespace Kezhi\Controller;

class Download extends Controller{
    public function index($filename){
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header('Content-Disposition: attachment;filename="Student.xlsx"');
        header('Cache-Control: max-age=0');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $file = fopen(__DOWNLOAD__ . $filename, "r");
        echo fread($file, filesize(__DOWNLOAD__ . $filename));
        fclose($file);
        exit;
    }
}
