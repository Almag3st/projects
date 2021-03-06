<?php
/*
    Template Name: Constituent Services
 */
$header_image = get_field('header_image');
get_header();
?>

<div id="home" class="container-fluid">
<div class="row headerImage align-items-center" style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.4) 15%, rgba(0, 0, 0, 0.8) 100%), url('<?php echo $header_image ?>');">
    <div class="col-12 headerImageText">
                <h1 class="text-center"><?php the_title(); ?></h1>
            </div>
    </div>
<div class="container-fluid resc">
    <div class="row">
        <div class="col-md-1"></div>
        <div id="rescCScontainer" class="col-12 col-md-10 col-sm-12  ">
            <div class="row legicontent">
                

<?php $loop = new WP_Query( array( 'post_type' => 'constituent_services', 'orderby' => 'post_id', 'order' => 'ASC')); ?>				    
					<?php while ( $loop-> have_posts() ) : $loop->the_post();  
                            $thumbnailUrl = wp_get_attachment_url( get_post_thumbnail_id( $post-> ID));
                            ?>
                            <div class="col-12 col-md-6">
<div class="card mb-4 resource-CS-card">
  <div class="row g-0">
    <div class="col-md-4">
    <a href="<?php echo get_permalink()?>"> <img src="<?php echo $thumbnailUrl ?>" class=" img-card-CS" alt="..."></a>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title resource-CS-title"><a href="<?php echo get_permalink()?>"> <?php the_title(); ?></a></h5>
        <p class="card-text resource-CS-text"><?php the_excerpt(); ?></p>
      </div>
    </div>
  </div>
</div>
</div>
                        <?php endwhile;  wp_reset_query();?>


                <div class="row">
                    <div class="col-12"> 
                </div>       
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2"></div>
    </div>
</div>

</div>



<?php
get_footer();
?>