<?php
global $class;

$is_group_single_doc = '';
if ( function_exists('bp_docs_is_doc_edit') ) {
	$is_group_single_doc = ( bp_docs_is_doc_edit() || bp_docs_is_doc_read() || bp_docs_is_doc_create() || bp_docs_is_doc_history() ) &&  bp_doc_single_group_id(false) ;
}
if( $is_group_single_doc )
    $class .= ' group-single';
?>

<!-- if widgets are loaded for any BuddyPress component, display the BuddyPress sidebar -->
	<?php if (
		( is_active_sidebar('members') && bp_is_current_component( 'members' ) && !bp_is_user() ) ||
		( is_active_sidebar('profile') && bp_is_user() ) ||
		( is_active_sidebar('groups') && bp_is_current_component( 'groups' ) && !bp_is_group() && !bp_is_user() ) ||
		( is_active_sidebar('group') && bp_is_group() ) ||
		( is_active_sidebar('activity') && bp_is_current_component( 'activity' ) && !bp_is_user() ) ||
		( is_active_sidebar('blogs') && is_multisite() && bp_is_current_component( 'blogs' ) && !bp_is_user() ) ||
		( is_active_sidebar('forums') && bp_is_current_component( 'forums' ) && !bp_is_user() )||
        ( $is_group_single_doc )
	):
	?>
		<div class="page-right-sidebar <?php echo $class; ?>">

	<!-- if not, hide the sidebar -->
	<?php else: ?>
		<div class="page-full-width <?php echo $class; ?>">
	<?php endif; ?>

            <?php  if( $is_group_single_doc ):?>
                        <?php while ( have_posts() ): the_post(); ?>
                        	
							<?php the_content(); ?>
							
                        <?php endwhile; // end of the loop. ?>
            <?php else: ?>
			<!-- BuddyPress template content -->
			<div id="primary" class="site-content">

					<div id="content" role="main">

						<article>
						<?php while ( have_posts() ): the_post(); ?>
							<?php get_template_part( 'content', 'buddypress' ); ?>
							<?php comments_template( '', true ); ?>
						<?php endwhile; // end of the loop. ?>
						</article>

					</div><!-- #content -->

			</div><!-- #primary -->

			<?php get_sidebar('buddypress'); ?>

		</div><!-- closing div -->
        <?php endif; ?>