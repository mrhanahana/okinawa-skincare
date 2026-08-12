<?php $options = get_design_plus_option(); ?>
<div id="bread_crumb">

<?php
     // Clinic -----------------------
     if(is_singular('clinic')) {
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('clinic')); ?>"><span itemprop="name"><?php echo esc_html($options['clinic_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
</ul>
<?php
     // Service -----------------------
     } elseif(is_tax('service_category')) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $parent_id = $query_obj->parent;
       if($parent_id != 0){ // if is child category
         $category_data = get_term_by( 'id', $parent_id, 'service_category' );
         $parent_category_name = $category_data->name;
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><span itemprop="name"><?php echo esc_html($options['service_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_term_link($parent_id,'service_category')); ?>"><span itemprop="name"><?php echo esc_html($parent_category_name); ?></span></a><meta itemprop="position" content="3"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo single_cat_title("", false); ?></span><meta itemprop="position" content="4"></li>
</ul>
<?php } else { // if is parent category ?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><span itemprop="name"><?php echo esc_html($options['service_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo single_cat_title("", false); ?></span><meta itemprop="position" content="3"></li>
</ul>
<?php }; ?>
<?php
     // single page
     } elseif(is_singular('service')) {
        $category = get_the_terms( $post->ID, 'service_category' );
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><span itemprop="name"><?php echo esc_html($options['service_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if($category) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="category">
  <?php foreach ( $category as $cat ) : ?>
  <a itemprop="item" href="<?php echo esc_url(get_term_link($cat,'service_category')); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
  <?php endforeach; ?>
  <meta itemprop="position" content="3">
 </li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="4"></li>
</ul>
<?php
     // Staff -----------------------
     } elseif(is_singular('staff')) {
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('staff')); ?>"><span itemprop="name"><?php echo esc_html($options['staff_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
</ul>
<?php
     // Campaign -----------------------
     } elseif(is_tax('campaign_category')) {
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>"><span itemprop="name"><?php echo esc_html($options['campaign_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo single_cat_title("", false); ?></span><meta itemprop="position" content="3"></li>
</ul>
<?php
     } elseif(is_singular('campaign')) {
        $category = get_the_terms( $post->ID, 'campaign_category' );
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>"><span itemprop="name"><?php echo esc_html($options['campaign_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if($category) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="category">
  <?php foreach ( $category as $cat ) : ?>
  <a itemprop="item" href="<?php echo esc_url(get_term_link($cat,'campaign_category')); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
  <?php endforeach; ?>
  <meta itemprop="position" content="3">
 </li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="4"></li>
</ul>
<?php
     // FAQ -----------------------
     } elseif(is_post_type_archive('faq')) {
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['faq_label']); ?></span><meta itemprop="position" content="2"></li>
</ul>
<?php
     } elseif(is_tax('faq_category')) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $parent_id = $query_obj->parent;
       if($parent_id != 0){ // if is child category
         $category_data = get_term_by( 'id', $parent_id, 'faq_category' );
         $parent_category_name = $category_data->name;
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('faq')); ?>"><span itemprop="name"><?php echo esc_html($options['faq_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_term_link($parent_id,'faq_category')); ?>"><span itemprop="name"><?php echo esc_html($parent_category_name); ?></span></a><meta itemprop="position" content="3"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo single_cat_title("", false); ?></span><meta itemprop="position" content="4"></li>
</ul>
<?php } else { // if is parent category ?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('faq')); ?>"><span itemprop="name"><?php echo esc_html($options['faq_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo single_cat_title("", false); ?></span><meta itemprop="position" content="3"></li>
</ul>
<?php }; ?>
<?php
     // Column -----------------------
     } elseif(is_tax('column_category')) {
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('column')); ?>"><span itemprop="name"><?php echo esc_html($options['column_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo single_cat_title("", false); ?></span><meta itemprop="position" content="3"></li>
</ul>
<?php
     } elseif(is_singular('column')) {
        $category = get_the_terms( $post->ID, 'column_category' );
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('column')); ?>"><span itemprop="name"><?php echo esc_html($options['column_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if($category) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="category">
  <?php foreach ( $category as $cat ) : ?>
  <a itemprop="item" href="<?php echo esc_url(get_term_link($cat,'column_category')); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
  <?php endforeach; ?>
  <meta itemprop="position" content="3">
 </li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="4"></li>
</ul>

<?php
     } elseif(is_singular('learn')) {
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('learn')); ?>"><span itemprop="name"><?php echo esc_html($options['learn_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
</ul>
<?php
     // News -----------------------
     } elseif(is_post_type_archive('news')) {
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span><meta itemprop="position" content="2"></li>
</ul>
<?php } elseif(is_singular('news')) { ?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
</ul>
<?php
     // Search -----------------------
     } elseif(is_search()) {
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php _e('Search result','tcd-w'); ?></span><meta itemprop="position" content="2"></li>
</ul>
<?php
     // Category, Tag , Archive page -----------------------
     } elseif(is_category() || is_tag() || is_day() || is_month() || is_year() || is_author()) {
       if (is_category()) {
         $title = single_cat_title('', false);
       } elseif( is_tag() ) {
         $title = single_tag_title('', false);
       } elseif (is_day()) {
         $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F jS, Y', 'tcd-w')) );
       } elseif (is_month()) {
         $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F, Y', 'tcd-w')) );
       } elseif (is_year()) {
         $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('Y', 'tcd-w')) );
       } elseif (is_author()) {
         global $wp_query;
         $curauth = $wp_query->get_queried_object();
         $author_id = $curauth->ID;
         $user_data = get_userdata($author_id);
         $author_name = $user_data->display_name;
         $title = sprintf(__('Archive for %s', 'tcd-w'), $author_name);
       };
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="3"></li>
</ul>
<?php
     // Other page -----------------------
     } else {
     $category = get_the_category();
?>
<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
<!-- <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>-->
 <?php if($category) { ?>
 <li class="category" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
  <?php
       $count=1;
       foreach ($category as $cat) {
  ?>
  <a itemprop="item" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
  <?php $count++; } ?>
  <meta itemprop="position" content="3">
 </li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php { the_title_attribute(); }; ?></span><meta itemprop="position" content="4"></li>
</ul>
<?php }; ?>

</div>
