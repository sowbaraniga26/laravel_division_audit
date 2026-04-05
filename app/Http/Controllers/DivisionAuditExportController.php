<?php

namespace App\Http\Controllers;

use App\Models\DivisonAudit;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DivisionAuditExportController extends Controller
{
    public function export()
    {
        $audits = DivisonAudit::with(['location', 'department', 'reason'])->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // ✅ Header Row
        $sheet->setCellValue('A1', 'Date');
        $sheet->setCellValue('B1', 'Location');
        $sheet->setCellValue('C1', 'Department');
        $sheet->setCellValue('D1', 'Reason');
        $sheet->setCellValue('E1', 'Status');
        $sheet->setCellValue('F1', 'Remarks');

        // ✅ Data
        $row = 2;
        foreach ($audits as $audit) {
            $sheet->setCellValue("A$row", $audit->audit_date);
            $sheet->setCellValue("B$row", $audit->location->name ?? '');
            $sheet->setCellValue("C$row", $audit->department->name ?? '');
            $sheet->setCellValue("D$row", $audit->reason->reason ?? '');
            $sheet->setCellValue("E$row", $audit->status);
            if ($audit->status === 'critical') {
                $sheet->getStyle("A$row:F$row")->getFont()->getColor()->setRGB('FF0000');
            }
            $sheet->setCellValue("F$row", $audit->remarks);
            $row++;
        }

        // ✅ Auto size columns
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ✅ Download
        $fileName = 'division_audit.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}