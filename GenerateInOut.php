<?php

/**
 * Class GenerateInOut
 */
Class GenerateInOut{

    /**
     * Folder files .in
     */
    const PATH_IN   = 'In/';

    /**
     * Folder save files .out
     */
    const PATH_OUT  = 'Out/';



    public function __construct(){}

    /**
     * Convert file in to array
     * @param $strNameFile
     * @return array
     */
    static function getFileInToArray($strNameFile, $arrStructure = NULL){
        if(file_exists(self::PATH_IN . $strNameFile)){
            $arrFile = file(self::PATH_IN . $strNameFile);
            if(count($arrFile) > 0){
                if($arrStructure != NULL){
                    $arrFile = self::changeStructureArrayIn($arrFile, $arrStructure);
                }
                return $arrFile;
            }
        }
        return array();
    }

    /**
     * @param $arrData
     * @param array $arrStructure 'first' => 1,'data'  => 3,
     * @return array
     */
    static function changeStructureArrayIn($arrData, $arrStructure = NULL){
        if($arrStructure == NULL){
            $arrStructure = array(
                'first' => 1,
                'data'  => 3,
            );
        }
        $arrayResult = array();

        if(array_key_exists('first', $arrStructure)){
            for($i = 0; $i < $arrStructure['first']; $i++){
                $arrKeys = array_keys($arrData);
                $arrayResult['first'][] =  $arrData[$arrKeys[$i]];
                $arrData = array_slice($arrData, 1);
            }
        }

        if(array_key_exists('data', $arrStructure)){
            $arrayResult['data'] = array_chunk($arrData, $arrStructure['data']);
        }else{
            $arrayResult['data'] = $arrData;
        }

        return $arrayResult;
    }

    /**
     * @param String $strText
     * @param string $strNameFileOut
     * @return bool|int
     */
    static function setStringOutFile($strText, $strNameFileOut = 'output_practice.out'){
        if(file_put_contents(self::PATH_OUT . $strNameFileOut, $strText, FILE_APPEND | LOCK_EX) === FALSE){
            return false;
        }
        return realpath(self::PATH_OUT . $strNameFileOut);
    }
}
