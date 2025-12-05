<?php

class XMLtoJSON {

	public function parse( $xmlContent ) {

		$filechange = str_replace( array( "\n", "\r", "\t" ), '', $xmlContent );
		$filetrim   = trim( str_replace( '"', "'", $filechange ) );
		$resultxml  = simplexml_load_string( $filetrim );
		$resultjson = json_encode( $resultxml );

		return $resultjson;

	}

}
