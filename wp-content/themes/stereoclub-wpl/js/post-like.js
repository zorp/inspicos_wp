jQuery(document).ready(function() {

	jQuery(".post-like a").click(function(){
	
		heart = jQuery(this);
		post_id = heart.data("post_id");

		jQuery.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
			success: function(count){
				if(count != "already") {
					if(parseInt(count) <= 0)
						count = parseInt(count) + ' Like';
					else if(parseInt(count) == 1)
						count = parseInt(count) + ' Like';
					else
						count = parseInt(count) + ' Likes';

					heart.addClass("voted");
					heart.find('span.like').removeClass("icon-heart2");
					heart.find('span.like').addClass("icon-heart");
					heart.siblings(".count").text(count);
				}
			}
		});
		
		return false;
	})
})