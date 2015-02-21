<?php
/**
 * Template Name: Contact Page
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0.0
 */
?>

<?php get_header(); ?>
<?php

	/*-----------------------------------------------------------
		Form
	-----------------------------------------------------------*/

	$nameError = '';
	$emailError = ''; 
	$commentError  = '';
	//If the form is submitted
	if(isset($_POST['submitted'])) {
		$name = trim($_POST['contactName']);
		$email = trim($_POST['email']);
		$comments = trim($_POST['comments']);
		if(!isset($hasError)) {
			$emailTo = ot_get_option('wpl_contact_form_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = 'New message From'.$name;
			$body = "My name is: $name \n\nMy Email is: $email \n\nMy comments: $comments";
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
	 
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	}
	//end form
?>

<!-- Main -->
<div id="main" class="site-main container_12">
	
	<!-- Left column -->
	<div id="primary" class="grid_8">

			<article class="single-post">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="clear"></div>
				</header>
				
				<div class="entry-content">
					<br />
					<div class="entry-content-post">
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; // end of the loop. ?>
					
							<?php if(isset($emailSent) && $emailSent == true) { ?>
								<div class="thanks">
									<p><?php _e( 'Thanks, your email was sent successfully.', 'wplook' ); ?></p>
								</div>
							<?php } else { ?>
								<?php if(isset($hasError) ) { ?>
									<p class="error"><?php _e( 'Sorry, an error occured.', 'wplook' ); ?><p>
								<?php } ?>
								<form action="<?php the_permalink(); ?>" id="contact-form" method="post">
									<p>
										<label for="contactName"></label>
										<input  type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" placeholder="<?php _e( 'Your Name *', 'wplook' ); ?>" required/>
									</p>
									<p>
										<label for="email"></label>
										<input  type="email" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" placeholder="<?php _e( 'Your Email Adress*', 'wplook' ); ?>" required/>
									</p>
									<p>
										<label for="commentsText"></label>
										<textarea id="textarea-message" class="contactme-text required requiredField" name="comments" cols="20" rows="10" placeholder="<?php _e( 'Your message goes here', 'wplook' ); ?>" required="required"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
										<?php $commentError=''; if($commentError != '') { ?>
											<span class="error"><?php $commentError;?></span>
										<?php } ?>
									</p>
									<div class="form-submit">
										<input id="submit" class="submit-button" value="<?php _e( 'Send', 'wplook' ); ?>" type="submit"></input >
										<input type="hidden" name="submitted" id="submitted" value="true" />
									</div>
								</form>
							<?php } ?>
					</div>
					<div class="clear"></div>

				</div>
			</article>	

	</div>
	
	<!-- Right Column / Widget area -->
	<?php get_sidebar('contact'); ?>
	
	<div class="clear"></div>
</div>

<?php get_footer(); ?>