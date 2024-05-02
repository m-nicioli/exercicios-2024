<?php

namespace Chuva\Php\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

class criacaoPlanilha {

   
    public static function createExcelFileFromPapers(array $papers): void {
        $writer = WriterEntityFactory::createXLSXWriter();

        $filePath = __DIR__ . '../../../assets/Planilha.xlsx';
        $writer->openToFile($filePath);

        
        $row = WriterEntityFactory::createRowFromArray(['ID', 'Título', 'Tipo', 'Autor 1', 'Instituição do Autor 1', 'Autor 2', 'Instituição do Autor 2', 'Autor 3', 'Instituição do Autor 3', 'Autor 4', 'Instituição do Autor 4', 'Autor 5', 'Instituição do Autor 5']);
        $writer->addRow($row);


        foreach ($papers as $paper) {
            $data = [
                $paper->id,
                $paper->titulo,
                implode(', ', $paper->tipo),
            ];

            foreach ($paper->autores as $autor) {
                $data[] = $autor->nome;
                $data[] = $autor->instituicao;
            }

            $row = WriterEntityFactory::createRowFromArray($data);
            $writer->addRow($row);
        }
        $writer->close();
    }
}