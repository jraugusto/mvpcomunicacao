<?php
/*
 * Blog
 */

$this->sections[] = array(
	'title'  => esc_html__( 'Blog', 'boo' ),
	'icon'   => 'el-icon-file-edit'
);

$this->sections[] = array(
	'title'      => esc_html__( 'General', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'blog-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Blog Title Bar', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to show the page title bar for the assigned blog page in "settings > reading" or blog archive pages.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'blog-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Page Title', 'boo' ),
			'subtitle' => esc_html__( 'Controls the title text that displays in the page title bar of the assigned blog page. This option only works if your front page displays your latest post in "settings > reading" or blog archive pages.', 'boo' ),
			'default'  => 'Blog'
		),

		array(
			'id'       => 'blog-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Page Subtitle', 'boo' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the page title bar of the assigned blog page. This option only works if your front page displays your latest post in "settings > reading" or blog archive pages.', 'boo' )
		),

		array(
			'id'      => 'blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'boo' ),
			'options' => array(
				'classic-image-large'        => esc_html__( 'Classic Image Large', 'boo' ),
				'classic-date-featured'      => esc_html__( 'Classic Date Featured', 'boo' ),
				'classic-image-medium'       => esc_html__( 'Classic Image Medium', 'boo' ),
				'classic-image-large-alt'    => esc_html__( 'Featured Large Image', 'boo' ),
				'classic-image-featured-alt' => esc_html__( 'Featured Classic Image', 'boo' ),
				'featured-post-sm'           => esc_html__( 'Featured Small Image', 'boo' ),
				'featured-posts'             => esc_html__( 'Featured posts', 'boo' ),
				'featured-posts-alt'         => esc_html__( 'Featured posts 2', 'boo' ),
				'grid'                       => esc_html__( 'Grid', 'boo' ),
				'masonry'                    => esc_html__( 'Masonry', 'boo' ),
				'masonry-creative'           => esc_html__( 'Masonry Creative', 'boo' ),
				'no-image'                   => esc_html__( 'No Image', 'boo' ),
				'puzzle'                     => esc_html__( 'Puzzle', 'boo' ),
				'split'                      => esc_html__( 'Split', 'boo' ),
				'classic-image-medium-alt'   => esc_html__( 'Split 2', 'boo' ),
				'timeline'                   => esc_html__( 'Timeline', 'boo' ),
				'featured-title'             => esc_html__( 'Title Featured', 'boo' ),
				'only-title'                 => esc_html__( 'Title Only', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select content type for your grid.', 'boo' ),
			'default'  => 'classic-date-featured'
		),

		array(
			'id'    => 'blog-enable-parallax',
			'type'  => 'select',
			'title' => esc_html__( 'Enable parallax?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Parallax for images', 'boo' ),
			'default'  => 'yes'
		),
		
		array(
			'id'    => 'blog-show-meta',
			'type'  => 'select',
			'title' => esc_html__( 'Show Meta?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select yes to show tags or categories on post thumbnail', 'boo' ),
			'default'  => 'yes'
		),

		array(
			'id'    => 'blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'boo' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'boo' ),
				'cats' => esc_html__( 'Categories', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select what to show on post thumbnail', 'boo' ),
			'default'  => 'tags',
			'required' => array(
				'blog-show-meta',
				'equals',
				'yes'
			)
		),
		
		array(
			'id'    => 'blog-one-category',
			'type'  => 'select',
			'title' => esc_html__( 'One category?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select yes to show one category in meta', 'boo' ),
			'default'  => 'yes',
			'required' => array(
				'blog-meta-type',
				'equals',
				'cats'
			)	
		),

		array(
			'id'       => 'blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Blog excerpt length', 'boo' ),
			'validate' => 'numeric',
			'default'  => '45',
		),

		array(
			'id'      => 'blog-pagination',
			'type'    => 'select',
			'title'   => esc_html__( 'Pagination Type', 'boo' ),
			'options' => array(
				'pagination' => esc_html__( 'Pagination', 'boo' ),
				'ajax1'      => esc_html__( 'Ajax 1', 'boo' ),
				'ajax2'      => esc_html__( 'Ajax 2', 'boo' ),
				'ajax3'      => esc_html__( 'Ajax 3', 'boo' ),
				'ajax4'      => esc_html__( 'Ajax 4', 'boo' ),
				'ajax5'      => esc_html__( 'Ajax 5', 'boo' ),
				'ajax6'      => esc_html__( 'Ajax 6', 'boo' )
			),
			'subtitle' => esc_html__( 'Select pagination style.', 'boo' ),
			'default'  => 'pagination'
		)
	)
);

//Category Archive Options
$this->sections[] = array(
	'title'      => esc_html__( 'Category Archive Page', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'category-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Category Archive Title Bar', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to show the category archive page title bar.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'category-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Category Archive Title', 'boo' ),
			'desc'     => esc_html__( 'Use shortcode [ra_category_title] to display the category title', 'boo' ),
			'subtitle' => esc_html__( 'Controls the title text that displays in the category archive page title bar.', 'boo' ),
			'default'  => 'Category: [ra_category_title]',
		),

		array(
			'id'       => 'category-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Category Archive Subtitle', 'boo' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the category archive page title bar.', 'boo' )
		),

		array(
			'id'      => 'category-blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'boo' ),
			'options' => array(
				'classic-image-large'        => esc_html__( 'Classic Image Large', 'boo' ),
				'classic-date-featured'      => esc_html__( 'Classic Date Featured', 'boo' ),
				'classic-image-medium'       => esc_html__( 'Classic Image Medium', 'boo' ),
				'classic-image-large-alt'    => esc_html__( 'Featured Large Image', 'boo' ),
				'classic-image-featured-alt' => esc_html__( 'Featured Classic Image', 'boo' ),
				'featured-post-sm'           => esc_html__( 'Featured Small Image', 'boo' ),
				'featured-posts'             => esc_html__( 'Featured posts', 'boo' ),
				'featured-posts-alt'         => esc_html__( 'Featured posts 2', 'boo' ),
				'grid'                       => esc_html__( 'Grid', 'boo' ),
				'masonry'                    => esc_html__( 'Masonry', 'boo' ),
				'masonry-creative'           => esc_html__( 'Masonry Creative', 'boo' ),
				'no-image'                   => esc_html__( 'No Image', 'boo' ),
				'puzzle'                     => esc_html__( 'Puzzle', 'boo' ),
				'split'                      => esc_html__( 'Split', 'boo' ),
				'classic-image-medium-alt'   => esc_html__( 'Split 2', 'boo' ),
				'timeline'                   => esc_html__( 'Timeline', 'boo' ),
				'featured-title'             => esc_html__( 'Title Featured', 'boo' ),
				'only-title'                 => esc_html__( 'Title Only', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select content type for your grid.', 'boo' ),
			'default'  => 'classic-date-featured'
		),

		array(
			'id'    => 'category-blog-enable-parallax',
			'type'  => 'select',
			'title' => esc_html__( 'Enable parallax?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Parallax for images', 'boo' ),
			'default'  => 'yes'
		),
		
		array(
			'id'    => 'category-blog-show-meta',
			'type'  => 'select',
			'title' => esc_html__( 'Show Meta?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select yes to show tags or categories on post thumbnail', 'boo' ),
			'default'  => 'yes'
		),

		array(
			'id'    => 'category-blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'boo' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'boo' ),
				'cats' => esc_html__( 'Categories', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select what to show on post thumbnail', 'boo' ),
			'default'  => 'tags',
			'required' => array(
				'blog-show-meta',
				'equals',
				'yes'
			)
		),
		
		array(
			'id'    => 'category-blog-one-category',
			'type'  => 'select',
			'title' => esc_html__( 'One category?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select yes to show one category in meta', 'boo' ),
			'default'  => 'yes',
			'required' => array(
				'blog-meta-type',
				'equals',
				'cats'
			)	
		),

		array(
			'id'       => 'category-blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Excerpt length', 'boo' ),
			'validate' => 'numeric',
			'default'  => '45',
		),
		
		array(
			'id'      => 'category-blog-pagination',
			'type'    => 'select',
			'title'   => esc_html__( 'Pagination Type', 'boo' ),
			'options' => array(
				'pagination' => esc_html__( 'Pagination', 'boo' ),
				'ajax1'      => esc_html__( 'Ajax 1', 'boo' ),
				'ajax2'      => esc_html__( 'Ajax 2', 'boo' ),
				'ajax3'      => esc_html__( 'Ajax 3', 'boo' ),
				'ajax4'      => esc_html__( 'Ajax 4', 'boo' ),
				'ajax5'      => esc_html__( 'Ajax 5', 'boo' ),
				'ajax6'      => esc_html__( 'Ajax 6', 'boo' )
			),
			'subtitle' => esc_html__( 'Select pagination style.', 'boo' ),
			'default'  => 'pagination'
		)

	)
);

//Tag Archive Options
$this->sections[] = array(
	'title'      => esc_html__( 'Tag Archive Page', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'tag-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Tag Archive Title Bar', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to show the Tag archive page title bar.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'tag-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Tag Archive Title', 'boo' ),
			'desc'     => esc_html__( 'Use shortcode [ra_tag_title] to display the tag title', 'boo' ),
			'subtitle' => esc_html__( 'Controls the title text that displays in the Tag archive page title bar.', 'boo' ),
			'default'  => 'Tag: [ra_tag_title]'
		),

		array(
			'id'       => 'tag-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Tag Archive Subtitle', 'boo' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the Tag archive page title bar.', 'boo' )
		),

		array(
			'id'      => 'tag-blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'boo' ),
			'options' => array(
				'classic-image-large'        => esc_html__( 'Classic Image Large', 'boo' ),
				'classic-date-featured'      => esc_html__( 'Classic Date Featured', 'boo' ),
				'classic-image-medium'       => esc_html__( 'Classic Image Medium', 'boo' ),
				'classic-image-large-alt'    => esc_html__( 'Featured Large Image', 'boo' ),
				'classic-image-featured-alt' => esc_html__( 'Featured Classic Image', 'boo' ),
				'featured-post-sm'           => esc_html__( 'Featured Small Image', 'boo' ),
				'featured-posts'             => esc_html__( 'Featured posts', 'boo' ),
				'featured-posts-alt'         => esc_html__( 'Featured posts 2', 'boo' ),
				'grid'                       => esc_html__( 'Grid', 'boo' ),
				'masonry'                    => esc_html__( 'Masonry', 'boo' ),
				'masonry-creative'           => esc_html__( 'Masonry Creative', 'boo' ),
				'no-image'                   => esc_html__( 'No Image', 'boo' ),
				'puzzle'                     => esc_html__( 'Puzzle', 'boo' ),
				'split'                      => esc_html__( 'Split', 'boo' ),
				'classic-image-medium-alt'   => esc_html__( 'Split 2', 'boo' ),
				'timeline'                   => esc_html__( 'Timeline', 'boo' ),
				'featured-title'             => esc_html__( 'Title Featured', 'boo' ),
				'only-title'                 => esc_html__( 'Title Only', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select content type for your grid.', 'boo' ),
			'default'  => 'classic-date-featured'
		),
		
		array(
			'id'    => 'tag-blog-enable-parallax',
			'type'  => 'select',
			'title' => esc_html__( 'Enable parallax?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Parallax for images', 'boo' ),
			'default'  => 'yes'
		),
		
		array(
			'id'    => 'tag-blog-show-meta',
			'type'  => 'select',
			'title' => esc_html__( 'Show Meta?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select yes to show tags or categories on post thumbnail', 'boo' ),
			'default'  => 'yes'
		),

		array(
			'id'    => 'tag-blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'boo' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'boo' ),
				'cats' => esc_html__( 'Categories', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select what to show on post thumbnail', 'boo' ),
			'default'  => 'tags',
			'required' => array(
				'blog-show-meta',
				'equals',
				'yes'
			)
		),
		
		array(
			'id'    => 'tag-blog-one-category',
			'type'  => 'select',
			'title' => esc_html__( 'One category?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select yes to show one category in meta', 'boo' ),
			'default'  => 'yes',
			'required' => array(
				'blog-meta-type',
				'equals',
				'cats'
			)	
		),

		array(
			'id'       => 'tag-blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Excerpt length', 'boo' ),
			'validate' => 'numeric',
			'default'  => '45',
		),
		
		array(
			'id'      => 'tag-blog-pagination',
			'type'    => 'select',
			'title'   => esc_html__( 'Pagination Type', 'boo' ),
			'options' => array(
				'pagination' => esc_html__( 'Pagination', 'boo' ),
				'ajax1'      => esc_html__( 'Ajax 1', 'boo' ),
				'ajax2'      => esc_html__( 'Ajax 2', 'boo' ),
				'ajax3'      => esc_html__( 'Ajax 3', 'boo' ),
				'ajax4'      => esc_html__( 'Ajax 4', 'boo' ),
				'ajax5'      => esc_html__( 'Ajax 5', 'boo' ),
				'ajax6'      => esc_html__( 'Ajax 6', 'boo' )
			),
			'subtitle' => esc_html__( 'Select pagination style.', 'boo' ),
			'default'  => 'pagination'
		)

	)
);

//Author Archive Options
$this->sections[] = array(
	'title'      => esc_html__( 'Author Archive Page', 'boo' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'author-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Author Archive Title Bar', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to show the Author archive page title bar.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'author-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Author Archive Title', 'boo' ),
			'desc'     => esc_html__( 'Use shortcode [ra_author] to display the author name', 'boo' ),
			'subtitle' => esc_html__( 'Controls the title text that displays in the Author archive page title bar.', 'boo' ),
			'default'  => 'Author: [ra_author]'
		),

		array(
			'id'       => 'author-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Author Archive Subtitle', 'boo' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the Author archive page title bar.', 'boo' )
		),

		array(
			'id'      => 'author-blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'boo' ),
			'options' => array(
				'classic-image-large'        => esc_html__( 'Classic Image Large', 'boo' ),
				'classic-date-featured'      => esc_html__( 'Classic Date Featured', 'boo' ),
				'classic-image-medium'       => esc_html__( 'Classic Image Medium', 'boo' ),
				'classic-image-large-alt'    => esc_html__( 'Featured Large Image', 'boo' ),
				'classic-image-featured-alt' => esc_html__( 'Featured Classic Image', 'boo' ),
				'featured-post-sm'           => esc_html__( 'Featured Small Image', 'boo' ),
				'featured-posts'             => esc_html__( 'Featured posts', 'boo' ),
				'featured-posts-alt'         => esc_html__( 'Featured posts 2', 'boo' ),
				'grid'                       => esc_html__( 'Grid', 'boo' ),
				'masonry'                    => esc_html__( 'Masonry', 'boo' ),
				'masonry-creative'           => esc_html__( 'Masonry Creative', 'boo' ),
				'no-image'                   => esc_html__( 'No Image', 'boo' ),
				'puzzle'                     => esc_html__( 'Puzzle', 'boo' ),
				'split'                      => esc_html__( 'Split', 'boo' ),
				'classic-image-medium-alt'   => esc_html__( 'Split 2', 'boo' ),
				'timeline'                   => esc_html__( 'Timeline', 'boo' ),
				'featured-title'             => esc_html__( 'Title Featured', 'boo' ),
				'only-title'                 => esc_html__( 'Title Only', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select content type for your grid.', 'boo' ),
			'default'  => 'classic-date-featured'
		),
		
		array(
			'id'    => 'author-blog-enable-parallax',
			'type'  => 'select',
			'title' => esc_html__( 'Enable parallax?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Parallax for images', 'boo' ),
			'default'  => 'yes'
		),
		
		array(
			'id'    => 'author-blog-show-meta',
			'type'  => 'select',
			'title' => esc_html__( 'Show Meta?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select yes to show tags or categories on post thumbnail', 'boo' ),
			'default'  => 'yes'
		),

		array(
			'id'    => 'author-blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'boo' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'boo' ),
				'cats' => esc_html__( 'Categories', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select what to show on post thumbnail', 'boo' ),
			'default'  => 'tags',
			'required' => array(
				'blog-show-meta',
				'equals',
				'yes'
			)
		),
		
		array(
			'id'    => 'author-blog-one-category',
			'type'  => 'select',
			'title' => esc_html__( 'One category?', 'boo' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'boo' ),
				'no' => esc_html__( 'No', 'boo' ),
			),
			'subtitle' => esc_html__( 'Select yes to show one category in meta', 'boo' ),
			'default'  => 'yes',
			'required' => array(
				'blog-meta-type',
				'equals',
				'cats'
			)	
		),

		array(
			'id'       => 'author-blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Excerpt length', 'boo' ),
			'validate' => 'numeric',
			'default'  => '45',
		),
		
		array(
			'id'      => 'author-blog-pagination',
			'type'    => 'select',
			'title'   => esc_html__( 'Pagination Type', 'boo' ),
			'options' => array(
				'pagination' => esc_html__( 'Pagination', 'boo' ),
				'ajax1'      => esc_html__( 'Ajax 1', 'boo' ),
				'ajax2'      => esc_html__( 'Ajax 2', 'boo' ),
				'ajax3'      => esc_html__( 'Ajax 3', 'boo' ),
				'ajax4'      => esc_html__( 'Ajax 4', 'boo' ),
				'ajax5'      => esc_html__( 'Ajax 5', 'boo' ),
				'ajax6'      => esc_html__( 'Ajax 6', 'boo' )
			),
			'subtitle' => esc_html__( 'Select pagination style.', 'boo' ),
			'default'  => 'pagination'
		)

	)
);

$this->sections[] = array(
	'title'      => esc_html__('Single Post', 'boo'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'      => 'post-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'boo' ),
			'options' => array(
				'default' => esc_html__( 'Default', 'boo' ),
				'cover'   => esc_html__( 'Cover', 'boo' ),
				'minimal' => esc_html__( 'Minimal', 'boo' )
			),
			'default' => 'default'
		),
		
		array(
			'id'       => 'post-parallax-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Parallax', 'boo' ),
			'subtitle' => esc_html__( 'Turn on parallax effect on post cover image', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'required' => array(
				'post-style',
				'equals',
				'cover'
			),
		),
		
		array(
			'id'              => 'single_typography',
			'title'           => esc_html__( 'Single Post Heading Typography', 'boo' ),
			'subtitle'        => esc_html__( 'These settings control the typography for the single post headings', 'boo' ),
			'type'            => 'typography',
			'letter-spacing'  => true,
			'text-align'      => false,
			'compiler'        => true,
			'units'           => '%',
		),

		array(
			'id'       => 'post-likes-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Like Button', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display the like button on single posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'post-social-box-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Social Sharing Box', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display the social sharing box on single posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),
		
		array(
			'id'       => 'post-floated-box-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Social Floated Box', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display the social floated sharing box on single posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'off'
		),

		array(
			'id'       => 'post-author-box-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Author Info Box', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display the author info box below posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'post-navigation-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Previous/Next Pagination', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display the previous/next post pagination for single posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'post-related-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Related Projects', 'boo' ),
			'subtitle' => esc_html__( 'Turn on to display related projects on single posts.', 'boo' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'boo' ),
				'off'  => esc_html__( 'Off', 'boo' )
			),
			'default'  => 'on'
		),

		array(
			'type'     => 'text',
			'id'       => 'post-related-title',
			'title'    => esc_html__( 'Related Project Title', 'boo' ),
			'default'  => 'You may also like',
			'required' => array(
				'post-related-enable',
				'equals',
				'on'
			)
		),

		array(
			'type'     => 'slider',
			'id'       => 'post-related-number',
			'title'    => esc_html__( 'Number of Related Projects', 'boo' ),
			'subtitle' => esc_html__( 'Controls the number of posts that display under related posts section.', 'boo' ),
			'default'  => 2,
			'max'      => 100,
			'required' => array(
				'post-related-enable',
				'equals',
				'on'
			)
		)
	)
);