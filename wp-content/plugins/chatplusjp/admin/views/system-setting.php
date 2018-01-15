<?php
		if ( !current_user_can('level_5') ){
			echo '<div class="wrap"><div id="message" class="updated below-h2"><p>'. _e('You do not have permission.', 'cpj') .'</p></div></div>';
			return;
		}
?>
		<div class="wrap">
			<div class="cpj-admin">
				<div class="cpj-system-setting-page">
					<h2><?php _e('設定', 'cpj'); ?></h2>
					<div class="cpj-<?php esc_attr_e($status); ?> message-area">
						<p><?php esc_html_e($message); ?></p>
						<?php $this->error_message_e($error_message); ?>
					</div>
					<div>
						<form id="system-setting-form" method="post" action="<?php echo add_query_arg( array( 'action' => 'up' ) ); ?>">
							<div>1.ChatPlusに登録してください。 <a href="https://app.chatplus.jp/account/signup" target="_blank"><input class="button button-primary" type="button" value="<?php _e('新規登録', 'cpj'); ?>"></a></div>
							<div>
								2.サイトコードを登録してください。
								<div>
									<input type="text" name="sitecode" id="sitecode" value="<?php echo esc_attr( $cpj_system_setting['sitecode'] ); ?>">
									<input name="cpj_save" id="cpj_save" type="submit" class="button button-primary" value="<?php _e('保存','cpj'); ?>" />
								</div>
								※サイトコードとは、ChatPlusに登録すると、表示されるd["__cp_c"]="xxxxxxxxxx"; というコードです。<br />
								詳しくは、ログインした後、<br />
								https://app.chatplus.jp/admin/cp/general-script<br />
								ページから確認することができます。
							</div>
							<div>
								3.ログインするとチャットできます。 <a href="https://app.chatplus.jp/login" target="_blank"><input class="button button-primary" type="button" value="<?php _e('ログイン', 'cpj'); ?>"></a>
							</div>
							<input type="hidden" name="page" value="<?php echo esc_attr( $_REQUEST['page'] ); ?>" />
							<?php wp_nonce_field( 'cpj_setting', 'cpj_nonce' ); ?>

						</form>
					</div>
				</div>
			</div>
		</div>
