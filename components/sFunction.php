<?php

class sFunction {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function BulanTahun($val) {
        $_bulan = substr($val, 4, 2);
        $_tahun = substr($val, 0, 4);


        if ($_bulan == "01")
            $_bulan = "Januari";
        else if ($_bulan == "02")
            $_bulan = "Februari";
        else if ($_bulan == "03")
            $_bulan = "Maret";
        else if ($_bulan == "04")
            $_bulan = "April";
        else if ($_bulan == "05")
            $_bulan = "Mei";
        else if ($_bulan == "06")
            $_bulan = "Juni";
        else if ($_bulan == "07")
            $_bulan = "Juli";
        else if ($_bulan == "08")
            $_bulan = "Agustus";
        else if ($_bulan == "09")
            $_bulan = "September";
        else if ($_bulan == "10")
            $_bulan = "Oktober";
        else if ($_bulan == "11")
            $_bulan = "November";
        else if ($_bulan == "12")
            $_bulan = "Desember";

        $val = $_bulan . " " . $_tahun;

        return $val;
    }

    public static function cBeginDateBefore($val) {
        $_bulan = substr($val, 4, 2);
        $_tahun = substr($val, 0, 4);


        if ($_bulan == "01") {
            $_bulan1 = "12";
            $_tahun = ((int) $_tahun) - 1;
        } else if ($_bulan == "02")
            $_bulan1 = "01";
        else if ($_bulan == "03")
            $_bulan1 = "02";
        else if ($_bulan == "04")
            $_bulan1 = "03";
        else if ($_bulan == "05")
            $_bulan1 = "04";
        else if ($_bulan == "06")
            $_bulan1 = "05";
        else if ($_bulan == "07")
            $_bulan1 = "06";
        else if ($_bulan == "08")
            $_bulan1 = "07";
        else if ($_bulan == "09")
            $_bulan1 = "08";
        else if ($_bulan == "10")
            $_bulan1 = "09";
        else if ($_bulan == "11")
            $_bulan1 = "10";
        else if ($_bulan == "12")
            $_bulan1 = "11";

        $val = $_tahun . $_bulan1;

        return $val;
    }

    public static function cBeginDateAfter($val) {
        $_bulan = substr($val, 4, 2);
        $_tahun = substr($val, 0, 4);


        if ($_bulan == "01")
            $_bulan1 = "02";
        else if ($_bulan == "02")
            $_bulan1 = "03";
        else if ($_bulan == "03")
            $_bulan1 = "04";
        else if ($_bulan == "04")
            $_bulan1 = "05";
        else if ($_bulan == "05")
            $_bulan1 = "06";
        else if ($_bulan == "06")
            $_bulan1 = "07";
        else if ($_bulan == "07")
            $_bulan1 = "08";
        else if ($_bulan == "08")
            $_bulan1 = "09";
        else if ($_bulan == "09")
            $_bulan1 = "10";
        else if ($_bulan == "10")
            $_bulan1 = "11";
        else if ($_bulan == "11")
            $_bulan1 = "12";
        else if ($_bulan == "12") {
            $_bulan1 = "01";
            $_tahun = ((int) $_tahun) + 1;
        }

        $val = $_tahun . $_bulan1;

        return $val;
    }

    public static function convertHari($val) {
        if ($val == 1) {
            $_hari = "Senin";
        } elseif ($val == 2) {
            $_hari = "Selasa";
        } elseif ($val == 3) {
            $_hari = "Rabu";
        } elseif ($val == 4) {
            $_hari = "Kamis";
        } elseif ($val == 5) {
            $_hari = "Jumat";
        } elseif ($val == 6) {
            $_hari = "Sabtu";
        } elseif ($val == 0) {
            $_hari = "Minggu";
        }

        return $_hari;
    }

}