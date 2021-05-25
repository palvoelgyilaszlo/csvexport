      
    @author László Pálvölgyi <l.palvoelgyi@gmail.com> 
    
    The class "Export" produces a csv file. It receives an array
    and returns a csv file only for downloads.
    Use: Either as class call or invoke:
    
    use Palvoelgyi\CsvExport\CSVExport;

    $dataArray = [ 
        [ 'Header 1', 'Header 2', 'Header 3' ],
        [ 'TEST 4',   'TEST 5',   'TEST 6'   ],
        [ 'TEST 7',   'TEST 8',   'TEST 9'   ],
        [ 'TEST 10',  'TEST 11',  'TEST 12'  ],
    ];

    $CSV = new CSVExport;
    $CSV($dataArray);

    or

    $CSV = new CSVExport;
    $CSV->setData($dataArray)
    ->generateCSVFile()
    ->getCSVFile();

    It is possible to create the first line with the original name:
    $csv = new CSVExport (1);

    Or to define fields yourself:
    $csv = new CSVExport ();
    For this you have to change the variable "$header" under "CSVExport.php".