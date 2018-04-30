<?php

extract( $atts );

$classes = array( $transform, $this->get_id() );

// qTRanslate-x
$active_name = $content = '';

if( function_exists( 'qtranxf_generateLanguageSelectCode' ) ) {

	global $q_config;

	$url = is_404() ? get_option('home') : '';

	foreach(qtranxf_getSortedLanguages() as $language) {
		$alt = $q_config['language_name'][$language] . '(' . $language . ')';
		$classes = array( 'lang-' . $language );

		if( $language == $q_config['language'] ) {
			$classes[]   = 'active';
			$active_name = $q_config['language_name'][$language];
		}

		$content .= sprintf(
			'<li class="%1$s"><a href="%2$s" class="qtranxs_text qtranxs_text_%3$s" hreflang="%3$s" title="%4$s">%5$s</a></li>',
			implode( ' ', $classes ),
			qtranxf_convertURL( $url, $language, false, true ),
			$language,
			$alt,
			$q_config['language_name'][$language]
		);
	}
}
// Polylang
elseif( function_exists( 'pll_the_languages' ) && PLL() instanceof PLL_Frontend ) {

	$switcher = new PLL_Switcher;
	$content = $switcher->the_languages( PLL()->links, array(
		'echo' => false
	) );

	$active_name = PLL()->links->curlang->name;
}
// WPML
elseif( function_exists( 'icl_get_languages' ) ) {
	$active_name = ICL_LANGUAGE_NAME;

	$languages = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );

	if( !empty( $languages ) ) {
		foreach( $languages as $language ) {
			if( ! $language['active'] ) {
				$content .= '<li><a href="' . esc_url( $language['url'] ) . '">' . $language['native_name'] . '</a></li>';
			}
		}
	}
}

// If no plugin add dummy content
if( ! $active_name ) {
	if( ! current_theme_supports( 'theme-demo' ) ) {
		return;
	}

	$active_name = 'US';
	$content .= '<li><a href="#">Spanish</a></li>';
	$content .= '<li><a href="#">French</a></li>';
	$content .= '<li><a href="#">Turkish</a></li>';
}

$this->generate_css();

?>
<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">
	<span class="module-trigger"><?php echo $active_name ?> <i class="fa fa-angle-down"></i></span>
	<div class="module-container">
		<ul class="dropdown-list">
			<?php echo $content ?>
		</ul>
	</div>
</div>