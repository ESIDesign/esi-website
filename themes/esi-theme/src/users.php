<?php

// This adds the custom 'leadership' checkbox to the userfield, which we will then sort in the page-people.php file

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>


	<h3>Additional</h3>

	<table class="form-table">

		<tr>
			<th><label for="leadership">Leadership Role</label></th>

			<td>
	  <input type="radio" name="leadership" value="Yes" id="leadership" <?php if  ( get_the_author_meta('leadership', $user->ID) == 'Yes' ) echo 'checked="checked"'; ?> />Yes<br/><br/>
				<input type="radio" name="leadership" value="No" id="leadership" <?php if ( get_the_author_meta('leadership', $user->ID) == 'No' ) echo 'checked="checked"'; ?> />No<br />
				<span class="description">Please let us know if you're in a leadership position.</span>
			</td>
		</tr>


		<tr>
			<th><label for="leadership">Leadership Value</label></th>

			<td>
	  		<input type="number" name="leadership_val" id="leadership_val" value="<?php echo esc_attr( get_the_author_meta( 'leadership_val', $user->ID ) ); ?>" />
				<span class="description">Please enter the display value you'd like to be shown in.</span>
			</td>
		</tr>


		<tr>
			<th><label for="leadership">Hide User</label></th>

			<td>
	  <input type="radio" name="hidden" value="Yes" id="hidden" <?php if  ( get_the_author_meta('hidden', $user->ID) == 'Yes' ) echo 'checked="checked"'; ?> />Yes<br/><br/>
				<input type="radio" name="hidden" value="No" id="hidden" <?php if ( get_the_author_meta('hidden', $user->ID) != 'Yes' ) echo 'checked="checked"'; ?> />No<br />
				<span class="description">Should this user be hidden.</span>
			</td>
		</tr>

		<tr>
			<th><label for="leadership">Position</label></th>

			<td>
				<input type="text" name="position" id="position" value="<?php echo esc_attr( get_the_author_meta( 'position', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your position.</span>

			</td>
		</tr>


		<tr>
			<th><label for="twitter">Twitter</label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your twitter.</span>

			</td>
		</tr>


		<tr>
			<th><label for="instagram">Instagram</label></th>

			<td>
				<input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your instagram.</span>

			</td>
		</tr>


		<tr>
			<th><label for="linkedin">LinkedIn</label></th>

			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your LinkedIn</span>

			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'leadership', $_POST['leadership'] );
	update_usermeta( $user_id, 'leadership_val', $_POST['leadership_val'] );
	update_usermeta( $user_id, 'hidden', $_POST['hidden'] );
	update_usermeta( $user_id, 'instagram', $_POST['instagram'] );
	update_usermeta( $user_id, 'position', $_POST['position'] );
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
	update_usermeta( $user_id, 'linkedin', $_POST['linkedin'] );
  unset($contact_methods['aim']);
}

function remove_personal_options(){
  echo '<script type="text/javascript">jQuery(document).ready(function($) {
  $(\'form#your-profile tr.user-description-wrap\').remove(); // remove the "Biographical Info" field
  });</script><style>form#your-profile tr.user-description-wrap {display:none;}</style>';
}

add_action('admin_head','remove_personal_options');
