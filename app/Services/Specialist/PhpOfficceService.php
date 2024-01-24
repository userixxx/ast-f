<?php

namespace App\Services\Specialist;

use Exception;
use PhpOffice\PhpWord\TemplateProcessor;
use Spatie\Color\Rgb;

class PhpOfficceService
{
    public static function getWordDocument($reports, $form, $formFields, $farm, $file_contents, $legendJson)
    {
        $imagePath = public_path() . ('/img/ast-pdf.png');
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(['orientation' => 'landscape']);

        $user = auth()->user();


        $find = strpos($file_contents, ';base64,');
        if ($find !== false) {
            $file_contents = substr($file_contents, $find + 8);
        }

        $headerTable = $section->addTable([
            'borderSize' => 0, 'borderColor' => 'ffffff00', 'cellMargin' => 8
        ]);


        $headerTable->addRow(500);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'left'])->addText(htmlspecialchars('АгроСтар-Трейд+'), [
            'bold' => false, 'align' => 'center'
        ]);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'left'])->addText(htmlspecialchars('Консультант-технолог: ' . $user->fullName), [
            'bold' => false, 'align' => 'center'
        ]);
        $headerTable->addRow(500);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'right'])->addText(htmlspecialchars('тел: 8 800 600-90-55'), [
            'bold' => false, 'align' => 'center'
        ]);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'right'])->addText(htmlspecialchars('тел: ' . $user->phone), [
            'bold' => false, 'align' => 'center'
        ]);

        $section->addTextBreak(1);


        $section->addImage($imagePath, [
            'width' => 100,
            'height' => 100,
            'marginTop' => -1,
            'marginLeft' => -1,
            'wrappingStyle' => 'behind'
        ]);

        $section->addTextBreak(1);
        $section->addText('', [], ['borderTopSize' => 5]);
        $section->addText($farm->region->name . " - " . $farm->organization->name . " - " . $form->name . " - " . date('Y-m-d'), [], ['lineHeight' => 2]);
        $section->addText('', [], ['borderTopSize' => 5]);

        $section->addText($form->name, ['size' => 11, 'bold' => true]);
        $section->addTextBreak(1);

        $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 8);
        $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '000000', 'bgColor' => '66BBFF');
        $styleCell = array('valign' => 'center');
        $styleCellBTLR = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fontStyle = array('bold' => true, 'align' => 'center');
        $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);

        /*
         * Таблица, другая
         */

        $table = $section->addTable('Fancy Table');
        $table->addRow(900);
//        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Организация'), $fontStyle);
//        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Ферма'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Дата'), $fontStyle);
        foreach ($formFields as $formField) {
            $table->addCell(2000)->addText(htmlspecialchars($formField->name));
        }
        foreach ($reports as $key => $report) {
            $table->addRow();
//            $table->addCell(2000, $styleCell)->addText(htmlspecialchars($report->organization?->name), $fontStyle);
//            $table->addCell(2000, $styleCell)->addText(htmlspecialchars($report->farm?->name), $fontStyle);
            $table->addCell(2000, $styleCell)->addText(htmlspecialchars($report->date), $fontStyle);

            foreach ($formFields as $formField) {
                if( in_array($formField->type, ['number', 'select', 'text',  'radio', 'string']) ) {
                    $table->addCell(2000)->addText(htmlspecialchars(isset($report->data["field_$formField->id"])) ? $report->data["field_$formField->id"] : ($formField->type === 'number' ? '0' : ''));
                } else {
                    $table->addCell(2000)->addText(htmlspecialchars(isset($report->data["field_$formField->id"])) ? implode(", ", $report->data["field_$formField->id"]) : ($formField->type === 'number' ? '0' : ''));
                }
            }
        }

        /*
         * Таблица инверсия, начало
         */
//        $table = $section->addTable('Fancy Table');
//        $table->addRow(900);
//        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('#'), $fontStyle);
//
//        foreach ($reports as $key => $report) {
//            $table->addCell(2000, $styleCell)->addText(htmlspecialchars($key + 1), $fontStyle);
//        }
//
//        foreach ($formFields as $formField) {
//            $table->addRow();
//            $table->addCell(2000)->addText(htmlspecialchars($formField->name));
//            foreach ($reports as $report) {
//                $table->addCell(2000)->addText(htmlspecialchars(isset($report->data["field_$formField->id"])) ? $report->data["field_$formField->id"] : ($formField->type === 'number' ? '0' : ''));
//            }
//        }
//
//        $table->addRow();
//        $table->addCell(2000)->addText('Дата');
//        foreach ($reports as $report) {
//            $table->addCell(2000)->addText(htmlspecialchars(isset($report->date) ? $report->date : ''));
//        }

        /*
         * Таблица, конец
         */

        $section->addTextBreak(2);

        $chartSection = $phpWord->addSection(['orientation' => 'landscape']);

        $image = $chartSection->addImage(base64_decode($file_contents), [
            'width' => 710,
            'marginLeft' => -10,
            'positioning' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
            'wrappingStyle' => 'square'
        ]);

        if ($legendJson) {
            $chartSection->addTextBreak(1);
            $legend = json_decode($legendJson);
            $textrun = $chartSection->addTextRun(['spacing' => 100,]);
            foreach ($legend as $item) {
                $rgb = Rgb::fromString($item->bgColor)->toHex();
                $textrun->addText($item->text . ' ', ['bgColor' => $rgb]);
                $textrun->addText(' ');
            }
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $name = date('Y-m-d-H-i-s') . '_document.docx';
            $objWriter->save(public_path() . '/storage/' . $name);
        } catch (Exception $e) {
        }

        return public_path() . '/storage/' . $name;
    }

    public static function getWordDocumentWithSVG($reports, $form, $formFields, $farm, $url, $legend)
    {
        $imagePath = public_path() . ('/storage/ast_logo.png');
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $user = auth()->user();

        $section->addImage($url);

        $headerTable = $section->addTable([
            'borderSize' => 0, 'borderColor' => 'ffffff00', 'cellMargin' => 8
        ]);

        $headerTable->addRow(500);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'left'])->addText(htmlspecialchars('АгроСтар-Трейд+'), [
            'bold' => false, 'align' => 'center'
        ]);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'left'])->addText(htmlspecialchars('Консультант-технолог: ' . $user->fullName), [
            'bold' => false, 'align' => 'center'
        ]);
        $headerTable->addRow(500);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'right'])->addText(htmlspecialchars('тел: 8 800 600-90-55'), [
            'bold' => false, 'align' => 'center'
        ]);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'right'])->addText(htmlspecialchars('тел: ' . $user->phone), [
            'bold' => false, 'align' => 'center'
        ]);

        $section->addTextBreak(1);


        $section->addImage($imagePath, [
            'width' => 100,
            'height' => 100,
            'marginTop' => -1,
            'marginLeft' => -1,
            'wrappingStyle' => 'behind'
        ]);

        $section->addTextBreak(1);
        $section->addText('', [], ['borderTopSize' => 5]);
        $section->addText($farm->region->name . " - " . $farm->organization->name . " - " . $form->name . " - " . date('Y-m-d'), [], ['lineHeight' => 2]);
        $section->addText('', [], ['borderTopSize' => 5]);

        $section->addText($form->name, ['size' => 11, 'bold' => true]);
        $section->addTextBreak(1);

        $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 8);
        $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '000000', 'bgColor' => '66BBFF');
        $styleCell = array('valign' => 'center');
        $styleCellBTLR = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fontStyle = array('bold' => true, 'align' => 'center');
        $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
        $table = $section->addTable('Fancy Table');
        $table->addRow(900);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('#'), $fontStyle);

        foreach ($reports as $key => $report) {
            $table->addCell(2000, $styleCell)->addText(htmlspecialchars($key + 1), $fontStyle);
        }

        foreach ($formFields as $formField) {
            $table->addRow();
            $table->addCell(2000)->addText(htmlspecialchars($formField->name));
            foreach ($reports as $report) {
                $table->addCell(2000)->addText(htmlspecialchars(isset($report->data["field_$formField->id"])) ? $report->data["field_$formField->id"] : ($formField->type === 'number' ? '0' : ''));
            }
        }

        $table->addRow();
        $table->addCell(2000)->addText('Дата');
        foreach ($reports as $report) {
            $table->addCell(2000)->addText(htmlspecialchars(isset($report->date) ? $report->date : ''));
        }

//        $chartSection = $phpWord->addSection();
//        $categories = $reports->pluck('date')->toArray();
//        $series = collect($reports->pluck('data'))->pluck('field_1')->toArray();

//        dump($categories);
//        dd($series);
//        $textRun = $chartSection->addTextRun();
//        $text = $textRun->addText('Hello World! Time to ');
//        $chart = $chartSection->addChart('line', $categories, $series);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $name = date('Y-m-d-H-i-s') . '_document.docx';
            $objWriter->save(public_path() . '/storage/' . $name);
        } catch (Exception $e) {
        }

        return public_path() . '/storage/' . $name;
    }
}
