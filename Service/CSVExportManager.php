<?php

namespace BabyBundle\Service;
use Symfony\Component\HttpFoundation\Response;

class CSVExportManager {

  public function __construct() {
  }

  public function exportCSV($data, $response_type=NULL){
    $handle = fopen('php://memory', 'r+');

    foreach($data as $row){
      fputcsv($handle, $row,';');
    }

    rewind($handle);
    $content = stream_get_contents($handle);
    fclose($handle);

    if(empty($response_type)){
      return $content;
    }
    else{
    return new Response($content, 200, array(
      'Content-Type' => 'application/force-download',
      'Content-Disposition' => 'attachment; filename="export.csv"'
    ));
    }
  }

  public function saveCSV($data, $path, $filename){
    $export = $this->exportCSV($data, NULL);
    $csv_file = fopen($path.'/'.$filename, 'w');
    fwrite($csv_file, $export);
    fclose($csv_file);

  }
}
