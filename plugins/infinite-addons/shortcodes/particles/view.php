<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

?>
<div class="particles-contaienr">

	<?php $this->get_items() ?>	

</div><!-- /.particles -->