<?php

namespace App\MainBundle\Services;

abstract class Xls
{
    const PATH = 'uploads/tmp/';
    protected $webPath;
    /** @var \PHPExcel_Worksheet */
    protected $sheet;
    protected $filepath;
    public $tmpDir;
    public $tmpFilename;

    protected function getMaxRowCount()
    {
        return 500;
    }

    public function setWebPath($webPath)
    {
        $this->webPath = $webPath;
    }

    public function createFrom($filepath)
    {
        $this->filepath = $filepath;
        $objPHPExcel = \PHPExcel_IOFactory::load($filepath);
        $objPHPExcel->setActiveSheetIndex(0);
        $aSheet = $objPHPExcel->getActiveSheet();

        $this->sheet =$aSheet;
    }

    public function toArray($from = 1, $to = null)
    {
        if (is_null($to)) {$to=$this->getHighestRow()+1;}
        $result = array();
        for ($row = $from; $row<=$to; $row++) {
            $rowData = $this->getRow($row);
            if(!$this->isRow($rowData)){continue;}
            $result[] = $rowData;
        }

        return $result;
    }

    public function getHighestRow()
    {
        return $this->sheet->getHighestRow();
    }

    public function generateTmpDir()
    {
        $this->tmpDir = $this->webPath . self::PATH;

        return $this->tmpDir;
    }

    public function generateTmpFilename()
    {
        $this->tmpFilename = substr(sha1(uniqid(time(), true)), 0, 16). '.xls';

        return $this->tmpFilename;
    }

    protected function isRow(array $row)
    {
        return isset($row[0]) && is_numeric($row[0]);
    }

    protected function getRow($row)
    {
        $result = array();
        $count = $this->getColumnCount();
        for ($column = 0; $column <= $count; $column++) {
            $value = $this->sheet->getCellByColumnAndRow($column, $row)->getValue();
            if (in_array($column, array(0,6))){$value = (int)$value;}
            $result[] = $value;
        }

        return $result;
    }

    protected function getColumnCount()
    {
        return 6;
    }
}
