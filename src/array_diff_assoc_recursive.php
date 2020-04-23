<?php
/**
 * Recursively get the differences between two arrays
 * @param  (array) $array1 The new array to get difference for
 * @param  (array) $array2 Existing array to check on
 * @return (array) The differences between the two arrays which is taken from the first array.
 */
function array_diff_assoc_recursive( array $array1, array $array2 )
{
    $difference = array();
    foreach ( $array1 as $key => $value )
    {
        if ( is_array( $value ) ) {
            if ( !isset( $array2[ $key ] ) || !is_array( $array2[ $key ] ) ) {
                $difference[ $key ] = $value;
            }
            else {
                $new_diff = array_diff_assoc_recursive( $value, $array2[ $key ] );
                if ( !empty( $new_diff ) )
                    $difference[ $key ] = $new_diff;
            }
        }
        elseif ( !array_key_exists( $key, $array2 ) || $array2[ $key ] !== $value ) {
            $difference[ $key ] = $value;
        }
    }
    return $difference;
}