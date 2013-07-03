<?php
/*
*
* Class : peterFunc
* Beraneka ragam fungsi yang berhubungan dengan datetime, 
* memperpendek sintaks dan menyamakan standard date dari Fungsi2 Date di Database, PHP maupun Yii Framework
*
* author: Peter J. Kambey
* 7 November 2012
* gratis
*
* contoh:
* echo peterFunc::convertTime('2012-01-01 13:50');
* hasil: 13:50
* 
* pertimbangan:

http://php.net/manual/en/function.strtotime.php
besluitloos at gmail dot com 05-Oct-2011 01:28

I just found out PHP thinks slashes in date-formats aren't very european:
(I guess this is not a bug, just the way it works. But correct me if I'm wrong.)


    $date = "06/10/2011 14:28"; // 6 october 2011 2:28 pm
    $otherDate = "06-10-2011 14:28"; // 6 october 2011 2:28 pm
    
    echo $stamp = strtotime($date) . "<br/>"; // outputs 1307708880
    echo $otherStamp = strtotime($otherDate) . "<br />"; // outputs 1317904080
    
    echo date("d-m", $stamp); // outputs 10-06
    echo date("d-m", $otherStamp); // outputs 06-10

* hasil keluaran dari baseModel (class dasar dari seluruh CActiveRecord) adalah $date = "06-10-2011 14:28"; // 6 october 2011 2:28 pm
* format standard MySQL dari database adalah $date = "2011-10-06 14:28"; // 6 october 2011 2:28 pm
* Meskipun tidak begitu bermasalah, HARUS perhatikan pemanggilan parameter $datetime diambil dari BaseModel atau langsung ke Database. 

* Format Date Time Yii menggunakan Format di link berikut ini:
http://www.unicode.org/reports/tr35/#Date_Format_Patterns

* PHP Format
// Assuming today is March 10th, 2001, 5:16:18 pm, and that we are in the
// Mountain Standard Time (MST) Time Zone

$today = date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm
$today = date("m.d.y");                         // 03.10.01
$today = date("j, n, Y");                       // 10, 3, 2001
$today = date("Ymd");                           // 20010310
$today = date('h-i-s, j-m-y, it is w Day');     // 05-16-18, 10-03-01, 1631 1618 6 Satpm01
$today = date('\i\t \i\s \t\h\e jS \d\a\y.');   // it is the 10th day.
$today = date("D M j G:i:s T Y");               // Sat Mar 10 17:16:18 MST 2001
$today = date('H:m:s \m \i\s\ \m\o\n\t\h');     // 17:03:18 m is month
$today = date("H:i:s");                         // 17:16:18
$today = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (the MySQL DATETIME format)

*/

Class peterFunc {
	public function toTime($datetime)
	{
		if (isset($datetime)) {
			//$_val=Yii::app()->dateFormatter->format("kk:mm",strtotime($datetime));  //Yii Format
			$_val=date("H:i",strtotime($datetime));  //PHP Format
		} else
			$_val="";
			
		return $_val;
	}

	public function isTimeMore($from,$to)
	{
		//Time1 must be convert to same date with time2
		$thisdatetime=Yii::app()->dateFormatter->format("dd-MM-yyyy",strtotime($to)) ." ".Yii::app()->dateFormatter->format("kk:mm",strtotime($from));
		//$thisdatetime=date("d-m-Y",strtotime($to)) ." ".date("H:i",strtotime($from)); //PHP Format
		
		if (isset($to) && strtotime($thisdatetime)> strtotime($to)) {
			$_val=true; 
		} else 	 
			$_val=false;
			
		return $_val;
	}
	
	public function countTimeDiff($from,$to) 
	{
		if (isset($from) && isset($to)) {
			//Time1 must be convert to same date with time2
			$thisdatetime=Yii::app()->dateFormatter->format("dd-MM-yyyy",strtotime($to)) ." ".Yii::app()->dateFormatter->format("kk:mm",strtotime($from));
			//$thisdatetime=date("d-m-Y",strtotime($to)) ." ".date("H:i",strtotime($from)); //PHP Format

			$diff=strtotime($thisdatetime)-strtotime($to);
			if( $hours=intval((floor($diff/3600))) ) $diff = $diff % 3600;
			if( $minutes=intval((floor($diff/60))) ) $diff = $diff % 60;
			$diff    =    intval( $diff ); 
			$_val=str_pad($hours,2,"0",STR_PAD_LEFT).":".str_pad($minutes,2,"0",STR_PAD_LEFT); 
		} else
			$_val="";
			
		return $_val;
	}

	public function addTime($timeCurrent,$timeNew) 
	{
		$hourCurrent=explode(":",$timeCurrent);
		$hourNew=explode(":",$timeNew);
		
		$hourAdd=(int)$hourCurrent[0]+(int)$hourNew[0];
		$minuteAdd=(int)($hourCurrent[1])+(int)$hourNew[1];
		
		if ($minuteAdd >=60) {
			$minuteAdd = $minuteAdd-60;
			$hourAdd=$hourAdd+1;
		}
		
		$_val=str_pad($hourAdd,2,"0",STR_PAD_LEFT).":".str_pad($minuteAdd,2,"0",STR_PAD_LEFT); 
		
		return $_val;
		//return $hourAdd;
	
	}

	//http://stackoverflow.com/questions/12444945/cut-the-content-after-10-words	
	public function shorten_string($oldstring, $wordsreturned)
	{
		$retval = $string = "";
		$string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $oldstring);
		$string = str_replace("\n", " ", $string);
		$array = explode(" ", $string);
		if (count($array)<=$wordsreturned)
		{
		$retval = $string;
		}
		else
		{
		array_splice($array, $wordsreturned);
		$retval = implode(" ", $array)." ...";
		}
		return $retval;
	}		
	
	//http://www.lateralcode.com/creating-a-random-string-with-php/
	public function rand_string( $length ) {
		$str="";
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}

	//http://sutisna87.wordpress.com/2011/02/13/membuat-fungsi-tanggal-bahasa-indonesia/	
	public function hari($date=null)
	{
		if (!isset($date)) {
			$hari = date("w");
		} else
			$hari = date("w",strtotime($date)); 	
			
		switch ($hari)
		{
			 case 0 : $hari = "Minggu";
					  return $hari;
					  break;
			 case 1 : $hari = "Senin";
					  return $hari;
					  break;
			 case 2 : $hari = "Selasa";
					 return $hari;
					 break;
			 case 3 : $hari = "Rabu";
					 return $hari;
					  break;
			case 4 : $hari = "Kamis";
				   return $hari;
				   break;
			case 5 : $hari = "Jum'at";
				   return $hari;
				   break;
		   case 6 : $hari = "Sabtu";
				   return $hari;
				   break;
		}
		
	}
 
	public function bulan($date=null)
	{
		if (!isset($date)) {
			$bulan = date("m");
		} else
			$bulan = date("m",strtotime($date)); 	

	   switch ($bulan)
	   {
		case 1 : $bulan = " Januari";
				   return $bulan;
				   break;
		case 2 : $bulan = " Februari";
				return $bulan;
				break;
		 case 3 : $bulan = " Maret";
				   return $bulan;
				   break;
		 case 4 : $bulan = " April";
				   return $bulan;
				   break;
		 case 5 : $bulan = " Mei";
				   return $bulan;
				   break;
		 case 6 : $bulan = " Juni";
				   return $bulan;
				   break;
		 case 7 : $bulan = " Juli";
				   return $bulan;
				   break;
		 case 8 : $bulan = " Agustus";
				   return $bulan;
				   break;
		 case 9 : $bulan = " September";
				   return $bulan;
				   break;
		 case 10 : $bulan = " Oktober";
				   return $bulan;
				   break;
		 case 11 : $bulan = " November";
				   return $bulan;
				   break;
		 case 12 : $bulan = " Desember";
				   return $bulan;
				   break;
 
		}
	}


	public function tanggalpenuh($date) {
		if (!isset($date)) {
			$full = date("Y-m-d");
		} else
			$full = $date; 	
			
		$val = date("d",strtotime($full))." ".peterFunc::bulan($full)  ." ".date("Y",strtotime($full));
			
		return $val;
	} 

	public function bulanromawi($date=null)
	{
		if (!isset($date)) {
			$bulan = date("m");
		} else
			$bulan = date("m",strtotime($date)); 	
			
		switch ($bulan)
		{
			 case 1 : $bulan = "I";
					  return $bulan;
					  break;
			 case 2 : $bulan = "II";
					 return $bulan;
					 break;
			 case 3 : $bulan = "III";
					 return $bulan;
					  break;
			case 4 : $bulan = "IV";
				   return $bulan;
				   break;
			case 5 : $bulan = "V";
				   return $bulan;
				   break;
		   case 6 : $bulan = "VI";
				   return $bulan;
				   break;
		   case 7 : $bulan = "VII";
				   return $bulan;
				   break;
		   case 8 : $bulan = "VIII";
				   return $bulan;
				   break;
		   case 9 : $bulan = "IX";
				   return $bulan;
				   break;
		   case 10 : $bulan = "X";
				   return $bulan;
				   break;
		   case 11 : $bulan = "XI";
				   return $bulan;
				   break;
		   case 12 : $bulan = "XII";
				   return $bulan;
				   break;
		}
		
	}

}

?>
