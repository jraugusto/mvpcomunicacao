<?php 

extract( $atts );
// Enqueue Conditional Script
$this->scripts();
$img = $poster ? rella_get_image( $poster, 'full' ) : '';
if( is_array( $img ) && !empty( $img['url'] ) ) {
	$img = $img['url'];
}

$vheight = ! empty( $height ) ? $height : '200px';

?>

<video controls="controls" poster="<?php echo esc_url( $img ); ?>" title="<?php echo esc_attr( $title ); ?>" height="<?php echo esc_attr( $vheight ); ?>">

	<?php $this->get_source_video( $video_mp4_url ); ?>
	<?php $this->get_source_video( $video_url_ogg, 'video/ogg' ); ?>
	<?php $this->get_source_video( $video_url_webm, 'video/webm' ); ?>
	<?php $this->get_fallback(); ?>

</video>