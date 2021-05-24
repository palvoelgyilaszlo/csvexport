<?php

    declare(strict_types = 1);

    namespace Palvoelgyi\CsvExport;

    /**
     * The class "Export" produces a csv file. It receives an array
     * and returns a csv file only for downloads.
     * Use: Either as class call or invoke:
     *
     * * @author László Pálvölgyi <l.palvoelgyi@gmail.com>
     *
     * $CSV = new CSV;
     * $CSV->setData($dataArray)
     * ->generateCSVFile()
     * ->getCSVFile();
     *
     * or
     *
     * $CSV = new CSV;
     * $CSV($dataArray);
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
         * Variable for the csv data header
         
        private array $header = [
            'Produkttyp',
            'Lagerhaltungsnummer',
            'Marke',
            'Hersteller',
            'Hersteller Barcode',
            'Barcode Typ',
            'Produktname',
            'Empfohlene Browse Nodes',
            'Modellnummer',
            'Uhrwerk-Typ',
            'Zielpublikum',
            'Ringgröße',
            'Display',
            'Metalltyp',
            'Gehäusematerial',
            'Anzahl der Stücke pro Packung / oder Quadratmeter für die Fläche',
            'URL Hauptbild',
            'Menge',
            'Ihr Preis',
        ];
        */
        /**
         * Variable for the csv data header
         *
         * private array $header = [
         * 'feed_product_type',
         * 'item_sku',
         * 'brand_name',
         * 'manufacturer',
         * 'external_product_id',
         * 'external_product_id_type',
         * 'item_name',
         * 'recommended_browse_nodes',
         * 'part_number',
         * 'watch_movement_type',
         * 'target_audience_keywords1 - target_audience_keywords5',
         * 'ring_size',
         * 'display_type',
         * 'metal_type',
         * 'material_type1 - material_type5',
         * 'unit_count',
         * 'main_image_url',
         * 'quantity',
         * 'standard_price',
         * ];
         */

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
            # First line / Header
            $header = [];

            if ( 0 === $this->arrayHeader ) {

                $header = $this->header;

            } else {

                $header = array_keys((array) $this->data[0]);
            }

            # Write Header
            $this->file->fputcsv($header,';');

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
