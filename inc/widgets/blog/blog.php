<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'hmd_elementor_blog_template' ) ) {

	function hmd_elementor_blog_template( $settings ) {
		$default_settings = [
			// General.
			'post_type'             => 'post',

			// Query.
			'first_items_per_page'  => 1,
			'second_items_per_page' => 3,
			'include'               => '',
			'taxonomies'            => '',
			'offset'                => '',
			'orderby'               => 'date',
			'order'                 => 'DESC',
			'meta_key'              => '',
			'exclude'               => '',
		];

		$settings = wp_parse_args( $settings, $default_settings );

		// First Post
		$first_query_args = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $settings['first_items_per_page'],
		];

		if ( $settings['orderby'] ) {
			$first_query_args['orderby'] = $settings['orderby'];
		}

		if ( $settings['order'] ) {
			$first_query_args['order'] = $settings['order'];
		}

		$first_post = new WP_Query( $first_query_args );

		// Second Post
		$second_query_args = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $settings['second_items_per_page'],
			'offset'         => $settings['first_items_per_page']
		];

		if ( $settings['orderby'] ) {
			$second_query_args['orderby'] = $settings['orderby'];
		}

		if ( $settings['order'] ) {
			$second_query_args['order'] = $settings['order'];
		}

		$second_post = new WP_Query( $second_query_args );

		?>

        <div class="flex max-sm:flex-col max-sm:!h-auto gap-3 hmd-container-height">
			<?php
			// The Loop
			if ( $first_post->have_posts() ) :
				while ( $first_post->have_posts() ) : $first_post->the_post();
					$categories = get_the_category();
					?>
                    <article class="h-full bg-red-400 flex-1 overflow-hidden hmd-border-radius relative group">
                        <div class="absolute z-10 top-2.5 right-2.5 bg-white inline-block min-w-14 leading-none text-center">
                            <span class="block pb-0.5 pt-2 text-[24px]"><?php echo get_the_date( 'd' ); ?></span>
                            <span class="block pt-0.5 pb-2 text-[12px]"><?php echo get_the_date( 'M' ); ?></span>
                        </div>
                        <a class="block h-full w-full group-hover:scale-110 ease-in-out duration-700 before:w-full before:h-full before:absolute before:bg-gradient-to-b before:from-transparent via-[rgba(0,0,0,0.35)] before:to-[rgba(0,0,0,0.8)]"
                           href="<?php echo get_the_permalink(); ?>">
		                    <?php the_post_thumbnail( 'large', [ 'class' => '!h-full !w-full object-cover' ] ); ?>
                        </a>
                        <div class="absolute bottom-0 hmd-second-p pb-6 inset-x-0 left-0">
		                    <?php
		                    if ( ! empty( $categories ) ) {
			                    echo '<ul class="flex gap-3 p-0 hmd-mb list-none">';
			                    foreach ( $categories as $category ) {
				                    echo '<li class="hmd-category m-0"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">';
				                    echo esc_html( $category->name );
				                    echo '</a></li>';
			                    }
			                    echo '</ul>';
		                    }
		                    ?>
                            <h3 class="hmd-mb">
                                <a href="<?php echo get_the_permalink(); ?>">
				                    <?php echo the_title(); ?>
                                </a>
                            </h3>
                        </div>
                    </article>
				<?php endwhile;
			endif;

			// Restore original Post Data
			wp_reset_postdata();
			?>

            <div class="flex flex-1 flex-wrap flex-row gap-3">
				<?php
				// The Loop
				if ( $second_post->have_posts() ) :
					$post_count = 0;
					while ( $second_post->have_posts() ) : $second_post->the_post();
						$post_count ++;

						$categories = get_the_category();
						?>
						<?php if ( $post_count == 1 ): ?>

                            <article
                                    class="basis-full relative h-2/4 bg-red-200 overflow-hidden hmd-border-radius group max-sm:h-48">
                                <div class="absolute z-10 top-2.5 right-2.5 bg-white inline-block min-w-14 leading-none text-center">
                                    <span class="block pb-0.5 pt-2 text-[24px]"><?php echo get_the_date( 'd' ); ?></span>
                                    <span class="block pt-0.5 pb-2 text-[12px]"><?php echo get_the_date( 'M' ); ?></span>
                                </div>
                                <a class="block h-full w-full group-hover:scale-110 ease-in-out duration-700 before:w-full before:h-full before:absolute before:bg-gradient-to-b before:from-transparent via-[rgba(0,0,0,0.35)] before:to-[rgba(0,0,0,0.8)]"
                                   href="<?php echo get_the_permalink(); ?>">
		                            <?php the_post_thumbnail( 'large', [ 'class' => '!h-full !w-full object-cover' ] ); ?>
                                </a>
                                <div class="absolute bottom-0 hmd-second-p pb-6 inset-x-0 left-0">
		                            <?php
		                            if ( ! empty( $categories ) ) {
			                            echo '<ul class="flex gap-3 p-0 hmd-mb list-none">';
			                            foreach ( $categories as $category ) {
				                            echo '<li class="hmd-category m-0"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">';
				                            echo esc_html( $category->name );
				                            echo '</a></li>';
			                            }
			                            echo '</ul>';
		                            }
		                            ?>
                                    <h3 class="hmd-mb">
                                        <a href="<?php echo get_the_permalink(); ?>">
				                            <?php echo the_title(); ?>
                                        </a>
                                    </h3>
                                </div>
                            </article>

						<?php else: ?>

                            <article
                                    class="flex-1 relative h-[48%] overflow-hidden bg-black hmd-border-radius group max-sm:h-48">
                                <div class="absolute z-10 top-2.5 right-2.5 bg-white inline-block min-w-14 leading-none text-center">
                                    <span class="block pb-0.5 pt-2 text-[24px]"><?php echo get_the_date( 'd' ); ?></span>
                                    <span class="block pt-0.5 pb-2 text-[12px]"><?php echo get_the_date( 'M' ); ?></span>
                                </div>
                                <a class="block h-full w-full group-hover:scale-110 ease-in-out duration-700 before:w-full before:h-full before:absolute before:bg-gradient-to-b before:from-transparent via-[rgba(0,0,0,0.35)] before:to-[rgba(0,0,0,0.8)]"
                                   href="<?php echo get_the_permalink(); ?>">
									<?php the_post_thumbnail( 'large', [ 'class' => '!h-full !w-full object-cover' ] ); ?>
                                </a>
                                <div class="absolute bottom-0 hmd-second-p pb-6 inset-x-0 left-0">
									<?php
									if ( ! empty( $categories ) ) {
										echo '<ul class="flex gap-3 p-0 hmd-mb list-none max-sm:hidden">';
										foreach ( $categories as $category ) {
											echo '<li class="hmd-category m-0"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">';
											echo esc_html( $category->name );
											echo '</a></li>';
										}
										echo '</ul>';
									}
									?>
                                    <h3 class="hmd-mb">
                                        <a href="<?php echo get_the_permalink(); ?>">
											<?php echo the_title(); ?>
                                        </a>
                                    </h3>
                                </div>
                            </article>

						<?php endif; ?>
					<?php endwhile;
				endif;

				// Restore original Post Data
				wp_reset_postdata();
				?>
            </div>

        </div>

		<?php
	}
}