<?php

//var_dump(solution(random_array()));
//var_dump(solution([5,5,5,0,-2,6,3,4,7,5,8,6,7,3,5,4,5,5]));
var_dump(solution([5,0,-2,6,3,4,4,-3,5]));
//var_dump(solution([]));
//var_dump(solution([2]));
//var_dump(solution([2,3]));
//var_dump(solution([-2, 0]));
//var_dump(solution([0]));
//var_dump(solution([1,2,3]));
//var_dump(solution([1,5,2]));
//var_dump(solution([1,5,2,2]));

function random_array(){
	$A = array();
	$max_index = rand(0, 100000);
	for($i = 0; $i<=$max_index ; $i++){
		$A[] = rand(-1000000000, 1000000000);
	}
	return $A;
}

function solution($A){
	if(count($A) == 0){
		return 0;
	}

	$P = 0;
	$Q = 0;
	$largest_size = 1; // is 1 For P = Q
	for($i=0; $i < count($A); $i++){
		
		$current = $A[$i];
		$previous = (isset($A[$i-1])) ? $A[$i-1] : null ;
		$before_previous = (isset($A[$i-2])) ? $A[$i-2] : null ;
		$next = (isset($A[$i+1])) ? $A[$i+1] : null ;
		$after_next = (isset($A[$i+2])) ? $A[$i+2] : null ;
		$before_P = (isset($A[$P-1])) ? $A[$P-1] : null ;
		$after_P = (isset($A[$P+1])) ? $A[$P+1] : null ;
		
		$flag_continue = true;
		$flag_last_element = false;

		$flag_check_before_previous = (is_null($before_previous))? false : true;
		$flag_check_previous = (is_null($previous))? false : true;
		$flag_check_next = (is_null($next))? false : true;
		$flag_check_after_next = (is_null($after_next))? false : true;
		$flagh_check_before_P = (is_null($before_P))? false : true;
		$flagh_check_after_P = (is_null($after_P))? false : true;


		if($flag_check_before_previous){
			if(!( $previous < $before_previous && $current > $previous) && !($previous > $before_previous && $current < $previous)){
				$flag_continue = false;
			}
		}
		if($flag_check_previous && $flag_check_next){
			if( !($previous < $current && $next < $current) && !($previous > $current && $next > $current)){
				$flag_continue = false;
			}
		}
		if($flag_check_after_next){
			if(!($next < $after_next && $current > $next) && !($next > $after_next && $current < $next)){
				$flag_continue = false;
			}
		}

		if(!$flag_check_next){
			$flag_last_element = true;
			$flag_continue = false;
		}


		if($flag_continue){
			$Q = $i;
			//var_dump('continue');
		}else{
			
			if($flag_check_previous && $flag_check_next){
				if( ($previous < $current && $next < $current) || ($previous > $current && $next > $current)){
					$Q = $i + 1;
				}
			}

			if($flagh_check_before_P && $flagh_check_after_P){
				if(($A[$P] > $before_P && $A[$P] > $after_P) || ($A[$P] < $before_P && $A[$P] < $after_P)){
					$P--;
				}
			}

			if($flag_last_element){
				$Q = $i;
			}

			$this_size = $Q - $P + 1;
			if($this_size > $largest_size){
				$largest_size = $this_size;
				//var_dump([$largest_size, $P, $Q, 'seeeeeeeeet']);
			}

			//var_dump('reset');
			$P = $i;
			$Q = $i;

		}		
	}

	return $largest_size;
	
}



