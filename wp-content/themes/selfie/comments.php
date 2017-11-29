
<!-- Comments Section Begin
================================================== -->	



<!-- Please, Do not delete these lines
================================================== -->	
<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="no-comments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'selfie'); ?></p>
	<?php
		return;
	}
	
	$commentvalue = false;
?>


<!-- Check if have Comments then Begin
================================================== -->	
<?php if ( have_comments() ) : ?>

	<?php
		$nocomment = esc_html__('No Comments Yet', "selfie");
		$onecomment = esc_html__('1 Comment', "selfie");
		$morecomments = esc_html__('% Comments', "selfie");
	?>

	<h3><?php comments_number( $nocomment , $onecomment , $morecomments ); ?></h3>	


	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=selfie_comment&avatar_size=70'); ?>
	</ol>
	<div class="comments-pagination">
		<?php paginate_comments_links(); ?>
	</div>	


<?php else : /*this is displayed if there are no comments so far*/ ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<h3><?php esc_html_e("Comments are closed" , "selfie"); ?></h3>
	<?php endif; ?>

<?php endif; ?>


<!-- Check if have Comments Open then Begin
================================================== -->	
<?php if ( comments_open() ) : ?>

				
		<!-- Comment Section -->	
		<div id="respond" class="ccomment-respond">			
			<h3><?php comment_form_title(esc_html__('Leave a Comment', "selfie"), esc_html__('Leave a Comment', "selfie")); ?></h3>	
			
			<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>

			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<p><?php esc_html_e("You must be" , "selfie"); ?><a href="<?php echo esc_url(wp_login_url( get_permalink() )); ?>"><?php esc_html_e("logged in" , "selfie"); ?></a> <?php esc_html_e("to post a comment." , "selfie"); ?></p>
			<?php else : ?>

					<form class="comment-form" id="commentform" method="post" action="<?php echo esc_url(get_option('siteurl')); ?>/wp-comments-post.php">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="<?php esc_html_e('Name *', "selfie"); ?>" id="author" name="author" value="">
						</div>						
						
						<div class="form-group">
							<input type="email" class="form-control" placeholder="<?php esc_html_e('E-mail *', "selfie"); ?>" id="email" name="email" value="">
						</div>						

						<div class="form-group">
							<input type="text" class="form-control" placeholder="<?php esc_html_e('Subject', "selfie"); ?>" id="subject" name="subject" value="">
						</div>						

						<div class="form-group">
							<textarea class="form-control" placeholder="<?php esc_html_e('Message *', "selfie"); ?>" id="comment" name="comment" rows="8" ></textarea>
						</div>												

						<div class="form-group">
							<input type="submit" value="<?php esc_html_e('Post Comment', "selfie"); ?>" id="submit" name="submit" class="btn btn-dark">
							<?php comment_id_fields(); ?>
							<?php do_action('comment_form', $post->ID); ?>	
						</div>						
                
					</form>						
	
			<?php endif; ?>
			
		</div>								
		<!-- Comment Section::END -->


<?php endif; ?>


<?php if($commentvalue){comment_form(); wp_enqueue_script( 'comment-reply' );} ?>


<!-- Comments Section End
================================================== -->	

