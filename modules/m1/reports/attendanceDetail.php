<?php

class attendanceDetail extends fpdf {

    //Page footer
    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 6);
        //Page number
        $this->Cell(0, 10, 'Printed Date: ' . Yii::app()->dateFormatter->format("dd-MM-yyyy", time()) . '                        ' .
                'Page: ' . $this->PageNo() . '/{nb}' . '                        ' .
                'Issued By: APHRIS - Agung Podomoro Land, Tbk', 0, 0, 'C');
    }

    function report($models) {
        $this->y0 = $this->GetY();
        $this->Cell(0, 5, '', 'T', 0, 'C');
        $this->Image('shareimages/company/FA-logo-APL-2.jpg', 15, 12, 30);
        $this->SetY($this->y0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, '', 'LR');
        $this->Ln();
        $this->Cell(30, 5, '', 'L');
        $this->Cell(0, 5, 'LAPORAN DETIL KEHADIRAN KARYAWAN', 'R', 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, '', 'LBR');
        $this->Ln(1);

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, '', 'B', 0, 'C');
        $this->Ln();
        $this->Cell(35, 8, 'Nama', 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(80, 8, ':  ' . $models[0]->person->employee_name);
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 8, 'NRK');
        $this->Cell(60, 8, '');
        $this->Cell(0, 8, '', 'R');
        $this->Ln();
        $this->Cell(35, 6, 'Departemen', 'L');
        $this->Cell(80, 6, ':  ' . $models[0]->person->mDepartment());
        $this->Cell(40, 6, 'Tanggal Bergabung');
        $this->Cell(40, 6, ':  ' . $models[0]->person->companyfirst->start_date);
        $this->Cell(0, 6, '', 'R');
        $this->Ln();
        $this->Cell(35, 6, 'Jabatan', 'L');
        $this->Cell(80, 6, ':  ' . $models[0]->person->mJobTitle());
        $this->Cell(0, 6, '', 'R');
        $this->Ln(6);
        $this->Cell(0, 6, '', 'T');
        $this->Ln(1);

        $startmonth = '01-' . date("m", strtotime($models[0]->cdate)) . '-' . date("Y", strtotime($models[0]->cdate));
        $endmonth = date("d-m-Y", strtotime(($startmonth . "+1 month") . "-1 day"));

        $this->Cell(0, 6, 'PERIODE: ' . $startmonth . " s/d " . $endmonth, 0, 0, 'C');
        $this->Ln();

        $this->SetFillColor(230, 230, 230);

        $w = array(20, 34, 9, 9, 9, 9, 9, 7, 7, 10, 10, 8, 8, 43);

        $this->Cell(0, 1, '', 'B');
        $this->Ln();
        $this->SetFont('Arial', '', 8);
        $this->Cell($w[0], 5, 'Tanggal', 'LTR', 0, 'C', true);
        $this->Cell($w[1], 5, 'Jadwal', 'LTR', 0, 'C', true);
        $this->Cell($w[2] + $w[3], 5, 'Kehadiran', 1, 0, 'C', true);
        $this->Cell($w[4] + $w[5], 5, 'Lembur', 1, 0, 'C', true);
        $this->Cell($w[6], 5, 'CUTI', 'LTR', 0, 'C', true);
        $this->Cell($w[7], 5, 'A', 'LTR', 0, 'C', true);
        $this->Cell($w[8], 5, 'I', 'LTR', 0, 'C', true);
        $this->Cell($w[9], 5, 'TL', 'LTR', 0, 'C', true);
        $this->Cell($w[10], 5, 'PC', 'LTR', 0, 'C', true);
        $this->Cell($w[11], 5, 'TAD', 'LTR', 0, 'C', true);
        $this->Cell($w[12], 5, 'TAP', 'LTR', 0, 'C', true);
        $this->Cell($w[13], 5, 'Ket', 'LTR', 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[1], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[2], 5, 'In', 'LBR', 0, 'C', true);
        $this->Cell($w[3], 5, 'Out', 'LBR', 0, 'C', true);
        $this->Cell($w[4], 5, 'In', 'LBR', 0, 'C', true);
        $this->Cell($w[5], 5, 'Out', 'LBR', 0, 'C', true);
        $this->Cell($w[6], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[7], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[8], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[9], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[10], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[11], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[12], 5, '', 'LBR', 0, 'C', true);
        $this->Cell($w[13], 5, '', 'LBR', 0, 'C', true);
        $this->Ln();

        $_counter = 1;
        $_countert = 1;
        $fill = false;

        $_cuti = 0;
        $_alpha = 0;

        $ijin = 0;

        $_latein = 0;
        $_earlyout = 0;

        $_actualin = 0;
        $_actualout = 0;

        $_overtimein = "00:00";
        $_overtimeout = "00:00";

        $_countlatein = "00:00";
        $_countlateout = "00:00";

        foreach ($models as $model) {
            $this->SetFont('Arial', '', 8);
            $this->Cell($w[0], 6, $model->cdate, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $model->realpattern->code, 'LR', 0, 'L', $fill);

            if ($model->lateIn == "Late In") {
                $this->SetFont('Arial', 'U', 8);
                $this->Cell($w[2], 6, $model->actualIn, 'LR', 0, 0, $fill);
                $this->SetFont('Arial', '', 8);
            } else {
                $this->Cell($w[2], 6, $model->actualIn, 'LR', 0, 0, $fill);
            }

            if ($model->earlyOut == "Early Out") {
                $this->SetFont('Arial', 'U', 8);
                $this->Cell($w[3], 6, $model->actualOut, 'LR', 0, 0, $fill);
                $this->SetFont('Arial', '', 8);
            } else {
                $this->Cell($w[3], 6, $model->actualOut, 'LR', 0, 0, $fill);
            }

            $this->Cell($w[5], 6, $model->overtimeIn, 'LR', 0, 'L', $fill); //overtime In or inOut
            ($model->overtimeIn != null) ? $_overtimein = peterFunc::addTime($_overtimein, $model->overtimeIn) : $_overtimein;

            $this->Cell($w[5], 6, $model->overtimeOut, 'LR', 0, 'L', $fill); //overtime Out or inOut
            ($model->overtimeOut != null) ? $_overtimeout = peterFunc::addTime($_overtimeout, $model->overtimeOut) : $_overtimeout;


            $this->Cell($w[6], 6, ($model->daystatus3_id == 200) ? "X" : "", 'LR', 0, 'C', $fill); //CUTI
            $_cuti = ($model->daystatus3_id == 200) ? $_cuti + 1 : $_cuti;
            $this->Cell($w[7], 6, ($model->daystatus3_id == 300) ? "X" : "", 'LR', 0, 'C', $fill); //ALPHA
            $_alpha = ($model->daystatus3_id == 300) ? $_alpha + 1 : $_alpha;

            if (isset($model->permission1)) {
                $this->Cell($w[8], 6, "X", 'LR', 0, 'C', $fill);
                $ijin = $ijin + 1;
            }
            else
                $this->Cell($w[8], 6, "", 'LR', 0, 'C', $fill);

            $this->Cell($w[9], 6, $model->diffIn, 'LR', 0, 'C', $fill);
            $_latein = ($model->diffIn != null) ? $_latein + 1 : $_latein;
            ($model->diffIn != null) ? $_countlatein = peterFunc::addTime($_countlatein, $model->diffIn) : $_countlatein;

            $this->Cell($w[10], 6, $model->diffOut, 'LR', 0, 'C', $fill);
            $_earlyout = ($model->diffOut != null) ? $_earlyout + 1 : $_earlyout;
            ($model->diffOut != null) ? $_countlateout = peterFunc::addTime($_countlateout, $model->diffOut) : $_countlateout;

            $this->Cell($w[11], 6, ($model->actualIn == "??:??") ? "X" : "", 'LR', 0, 'C', $fill);
            $_actualin = ($model->actualIn == "??:??") ? $_actualin + 1 : $_actualin;
            $this->Cell($w[12], 6, ($model->actualOut == "??:??") ? "X" : "", 'LR', 0, 'C', $fill);
            $_actualout = ($model->actualOut == "??:??") ? $_actualout + 1 : $_actualout;
            if (isset($model->permission1)) {
                $this->Cell($w[13], 6, $model->permission1->name . ". " . $model->remark, 'LR', 0, 'L', $fill);
            }
            else
                $this->Cell($w[13], 6, $model->remark, 'LR', 0, 'L', $fill);

            $this->Ln();

            $fill = !$fill;
            $_counter++;
            $_countert++;

            if ($_counter == 34) {
                $this->Cell(array_sum($w), 0, '', 'T');
                $this->AddPage();

                $this->myheader();

                $_counter = 1;
            }
        }
        $this->Cell(array_sum($w), 2, '', 'T', 0, 0);
        $this->Ln();
        $this->Cell($w[0], 5, '', 1, 0, 'C', true);
        $this->Cell($w[1], 5, 'TOTAL', 1, 0, 'C', true);
        $this->Cell($w[2], 5, '', 1, 0, 'C', true);
        $this->Cell($w[3], 5, '', 1, 0, 'C', true);
        $this->Cell($w[4], 5, '', 1, 0, 'C', true);
        $this->Cell($w[5], 5, '', 1, 0, 'C', true);
        $this->Cell($w[6], 5, $_cuti, 1, 0, 'C', true);
        $this->Cell($w[7], 5, $_alpha, 1, 0, 'C', true);
        $this->Cell($w[8], 5, $ijin, 1, 0, 'C', true);
        $this->Cell($w[9], 5, $_latein, 1, 0, 'C', true);
        $this->Cell($w[10], 5, $_earlyout, 1, 0, 'C', true);
        $this->Cell($w[11], 5, $_actualin, 1, 0, 'C', true);
        $this->Cell($w[12], 5, $_actualout, 1, 0, 'C', true);
        $this->Cell($w[13], 5, '', 1, 0, 'C', true);
        $this->Ln();
        $this->Cell($w[0], 5, '', 1, 0, 'C', true);
        $this->Cell($w[1], 5, 'TOTAL HOURS', 1, 0, 'C', true);
        $this->Cell($w[2], 5, '', 1, 0, 'C', true);
        $this->Cell($w[3], 5, '', 1, 0, 'C', true);
        $this->Cell($w[4], 5, $_overtimein, 1, 0, 'C', true);
        $this->Cell($w[5], 5, $_overtimeout, 1, 0, 'C', true);
        $this->Cell($w[6], 5, '', 1, 0, 'C', true);
        $this->Cell($w[7], 5, '', 1, 0, 'C', true);
        $this->Cell($w[8], 5, '', 1, 0, 'C', true);
        $this->Cell($w[9], 5, $_countlatein, 1, 0, 'C', true);
        $this->Cell($w[10], 5, $_countlateout, 1, 0, 'C', true);
        $this->Cell($w[11], 5, '', 1, 0, 'C', true);
        $this->Cell($w[12], 5, '', 1, 0, 'C', true);
        $this->Cell($w[13], 5, '', 1, 0, 'C', true);
        $this->Ln(8);

        $this->Cell(60, 4, 'A = ALPHA');
        $this->Cell(60, 4, 'TL = TERLAMBAT');
        $this->Cell(60, 4, 'TAD = TIDAK ABSEN DATANG');
        $this->Ln();
        $this->Cell(60, 4, 'PC = PULANG CEPAT');
        $this->Cell(60, 4, 'TAP = TIDAK ABSEN PULANG');
        $this->Cell(60, 4, 'I = IJIN (SAKIT)');
        $this->Ln();
    }

}

?>