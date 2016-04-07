<?php global $brainwave; ?>
<script type="text/javascript">
	<?php
	if ( ! empty( $brainwave['custom_js'] ) ) {
		echo $brainwave['custom_js'];
	}
	if ( ! empty( $brainwave['spinner-type'] ) ) {
		if ( $brainwave['spinner-type'] == 'custom' ) {
			if ( ! empty( $brainwave['custom_spinner_js'] ) ) {
				echo $brainwave['custom_spinner_js'];
			}
		}
	}
	?>
</script>
