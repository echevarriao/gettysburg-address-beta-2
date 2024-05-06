<?php

add_shortcode('posts_category_display', 'posts_category_display_sc');

function posts_category_display_sc($atts) {

	$defaults = array('category' => 'news', 'content' => 'posts', 'showno' => 3, 'post_status' => 'publish');
	$inf = array();
	$m_query = null;
	$content = "";
	$alt_text = "";
	$i = 1;

	$inf = shortcode_atts($defaults, $atts);

	$m_query = new WP_Query(array('post_status' => $inf['post_status'], 'category' => $inf['category'], 'posts_per_page' => $inf['showno']));

	if($m_query->have_posts()){

	$content = appendString($content, "<div class=\"grid-container\">\n
  <div class=\"grid-x grid-margin-x small-up-1 medium-up-2 large-up-3\">");

	while($m_query->have_posts()) {

	$alt_text = "news photo $i";

	$m_query->the_post();
	$content = appendString($content, "<div class=\"cell\">
      <div class=\"card\">\n
        <img alt = \"" . $alt_text . "\" src=\"" . get_the_post_thumbnail_url() . "\" onClick = \"location.href ='" . get_the_permalink() .  "'\">\n
        <div class=\"card-section\"><p><span class = \"publishDate\">" . get_the_date() . "</span><br />
	<b><a href = \"" . get_the_permalink() . "\">" . get_the_title() . "</a></b></p>\n
	</div>\n
      </div>\n
    </div>");

	$i++;

	}

	$content = appendString($content, "  </div>\n
</div>\n");

	} else {

	$content = "<p>There are no posts to display</p>";

	}

	wp_reset_postdata();
	
	return $content;

}

function appendString($data, $content){

	$data .= $content;

	return $data;

}
