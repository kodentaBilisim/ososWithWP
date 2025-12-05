<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;


		$inputFileName = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . fileMeta( $v['fileID'], 'name' );
		$spreadsheet   = PhpOffice\PhpSpreadsheet\IOFactory::load( $inputFileName );
		$sheetData     = $spreadsheet->getActiveSheet()->toArray( null, true, true, true );
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/uploads/'.fileMeta( $v['fileID'], 'name' ).'_.json', json_encode($sheetData));

		echo pageReturn( array(
			'operation' => 'redirect',
			'location'  => '?page=isyeri/ekle&fileID=' . $v['fileID'].'&le='.count($sheetData),
			'sleep'     => '0',
			'data'      => $v
		) );

}
