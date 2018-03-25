<?php
/*
The comments page for Bones
*/

global $smof_data;

$s_comment_title = isset($smof_data['s_comment_title']) ? $smof_data['s_comment_title'] : 'Comments';
$s_leave_comment_title = isset($smof_data['s_leave_comment_title']) ? $smof_data['s_leave_comment_title'] : 'Leave a Comment';
$s_comment_button_text = isset($smof_data['s_comment_button_text']) ? $smof_data['s_comment_button_text'] : 'Add Comment';

if(empty($s_comment_title )){
    $s_comment_title = 'Comments'; 
}
if(empty($s_leave_comment_title)){
    $s_leave_comment_title= 'Leave a Comment'; 
}
if(empty($s_comment_button_text)){
    $s_comment_button_text= 'Add Comment'; 
}

// don't load it if you can't comment
if ( post_password_required() ) {
  return;
}

?>

<?php // You can start editing here. ?>

<?php if ( have_comments() ) : ?>



    <section class="commentlist comments ">
        <h2 id="comments-title " class="title"><?php comments_number( __( '<span>No</span> Comments', 'innwit' ), __( '<span>One</span> '.$s_comment_title.'', 'innwit' ), _n( '<span>%</span> Comments', '<span>%</span> Comments', get_comments_number(), 'innwit' ) );?></h2>
        <?php
            wp_list_comments( array(
              'style'             => 'div',
              'short_ping'        => true,
              'avatar_size'       => 40,
              'callback'          => 'bones_comments',
              'type'              => 'all',
              'reply_text'        => 'Reply',
              'page'              => '',
              'per_page'          => '',
              'reverse_top_level' => null,
              'reverse_children'  => ''
              ) );
        ?>
    </section>

      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
       <nav class="navigation comment-navigation" role="navigation">
         <div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'innwit' ) ); ?></div>
         <div class="comment-nav-next"><?php next_comments_link( __( 'More Comments &rarr;', 'innwit' ) ); ?></div>
     </nav>
 <?php endif; ?>

 <?php if ( ! comments_open() ) : ?>
   <p class="no-comments"><?php _e( 'Comments are closed.' , 'innwit' ); ?></p>
<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

    <div class="clear"> 
      <?php 

      $commenter = wp_get_current_commenter();
      $req = get_option( 'require_name_email' );
      $aria_req = ( $req ? " aria-required='true'" : '' );

      $comments_args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'submit',
        'title_reply'       => $s_leave_comment_title,
        'title_reply_to'    => __( 'Leave a Reply to %s', 'innwit' ),
        'cancel_reply_link' => __( 'Cancel Reply', 'innwit' ),
        'label_submit'      => $s_comment_button_text,


        'comment_field' =>  '<p class="comment-form-comment  clear col-md-12"><label for="comment">Comment<span class="color">*</span>'.
        '</label><textarea id="comment" class="textArea" name="comment"  cols="45" rows="8" placeholder="'. esc_attr('Your Comment here...').'" aria-required="true">' .
        '</textarea></p>',

        'comment_notes_before' => '',  

        'comment_notes_after' => '',

        'fields' => apply_filters( 'comment_form_default_fields', array(

          'author' =>
          '<p class="comment-form-author col-md-6">' .
          '<label for="author">' . __( 'Your Name ', 'innwit' ) . 
          ( $req ? '<span class="color">*</span>' : '' ) . '</label> ' .
          '<input id="author" name="author"  class="textArea" type="text" value="" size="30" placeholder="Your Name"' . $aria_req . ' /></p>',

          'email' =>
          '<p class="comment-form-email col-md-6"><label for="email">' . __( 'Your Email', 'innwit' ) . 
          ( $req ? '<span class="color">*</span>' : '' ) . '</label> ' .
          '<input id="email" name="email"  class="textArea" type="text" value="" size="30" placeholder="Your E-Mail"' . $aria_req . ' /></p>',

          'url' =>
          '<p class="comment-form-url col-md-12"><label for="url">' .
          __( 'Your Website :', 'innwit' ) . '</label>' .
          '<input id="url" name="url" type="text"   class="textArea" value="" size="30" placeholder="Got a website?" /></p>'
          )
        ),
);

comment_form($comments_args);

do_action('comment_form', $post->ID); 
?>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>

