<?php
add_action( 'woocommerce_register_form_start', 'custom_register_fields' );
function custom_register_fields() {?>
    <p class="form-row form-row-wide">
        <label for="skype"><?php _e( 'Skype', TEXTDOMAIN ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="skype" id="skype" value="<?= !empty( $_POST['skype'] ) ? esc_attr( $_POST['skype'] ) : ''; ?>" />
    </p>
    <div class="clear"></div>
	<?php
}

add_action( 'woocommerce_register_post', 'validate_extra_register_fields', 10, 3 );
function validate_extra_register_fields( $username, $email, $validation_errors ) {

	if ( isset( $_POST['skype'] ) && empty( $_POST['skype'] ) ) {
		$validation_errors->add( 'skype_error', __( 'Skype account is required!', TEXTDOMAIN ) );
	}

	return $validation_errors;
}

add_action( 'show_user_profile', 'custom_profile_fields' );
add_action( 'edit_user_profile', 'custom_profile_fields' );
function custom_profile_fields( $user ) { ?>
    <table class="form-table">
        <tr>
            <th><label for="address"><?php _e("Skype"); ?></label></th>
            <td>
                <input type="text" name="skype" id="skype" value="<?php echo esc_attr( get_the_author_meta( 'skype', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_custom_profile_fields' );
add_action( 'edit_user_profile_update', 'save_custom_profile_fields' );
function save_custom_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
	update_user_meta( $user_id, 'skype', $_POST['skype'] );
}

add_action( 'woocommerce_created_customer', 'save_custom_register_fields' );
function save_custom_register_fields( $customer_id ) {
	if ( isset( $_POST['skype'] ) ) {
		update_user_meta( $customer_id, 'skype', sanitize_text_field( $_POST['skype'] ) );
	}
}