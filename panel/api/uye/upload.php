<?php

require_once '../api_include.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;


        $inputFileName = $_SERVER['DOCUMENT_ROOT'] . '/panel/uploads/' . fileMeta($v['fileID'], 'name');

        // 📌 Dosyanın gerçekten var olup olmadığını kontrol et
        if (!file_exists($inputFileName)) {
            die("Hata: Dosya bulunamadı.");
        }

        // 📌 Dosyanın uzantısını al
        $ext = strtolower(pathinfo($inputFileName, PATHINFO_EXTENSION));

        switch ($ext) {
            case 'xlsx':
                $reader = new Xlsx();
                break;
            case 'xls':
                $reader = new Xls();
                break;
            case 'csv':
                $reader = new Csv();
                $reader->setInputEncoding('ISO-8859-9'); // Türkçe karakterler için
                $reader->setDelimiter(','); // CSV'de ayırıcı karakter

                // 📌 Sadece CSV dosyalarını UTF-8'e çevir
                $fileContents = file_get_contents($inputFileName);
                $fileContents = mb_convert_encoding($fileContents, 'UTF-8', 'ISO-8859-9, Windows-1254, UTF-8');

                // 📌 Düzeltilmiş CSV dosyasını geçici olarak kaydet
                $tempFile = $_SERVER['DOCUMENT_ROOT'] . '/panel/uploads/temp_utf8_' . fileMeta($v['fileID'], 'name');
                file_put_contents($tempFile, $fileContents);
                $inputFileName = $tempFile; // Artık dönüştürülmüş dosyayı kullan
                break;
            default:
                die("Hata: Desteklenmeyen dosya formatı ($ext).");
        }

        // 📌 Dosyayı oku
        $spreadsheet = $reader->load($inputFileName);
        $sheetData   = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // 📌 JSON formatına çevirirken Türkçe karakterlerin kaçmasını önle
        $jsonData = json_encode($sheetData, JSON_UNESCAPED_UNICODE);

        // 📌 JSON dosyasını kaydet
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/panel/uploads/' . fileMeta($v['fileID'], 'name') . '_.json';
        file_put_contents($filePath, $jsonData);

        // 📌 CSV için oluşturulan temp dosyayı temizle
        if (isset($tempFile) && file_exists($tempFile)) {
            unlink($tempFile);
        }

        // 📌 JSON dosyasının tam yolu
        $fileName = '/var/www/html/panel/uploads/' . fileMeta($v['fileID'], 'name') . '_.json';





		$db->delete('import')
			->where('type',$v['type'])
			->where('status',0)
			->done();


		$db->insert('import')
			->set([
				'type'=>$v['type'],
				'file'=> $fileName,
				'status'=>'0',
				'data' => json_encode(['uploadDateTime'=>time()])
			]);

		echo pageReturn( array(
			'operation' => 'redirect',
			'location'  => '?page=uye/islem',
			'sleep'     => '0',
			'data'      => $v
		) );

}
