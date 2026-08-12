<?php
/*
Template Name:page clinic
*/
__( 'No side content', 'tcd-w' );
?>
<?php
get_header();
$options = get_design_plus_option();
$page_title_color = get_post_meta( $post->ID, 'page_title_color', true );
$image_id = get_post_meta( $post->ID, 'page_bg_image', true );
if ( $image_id ) {
  $image = wp_get_attachment_image_src( $image_id, 'full' );
  if ( is_mobile() ) {
    $image_mobile_id = get_post_meta( $post->ID, 'page_bg_image_mobile', true );
    if ( $image_mobile_id ) {
      $image = wp_get_attachment_image_src( $image_mobile_id, 'full' );
    };
  }
}
$page_bg_color = get_post_meta( $post->ID, 'page_bg_color', true );
$use_overlay = get_post_meta( $post->ID, 'page_use_overlay', true );
if ( $use_overlay ) {
  $page_overlay_color = get_post_meta( $post->ID, 'page_overlay_color', true );
  if ( $page_overlay_color ) {
    $overlay_color = hex2rgb( $page_overlay_color );
    $overlay_color = implode( ",", $overlay_color );
    $overlay_opacity = get_post_meta( $post->ID, 'page_overlay_opacity', true );
  };
}
if ( $image_id ) {
  ?>
<div id="page_header" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;">
<?php } else { ?>
<div id="page_header" style="background:<?php echo esc_attr($page_bg_color); ?>">
  <?php }; ?>
  <div id="page_header_inner">
    <div id="page_header_catch">
      <div class="catch rich_font" style="color:<?php echo esc_html($page_title_color); ?>;">
        <?php the_title(); ?>
      </div>
    </div>
  </div>
  <?php if($use_overlay && $page_overlay_color && $overlay_opacity) { ?>
  <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
  <?php }; ?>
</div>
<?php get_template_part('template-parts/breadcrumb'); ?>
<div id="clinic" class="fullwidth">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="article" class="clearfix">
<?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
<div class="post_content clearfix">
  <section class="page-header chapter_child" id="doctor">
    <div class="title">
      <div class="h2 rich_font" data-before="DOCTOR">医師紹介</div>
    </div>
  </section>
  <section class="doc-eyecatch">
    <div class="content">
      <div class="image_area"><img src="https://okinawa-skincare.com/wp-content/uploads/2023/12/img_y.maeda_.jpg" alt="前田 由紀" width="400" height="533" class="aligncenter size-full" /></div>
      <div class="title_area">
        <div class="title rich_font">
          <h3>院長<span>前田　由紀</span></h3>
        </div>
        <p class="m10">「見た目」は、単なる整容にとどまらず、心も整えてくれる大切な要素といえます。にきびや肌荒れといった肌トラブルからエイジングサインのしみ・しわ・たるみ・赤みまで、あらゆる年代でQuality Of Lifeに関係しています。</p>
        <p class="m10">見た目の老化メカニズムは解明が進み、美容医療の質も年々上がっています。その反面、数多くの治療や治療機器があることから、どの治療が自分の症状にあっているのかわからないと相談に来られる方が多くおられます。</p>
        <p class="m10">皆様の悩みに寄り添いながら、しっかりとコミュニケーションをとり、より良い治療と適正な料金で美容診療にあたります。安心して皆様からお気軽にご相談を頂けるように診療に努めてまいります。どうぞよろしくお願いいたします。</p>
      </div>
    </div>
  </section>
  <section class="doc-content">
    <div class="content">
      <div class="list">
        <div>
          <h4 class="rich_font">経　歴</h4>
          <p>大阪府出身<br>
            1999年 大阪市立大学（現大阪公立大学）医学部卒業<br>
            1999年 大阪市立大学医学部付属病院形成外科にて勤務<br>
            2006年 東京都内 レーザー専門総合病院　美容皮膚科にて勤務<br>
            2023年 那覇市 沖縄スキンケアクリニックにて勤務</p>
        </div>
        <div>
          <h4 class="rich_font">免　許</h4>
          <p>医師免許<br/>
            日本形成外科学会 形成外科専門医<br/>
            日本レーザー医学会 レーザー専門医・指導医<br/>
            抗加齢医学会専門医<br/>
            日本形成外科学会 レーザー分野指導医</p>
        </div>
        <div>
          <h4 class="rich_font">所属学会</h4>
          <p>日本形成外科学会<br/>
            日本皮膚科学会<br/>
            日本美容皮膚科学会<br/>
            日本レーザー医学会<br/>
            日本レーザー治療学会<br/>
            日本抗加齢医学会</p>
        </div>
      </div>
    </div>
  </section>
  <section class="doc-eyecatch">
    <div class="content">
      <div class="image_area"><img src="https://okinawa-skincare.com/wp-content/uploads/2024/08/img_h.kadota.jpg" alt="門田　英輝" width="400" height="450" class="alignnone size-full" /></div>
      <div class="title_area">
        <div class="title rich_font">
          <h3><span>門田　英輝</span></h3>
        </div>
        <p class="m10">「まぶたが重くなる」眼瞼下垂は、見た目の問題だけでなく、頭痛や肩こりの原因にもなります。当院では眼瞼下垂を改善する手術を行っております。眼瞼下垂の手術は、見た目の改善にくわえて、頭痛や肩こりを減らすこともできます。</p>
        <p class="m10">目の下のクマやたるみは、加齢とともに目の下の脂肪が前に押し出されることで起こります。目の下の脂肪を減らす手術で、若々しい目元を取り戻すことができます。</p>
        <p class="m10">そのほか、他院で手術を受けた後の目立つ傷あとやまぶたの左右差、ケガのあとの瘢痕などの相談も受けつけております。傷あとでお困りであれば、遠慮なくご相談ください。</p>
      </div>
    </div>
  </section>
  <section class="doc-content">
    <div class="content">
      <div class="list">
        <div>
          <h4 class="rich_font">略　歴</h4>
          <p>1998年3月 九州大学医学部卒業<br>
            1998年5月 九州大学病院　耳鼻咽喉・頭頸部外科　研修医<br>
            1999年6月 北九州市立医療センター　耳鼻咽喉科　研修医<br>
            2000年6月 九州がんセンター　頭頸科　レジデント<br>
            2002年6月 国立がんセンター東病院　頭頸科　レジデント<br>
            2005年9月 浜の町病院　耳鼻咽喉科<br>
            2006年6月 九州大学病院　耳鼻咽喉・頭頸部外科<br>
            2009年4月 佐世保共済病院　耳鼻咽喉科　医長<br>
            2011年4月 沖縄県立中部病院　形成外科<br>
            2014年2月 九州大学病院　形成外科　准教授<br>
            2024年4月 九州大学病院　形成外科　診療教授</p>
        </div>
        <div>
          <h4 class="rich_font">資　格</h4>
          <p>日本形成外科学会：専門医、評議員<br/>
            日本頭蓋顎顔面外科学会：専門医、代議員<br/>
            日本創傷外科学会：専門医、評議員<br/>
            日本耳鼻咽喉科学会：専門医<br/>
            日本手外科学会：専門医<br/>
            日本マイクロサージャリー学会：評議員<br/>
            日本褥瘡学会在宅ケア推進協会：理事<br/>
            九州・沖縄形成外科学会：世話人<br/>
            日本褥瘡学会九州・沖縄地方会：世話人<br/>
            再建・マイクロサージャリー分野指導医<br/>
            小児形成外科分野指導医</p>
        </div>
      </div>
    </div>
  </section>
  <section class="page-header chapter_child" id="feature">
    <div class="title">
      <div class="h2 rich_font" data-before="CLINIC">当院の特徴</div>
    </div>
  </section>
  <?php
  // content builder
  foreach ( ( array )$options[ 'index_contents_order' ] as $index_content ):
    ?>
  <?php
  // Clinic --------------------------------------------------------------------
  if ( $index_content == 'index_clinic' ) {
    $catch = $options[ 'index_clinic_catch' ];
    $desc = $options[ 'index_clinic_desc' ];
    $catch_mobile = $options[ 'index_clinic_catch_mobile' ];
    $desc_mobile = $options[ 'index_clinic_desc_mobile' ];
    $image = wp_get_attachment_image_src( $options[ 'index_clinic_element_image' ], 'full' );
    ?>
  <div id="index_clinic" class="index_content">
    <div class="post_list clearfix">
      <?php
      for ( $i = 1; $i <= 3; $i++ ):
        $image = wp_get_attachment_image_src( $options[ 'index_clinic_box_image' . $i ], 'size1' );
      if ( $image ) {
        $catch = $options[ 'index_clinic_box_catch' . $i ];
        $desc = $options[ 'index_clinic_box_desc' . $i ];
        $url = $options[ 'index_clinic_box_url' . $i ];
        ?>
      <article class="item clearfix">
        <?php if($url){ ?>
        <a class="link animate_background" href="<?php echo esc_url($url); ?>">
        <?php }; ?>
        <div class="image_wrap">
          <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
        </div>
        <div class="title_area">
          <div class="title_area_inner">
            <?php if($catch){ ?>
            <h4 class="title rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h4>
            <?php }; ?>
            <?php if($desc){ ?>
            <p class="desc rich_font_<?php echo esc_attr($options['index_clinic_desc_font_type']); ?>"><?php echo wp_kses_post(nl2br($desc)); ?></p>
            <?php }; ?>
          </div>
        </div>
        <?php if($url){ ?>
        </a>
        <?php }; ?>
      </article>
      <?php }; endfor; ?>
    </div>
    <!-- END .post_list --> 
  </div>
  <!-- END #index_clinic -->
  <?php
  } // End of clinic section
  endforeach;
  ?>
  <section class="page-header chapter_child" id="access">
    <div class="title">
      <div class="h2 rich_font" data-before="ACCESS">アクセス</div>
    </div>
  </section>
  <section class="access-content">
    <div class="content"> <img src="https://okinawa-skincare.com/wp-content/uploads/2023/06/img_accessmap.jpg" alt="アクセスマップ" width="800" height="500" class="aligncenter size-full wp-image-1582" />
      <div class="desc">「県民広場地下駐車場」にご駐車頂いた場合、１万円以上の施術で１時間分の駐車場サービス券をお渡ししておりますので、受付に駐車券をご提示ください。</div>
    </div>
  </section>
  <section class="page-header">
  <div class="title">
    <div class="h2 rich_font" data-before="GALLERY">ギャラリー</div>
    </section>
    <section class="clinic-content">
      <div class="content">
        <ul class="gallery">
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_01.jpg" data-lightbox="gallery1" data-title="外観"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_01.jpg" alt="外観"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_02.jpg" data-lightbox="gallery1" data-title="エントランス"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_02.jpg" alt="エントランス"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_03.jpg" data-lightbox="gallery1" data-title="カウンター"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_03.jpg" alt="カウンター"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_05.jpg" data-lightbox="gallery1" data-title="廊下"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_05.jpg" alt="廊下"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_08.jpg" data-lightbox="gallery1" data-title="カウンセリングルーム"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_08.jpg" alt="カウンセリングルーム"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_09.jpg" data-lightbox="gallery1" data-title="パウダールーム"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_09.jpg" alt="パウダールーム"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_10.jpg" data-lightbox="gallery1" data-title="化粧室"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_10.jpg" alt="化粧室"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_11.jpg" data-lightbox="gallery1" data-title="エントランス"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_11.jpg" alt="エントランス"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_13.jpg" data-lightbox="gallery1" data-title="エントランス"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_13.jpg" alt="カウンター"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_06.jpg" data-lightbox="gallery1" data-title="廊下"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_06.jpg" alt="廊下"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_04.jpg" data-lightbox="gallery1" data-title="待合スペース"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_04.jpg" alt="待合スペース"></a></li>
          <li><a href="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_07.jpg" data-lightbox="gallery1" data-title="施術室"><img src="https://okinawa-skincare.com/wp-content/uploads/2022/10/img_clinic_07.jpg" alt="施術室"></a></li>
        </ul>
      </div>
    </section>
    <?php
    if ( !post_password_required() ) {
      $pagenation_type = $options[ 'pagenation_type' ];
      if ( $pagenation_type == 'type2' ) {
        if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ):
          ?>
    <div id="p_readmore"> <a class="button" href="<?php echo esc_url( $matches[1] ); ?>">
      <?php _e( 'Read more', 'tcd-w' ); ?>
      </a>
      <p class="num"><?php echo $page . ' / ' . $numpages; ?></p>
    </div>
    <?php
    endif;
    } else {
      custom_wp_link_pages();
    }
    }
    ?>
  </div>
  <?php endwhile; endif; ?>
  </article>
  <!-- END #article --> 
  
</div>
<!-- END #one_col -->

<?php get_footer(); ?>
