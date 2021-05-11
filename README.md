    The class "Export" produces a csv file. It receives an array
    and returns a csv file only for downloads.
    Use: Either as class call or invoke:
    
    @author László Pálvölgyi <l.palvoelgyi@the-platform-group.com>
    
    $CSV = new CSV;
    $CSV->setData($dataArray)
    ->generateCSVFile()
    ->getCSVFile();
    
    or
    
    $CSV = new CSV;
    $CSV($dataArray);
    
    It is possible to create the first line with the original name:
    $ csv = new CSVExport (1);
    Or to define fields yourself:
    $csv = new CSVExport ();
    For this you have to change the variable "$header" under "CSVExport.php".