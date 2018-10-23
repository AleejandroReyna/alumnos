<?php
	function decimals($evaluate, $array_values) {
		$values;
		if($evaluate <= 15 || ($evaluate % 10 == 0)) {
			return $array_values[strval($evaluate)];
		} else {
			return $array_values[strval(floor($evaluate / 10) * 10) ] . ' y ' . $array_values[strval($evaluate % 10)];
		}
	}
	
	function centimals($evaluate, $array_values) {
		if($evaluate < 1) {
			return null;
		}
		if($evaluate <= 15 || ($evaluate % 10 == 0 && $evaluate <= 100) || $evaluate == 1000 ) {
			return $array_values[strval(floor($evaluate))];
		} else if ($evaluate <= 99) {
			return  decimals($evaluate, $array_values);
		}  else if($evaluate <= 999) {
			$variant = "";
			$pivot = floor($evaluate / 100);
			if($pivot == 1) {
				$variant = "ciento ";
			} else if($pivot == 5) {
				$variant = "quinientos ";
			} else if ($pivot == 7) {
				$variant = "setecientos ";
			} else if ($pivot == 9) {
				$variant = 'novecientos ';
			} else {
				$variant = $array_values[strval($pivot)] . 'cientos';
			}
			return $variant . ' ' . decimals($evaluate - ($pivot * 100), $array_values);
		} 
	}
	
	function int_to_words($val) {
		$values = array(
			'1' => 'uno',
			'2' => 'dos',
			'3' => 'tres',
			'4' => 'cuatro',
			'5' => 'cinco',
			'6' => 'seis',
			'7' => 'siete',
			'8' => 'ocho',
			'9' => 'nueve',
			'10' => 'diez',
			'11' => 'once',
			'12' => 'doce',
			'13' => 'trece',
			'14' => 'catorce',
			'15' => 'quince',
			'20' => 'veinte',
			'30' => 'treinta',
			'40' => 'cuarenta',
			'50' => 'cincuenta',
			'60' => 'sesenta',
			'70' => 'setenta',
			'80' => 'ochenta',
			'90' => 'noventa',
			'100' => 'cien',
			'1000' => 'mil'
		);	
		
		if($val == 0) {
			return 'cero';
		} if($val > 999999999) {
			return 'numero mayor a 999999999'; 
		} else {
			$length = strlen(strval($val));
			if($length % 3 == 2) {
				$val = '0' . $val;
			} else if($length % 3 == 1) {
				$val = '00' . $val;
			}
			$number_array = str_split(strval($val), 3);
			
			if(count($number_array) == 1 ) {
				return centimals($number_array[0], $values);
			} else if(count($number_array) == 2) {
				return $number_array[0] > 1 ? centimals($number_array[0], $values) . ' mil ' . centimals($number_array[1], $values) : 'mil ' . centimals($number_array[1], $values) ;
			} else if(count($number_array) == 3) {
				$millions = $number_array[0] > 1 ? centimals($number_array[0], $values) . ' millones ' : 'Un millon ';
				$tousands = $number_array[1] > 1 ? centimals($number_array[1], $values) . ' mil ' : ' mil ';
				return $millions . $tousands . centimals($number_array[2], $values);
			}
		}
		
	}
	
	echo 12345 . ' es ' . int_to_words(12345);
	echo '<br />';
	echo 999 . ' es ' . int_to_words(999);
	echo '<br />';
	echo 1 . ' es ' . int_to_words(1);
	echo '<br />';
	echo 123456789 . ' es ' . int_to_words(123456789);
?>