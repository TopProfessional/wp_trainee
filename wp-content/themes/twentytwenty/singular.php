<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" role="main">

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

	?>

</main><!-- #site-content -->
<div class="custom">
	<?php
	if(function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar2')):else: ?>

<li id="calendar">
        <h2>
          <?php _e('Calendar'); ?>
        </h2>
        <?php get_calendar(); ?>
      </li>
      <?php wp_list_pages('title_li=<h2>Pages</h2>'); ?>
      <li>
        <h2>
          <?php _e('Categories'); ?>
        </h2>
        <ul>
          <?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
        </ul>
      </li>
      <li>
        <h2>
          <?php _e('Archives'); ?>
        </h2>
        <ul>
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
      </li>
      <?php get_links_list(); ?>
      <li>
        <h2>
          <?php _e('Meta'); ?>
        </h2>
        <ul>
          <?php wp_register(); ?>
          <li>
            <?php wp_loginout(); ?>
          </li>
          <?php wp_meta(); ?>
        </ul>
      </li>
      <?php endif; ?>
    </ul>

</div>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
