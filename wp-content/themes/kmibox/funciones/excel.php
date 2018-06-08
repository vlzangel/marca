<?php
	
	include( dirname(__DIR__)."/lib/PHPExcel/PHPExcel.php" );
	require_once( dirname(__DIR__)."/lib/PHPExcel/PHPExcel/Cell/AdvancedValueBinder.php" );

	function letras(){
		return array(
			"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"
		);
	}
	
	function crearEXCEL($params){

		PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
		PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

		// Crea un nuevo objeto PHPExcel
	        $objPHPExcel = new PHPExcel();

	    // Establecer propiedades
	        $objPHPExcel->getProperties()
	            ->setCreator("NutriHeroes")
	            ->setLastModifiedBy("NutriHeroes")
	            ->setTitle($params["nombre"])
	            ->setSubject($params["nombre"])
	            ->setDescription($params["nombre"])
	            ->setKeywords("Excel Office 2007 OpenXML PHP")
	            ->setCategory($params["nombre"]);

	    // Agregar Informacion

	        $letras = letras();

	        foreach ($params["titulos"] as $_i => $_titulo) {
		        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letras[$_i]."1", $_titulo);
		        $objPHPExcel->getActiveSheet()->getStyle($letras[$_i]."1")->getFont()->setBold(true);
	           	$objPHPExcel->getActiveSheet()->getColumnDimension($letras[$_i])->setAutoSize(true);
	        }
	        foreach ($params["data"] as $_i => $_fila) {
	        	foreach ($_fila as $_j => $_valor) {
	        		$i = $_i+2;
	        		$objPHPExcel->setActiveSheetIndex(0)->getStyle($letras[$_j].$i)->getAlignment()->setVERTICAL(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        		if( !is_array($_valor)){
	        			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letras[$_j].$i, $_valor);
	        		}else{
	        			
	        			switch ($_valor["tipo"]) {
	        				case 'link':
	        					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letras[$_j].$i, $_valor["valor"]);
	        					$objPHPExcel->getActiveSheet()->getCell($letras[$_j].$i)->getHyperlink()->setUrl(strip_tags($_valor["link"]));
	        					$objPHPExcel->getActiveSheet()->getStyle($letras[$_j].$i)->applyFromArray(
	        						array(
	        							'font'  => array(
									        'color' => array('rgb' => '007bff')
									    )
	        						)
	        					);
	        				break;
	        				case 'img':
	        					if( file_exists($_valor["valor"]) ){
		        					$gdImage = imagecreatefromstring( file_get_contents( $_valor["valor"] ) );
									$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
									$objDrawing->setName('Sample image');
									$objDrawing->setDescription('Sample image');
									$objDrawing->setImageResource($gdImage);
									$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
									$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
									$objDrawing->setCoordinates($letras[$_j].$i); 
									$objDrawing->setOffsetX(10);               
									$objDrawing->setOffsetY(10);              
									$objDrawing->setHeight(60); 
									$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

									$objPHPExcel->setActiveSheetIndex(0);
									$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(60);
		           					$objPHPExcel->getActiveSheet()->getColumnDimension($letras[$_j])->setAutoSize(false);
									$objPHPExcel->getActiveSheet()->getColumnDimension($letras[$_j])->setWidth(50);
	        					}
	        				break;
	        				
	        				default:
	        					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letras[$_j].$i, $_valor["valor"]);
        					break;
	        			}

	        		}
		        }
	        }
	        

	    // Renombrar Hoja
	        $objPHPExcel->getActiveSheet()->setTitle($params["nombre"]);

	    // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
	        $objPHPExcel->setActiveSheetIndex(0);

	    // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	        header('Content-Disposition: attachment;filename="'.$params["file_name"].'.xls"');
	        header('Cache-Control: max-age=0');

	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	        $objWriter->save('php://output');
	    exit;

	}
?>