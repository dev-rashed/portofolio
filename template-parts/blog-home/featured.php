<?php

    $philosophy_featured_posts = new WP_Query( array(
        'posts_per_page' => 3,
        'meta_key'       => 'featured',
        'meta_value'     => '1'
    ));

    $post_data = [];
    while( $philosophy_featured_posts->have_posts() ) {
        $philosophy_featured_posts->the_post();
        $categories = get_the_category();
        $post_data[] = array(
            'title' => get_the_title(),
            'content' => get_the_content(),
            'thumbnail' => get_the_post_thumbnail_url( null, 'large' ),
            'permalink' => get_the_permalink(),
            'date' => get_the_date(),
            'author' => get_the_author('display_name'),
            'author_avatar' => get_avatar_url( get_the_author_meta( 'ID' ) ),
            'cat' => $categories[0]->name,
        );
    }

    if( $philosophy_featured_posts->post_count > 1 ) : 
        
?>

<div class="pageheader-content row">
    <div class="col-full">

        <div class="featured">

            <div class="featured__column featured__column--big">
                <div class="entry" style="background-image:url('<?php echo esc_url($post_data[0]['thumbnail']) ?>');">

                    <div class="entry__content">
                        <span class="entry__category"><a
                                href="#0"><?php echo esc_html($post_data[0]['cat']) ?></a></span>

                        <h1><a href="#0" title="">
                                <?php echo esc_html($post_data[0]['title']) ?>
                            </a></h1>

                        <div class="entry__info">
                            <a href="#0" class="entry__profile-pic">
                                <img class="avatar" src="<?php echo esc_url($post_data[0]['author_avatar']) ?>" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li><a href="#0"><?php echo esc_html($post_data[0]['author']) ?></a></li>
                                <li><?php echo esc_html($post_data[0]['date']) ?></li>
                            </ul>
                        </div>
                    </div> <!-- end entry__content -->

                </div> <!-- end entry -->
            </div> <!-- end featured__big -->

            <div class="featured__column featured__column--small">

                <?php for($i = 1; $i<3; $i++): ?>

                <div class="entry" style="background-image:url('<?php echo esc_url($post_data[$i]['thumbnail']) ?>');">

                    <div class="entry__content">
                        <span class="entry__category"><a
                                href="#0"><?php echo esc_html($post_data[$i]['cat']) ?></a></span>

                        <h1><a href="#0" title="">
                                <?php echo esc_html($post_data[$i]['title']) ?>
                            </a></h1>

                        <div class="entry__info">
                            <a href="#0" class="entry__profile-pic">
                                <img class="avatar" src="<?php echo esc_url($post_data[$i]['author_avatar']) ?>" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li><a href="#0"><?php echo esc_html($post_data[$i]['author']) ?></a></li>
                                <li><?php echo esc_html($post_data[$i]['date']) ?></li>
                            </ul>
                        </div>
                    </div> <!-- end entry__content -->

                </div> <!-- end entry -->

                <?php endfor; ?>
            </div> <!-- end featured__small -->
        </div> <!-- end featured -->

    </div> <!-- end col-full -->
</div> <!-- end pageheader-content row -->

<?php
endif;