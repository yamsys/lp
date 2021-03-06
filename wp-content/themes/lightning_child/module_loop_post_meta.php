
<div class="entry-meta">
<span class="published entry-meta_items"><?php echo esc_html( get_the_date() ); ?></span>

<?php global $lightning_theme_options; ?>

<?php
// Post update
$meta_hidden_update = ( isset($lightning_theme_options['postUpdate_hidden']) && $lightning_theme_options['postUpdate_hidden'] ) ? ' entry-meta_hidden' : ''; ?>

<span class="entry-meta_items entry-meta_updated<?php echo $meta_hidden_update;?>">/ <?php _e('Last updated','lightning'); ?> : <span class="updated"><?php the_modified_date('') ?></span></span>
<?php
	$taxonomies = get_the_taxonomies();
	if ($taxonomies):
		// get $taxonomy name
		$taxonomy = key( $taxonomies );
		$terms  = get_the_terms( get_the_ID(),$taxonomy );
		$term_url	= esc_url(get_term_link( $terms[0]->term_id,$taxonomy));
		$term_name	= esc_html($terms[0]->name);
		$term_color = '';
		if ( class_exists( 'Vk_term_color' ) ) {
				$term_color = Vk_term_color::get_term_color( $terms[0]->term_id );
				$term_color = ( $term_color ) ? ' style="background-color:'.$term_color.';border:none;"': '';
			}
		echo '<span class="entry-meta_items entry-meta_items_term"><a href="'.$term_url.'" class="btn btn-xs btn-primary"'.$term_color.'>'.$term_name.'</a></span>';
	endif;
?>

</div>
