<div class="wrap">
	<form action="options.php" method="POST">
		<h1><?php echo \esc_html_e( 'Code Block Editor Settings', 'code-block-editor' ); ?></h1>
		<?php \settings_fields( 'code-block-editor' ); ?>
		<?php \do_settings_sections( 'code-block-editor' ); ?>
		<?php \submit_button(); ?>
	</form>
</div>