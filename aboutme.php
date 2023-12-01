<?php
ob_start();
use PhpOffice\PhpSpreadsheet\IOFactory;

$folder = "";
$title = "درباره سامانه سجاد";
$group = "55";
include $folder . 'session.php';
require $folder . 'header.php';
?>
<div id = "about">
    <table>
        <tr>
            <td style="padding-left: 1em">
                <h3>درباره سامانه جامع آماری دیوان عدالت اداری</h3><br>
                <p>سامانه جامع آماری دیوان عدالت اداری 'سجاد' توسط کارشناسان فنی و آماری اداره کل برنامه ریزی و بودجه با
                    هدف ارتقای روند گزارش گیری آماری، افزایش دقت در محاسبه بهره وری و همچنین دسترسی سریع و راحت تر
                    مدیران به آمار و اطلاعات جهت تصمیم گیری بهتر طراحی گردیده است.</p>
            </td>
            <td><img src="img/106.jpg" width="300px"></td>
        </tr>
    </table>
<?php

// --------------------------------------------------------------------- Restore AAG tables
/*for($i=1; $i<=9; $i++){
  for($j=1; $j<=20; $j++){
     $y = "1399";
     $selectQuery = "alter table aag".$year."0".$i."p".$j." import tablespace";		
     $selectResult = mysqli_query($db, $selectQuery);

     $selectQuery = "select fname, lname from aag13990".$i."P".$j;		
     $selectResult = mysqli_query($db, $selectQuery);
     while ($row = mysqli_fetch_array($selectResult)){
         $insertQuery = mysqli_query($db, "insert into `ghozat` (`fname`, `lname`) values ('".$row[0]."' ,'".$row[1]."');");
     }
  } 
}
*/
// --------------------------------------------------------------------- Reads from Ghozat table to an Excel file
/*	require 'vendor/autoload.php';
	$path1 = 'uploads/b.xlsx';
	$objPHPExcel = IOFactory::load($path1);
        $objPHPExcel->setActiveSheetIndex(0);
        $sqlsel = "SELECT fname, lname from Ghozat;";
        $sqlres = mysqli_query($db, $sqlsel);
	$sheet = 0;
        while ($row = mysqli_fetch_array($sqlres)) {
	$sheet++;
            $objPHPExcel->getActiveSheet()->setCellValue("G".$sheet, $row[0]);
            $objPHPExcel->getActiveSheet()->setCellValue("H".$sheet, $row[1]);
	}
	$objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
        $objWriter->save("uploads/bnew.xlsx");
*/
//---------------------------------------------------------------------- Extract NID & PID from an Excel file to Ghozat table
/*	  require 'vendor/autoload.php';
	  $Reader2 = IOFactory::load("uploads/namesAndCodes.xlsx");
	  $Reader2->setActiveSheetIndex(0);
          $highestRow = $Reader2->getActiveSheet()->getHighestRow();
          for ($c = 2; $c <= $highestRow; $c++) {
                $fname = $Reader2->getActiveSheet()->getCellByColumnAndRow(2, $c);
                $fname = mysqli_real_escape_string($db, $fname);
		
		$lname = $Reader2->getActiveSheet()->getCellByColumnAndRow(3, $c);
                $lname = mysqli_real_escape_string($db, $lname);

		$pid = $Reader2->getActiveSheet()->getCellByColumnAndRow(4, $c);
                $pid = mysqli_real_escape_string($db, $pid);

		$nid = $Reader2->getActiveSheet()->getCellByColumnAndRow(5, $c);
                $nid = mysqli_real_escape_string($db, $nid);

		$que = "insert into ghozat values('".$nid."', '".$pid."', '".$fname."', '".$lname."','قضایی');";
		 if($nid!="")$res = mysqli_query($db, $que);
	  }
*/
?>
</div>
<?php require 'footer.php'; ?>
