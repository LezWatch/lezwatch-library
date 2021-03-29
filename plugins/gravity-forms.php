<?php
/*
Library: Gravity Forms Add Ons
Description: Addons for Gravity Forms
Version: 1.0

Source: https://docs.gravityforms.com/gform_entry_is_spam/
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

// Bail early if Gravity Forms isn't active.
if ( ! class_exists( 'GFForms' ) ) {
	return;
}

/**
 * class LP_GravityForms_Addons
 *
 * Customize Gravity Forms
 *
 * @since 1.0
 */
class LP_GravityForms_Addons {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Check the 'Suggest an Edit' form for spam.
		add_action( 'gform_entry_is_spam_1', array( $this, 'gform_entry_is_spam_1' ), 10, 3 );
	}

	/**
	 * Mark as spam
	 *
	 * If someone on our block-list emails, auto-mark as spam becuase we do
	 * not want to hear from them, but we don't want them to know they were rejected
	 * and thus encourage them to try other methods. Aren't assholes fun?
	 *
	 * @param  boolean  $is_spam  -- Is this already spam or not?
	 * @param  [type]  $form    [description]
	 * @param  [type]  $entry   [description]
	 * @return boolean                    [description]
	 */
	public function gform_entry_is_spam_1( $is_spam, $form, $entry ) {

		// If this is already spam, we're gonna return and be done.
		if ( $is_spam ) {
			return $is_spam;
		}

		// Email is field 2.
		$email = rgar( $entry, '2' );

		// Get a true/falsy
		$is_spammer = LP_Find_Spammers::is_spammer( $email );
		if ( $is_spammer ) {
			return true;
		}

		// If we got all the way down here, we're not spam!
		return false;
	}
}

new LP_GravityForms_Addons();
