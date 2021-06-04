<?php

$contents = file_get_contents( 'input.txt' );

preg_match_all( '~\n(\d{6})\n.*~', $contents, $matches );

$workouts = array();

$num_matches = count( $matches[1] );
foreach ( $matches[1] as $i => $date ) {
	$pos = strpos( $contents, $date ) + 7;
	if ( ( $i + 1 ) < $num_matches ) {
		$len = strpos( $contents, $matches[1][ $i + 1 ] ) - $pos;
		$workout = substr( $contents, $pos, $len );
	} else {
		$workout = substr( $contents, $pos );
	}

	$workout = str_replace( "\n\n\n", "\n", $workout );
	$workout = str_replace( "\n\n", "\n", $workout );

	$workouts[ $date ] = $workout;
}

ksort( $workouts );

foreach ( $workouts as $date => $workout ) {
	echo "\n## $date\n$workout";
}
