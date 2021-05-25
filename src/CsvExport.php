<?php

    declare(strict_types = 1);

    namespace Palvoelgyi\CsvExport;

    /**
     * @author László Pálvölgyi <l.palvoelgyi@gmail.com>
     * The class "Export" produces a csv file. It receives an array
     * and returns a csv file only for downloads.
     * Use: Either as class call or invoke:
     *     
     * $CSV = new CsvExport;
     * $CSV($dataArray);
     *
     * or
     *
     * $CSV = new CsvExport;
     * $CSV->setData($dataArray)
     * ->generateCSVFile()
     * ->getCSVFile();
     *
     * It is possible to create the first line with the original name:
     * $ csv = new CSVExport (1);
     * Or to define fields yourself:
     * $ csv = new CSVExport ();
     * For this you have to change the variable "$header" under "CSVExport.php".
     *
     * Visibility of the class
     * @access public
     */
    class CSVExport
    {   
        /**
        * @var string[]
        */
        private array $header = [];

        /**
        * Variable for the csv data
        *
        * @var string[]
        */

        private $data;

        /**
         * Variable is a SplTempFileObject object
         *
         * @var \SplTempFileObject
         */
        private \SplTempFileObject $file;

        /**
         * Variable for the file name
         */
        private string $filename = 'export.csv';

        /**
         * Variable for the headline
         */
        private int $arrayHeader = 0;

        public function __construct( int $arrayHeader = 0 )
        {
            $this->arrayHeader = $arrayHeader;
            $this->file        = new \SplTempFileObject();
        }

        /**
         * @param array<int, string> $data
         */
        public function __invoke( array $data ) : void
        {
            $this->dataEmpty($data);

            $this->data = $data;

            $this->generateCSVFile()
                 ->getCSVFile();
        }

        /**
         * @param array<int, string> $data
         */
        public function setData( array $data ) : CSVExport
        {
            $this->dataEmpty($data);

            $this->data = $data;

            return $this;
        }

        public function generateCSVFile(): CSVExport
        {

            foreach ($this->data as $row) {

                $this->file->fputcsv((array) $row,';');
            }

            return $this;
        }

        public function getCSVFile() : void
        {
            $this->file->rewind();

            header('Content-Type: text/csv');

            header('Content-Disposition: attachment; filename="' . $this->filename . '";');

            $this->file->fpassthru();
        }

        /**
         * Checks if the data are an array and if they are not empty
         *
         * @param array<int, string> $data
         */
        private function dataEmpty(array $data) : void
        {

            if ( $data == [] ) { exit; }
        }
    }
