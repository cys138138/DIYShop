<?php
namespace umeworld\lib\PHPExcel;

use Yii;
use PHPExcel_IOFactory;
use common\model\Student;
use common\model\Teacher;
use umeworld\lib\Query;
use common\model\School;
use yii\helpers\ArrayHelper;

class Excel extends \yii\base\Object{

	public function __construct(){
		require_once Yii::getAlias('@umeworld/lib/PHPExcel/') . 'PHPExcel.php';
		require_once Yii::getAlias('@umeworld/lib/PHPExcel/') . 'PHPExcel/IOFactory.php';
		require_once Yii::getAlias('@umeworld/lib/PHPExcel/') . 'PHPExcel/Reader/Excel5.php';
        parent::__construct();
    }
	
	/*
	 * 读excel表数据放入数组中
	 * @author jay
	 * @param $inputPath excel文件路径
	 * @param $sheetIndex 读取excel文件表格下标
	 */
	public function getSheetDataInArray($inputPath = '', $sheetIndex = 0){
		if(!$inputPath){
			return [];
		}
		$aPathInfo = pathinfo($inputPath);
		if($aPathInfo['extension'] =='xlsx'){
			$className = 'excel2007';
		}else{
			$className = 'Excel5';
		}
		$objReader = PHPExcel_IOFactory::createReader($className);$objReader->setReadDataOnly(false);
		$objPHPExcel = $objReader->load($inputPath);
		$sheet = $objPHPExcel->getSheet($sheetIndex);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		$aReturn = [];$objPHPExcel->getActiveSheet()->setCellValue('A30', 'PHPExcel');
		for($j = 1; $j <= $highestRow; $j++){
			$index = 0;
			$aRow = [];
			for($k = 'A'; $k <= $highestColumn; $k++){
				$aRow[$index++] = mb_convert_encoding($objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue(), 'utf8', 'auto');
			}
			array_push($aReturn, $aRow);
		}
		return $aReturn;
	}
	
	/*
	 * 将数组写到excel表中
	 * @author jay
	 * @param $outputPath excel文件路径
	 * @param $sheetIndex 读取excel文件表格下标
	 */
	public function setSheetDataFromArray($outputPath = '', $aData, $sheetIndex = 0, $startCell = 'A1'){
		if(!$outputPath){
			return false;
		}
		$aPathInfo = pathinfo($outputPath);
		$className = 'Excel5';
		if($aPathInfo['extension'] =='xlsx'){
			$className = 'excel2007';
		}
		$objPHPExcel = PHPExcel_IOFactory::createPHPExcelObject();	
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $className);
		//$objPHPExcel->getSheet($sheetIndex)->fromArray($aData, NULL, $startCell);
		$row = $startCell[1];
		foreach($aData as $value){
			$col = $startCell[0];
			foreach($value as $v){
				$objPHPExcel->getSheet($sheetIndex)->setCellValueExplicit("$col$row", $v, 's');
				$col++;
			}
			$row++;
		}
		$objWriter->save($outputPath);
		
		return true;
	}
	
	/*
	 * 将Html table写到excel表中
	 * @author jay
	 * @param $outputPath excel文件路径
	 * @param $sheetIndex 读取excel文件表格下标
	 */
	public function setSheetDataFromHtmlTable($outputPath, $htmlTable){
		if(!$outputPath){
			return false;
		}
		$aPathInfo = pathinfo($outputPath);
		$excelWriterType = 'Excel5';
		if($aPathInfo['extension'] =='xlsx'){
			$excelWriterType = 'Excel2007';
		}
		$oHtmlPHPExcelObject = PHPExcel_IOFactory::createHtmlPHPExcelObject();
		$oHtmlPHPExcelObject->setExcelObject(PHPExcel_IOFactory::createPHPExcelObject());
		$oHtmlPHPExcelObject->setHtmlStringOrFile($htmlTable);
		$oHtmlPHPExcelObject->process()->save($outputPath, $excelWriterType);
		
		return true;
	}
}
?>