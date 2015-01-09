$(document).ready(function () {
	// Toggle collapse
	$('body').on('click', '#soundcloudWrapper .playlist_item', function(){
		$('#soundcloudWrapper #collapseSCPlaylistsMoreOptions'+$(this).data('id')).collapse('toggle');
		$(this).toggleClass('active');
	});
	
	// Use Playlist
	$('body').on('click', '#soundcloudWrapper .playlist_item_more a.use', function(){
		var sc_event_id = $(this).data('event-id');
		var sc_id = $(this).data('id');
		var sc_artwork = $(this).data('artwork');
		var sc_title = $(this).data('title');
		var sc_permalink_url = $(this).data('permalink-url');
		var sc_type = $(this).data('type');
		var sc_member_id = $(this).data('member-id');
		var sc_title = $(this).data('title');
	
		$.ajax({
	    type: "POST",
	    url: "assets/includes/SC_commit.php",
	    data: { 'SC_event_id': sc_event_id, 'SC_id': sc_id, 'SC_member_id': sc_member_id, 'SC_type': sc_type, 'SC_permalink_url': sc_permalink_url, 'SC_artwork': sc_artwork, 'SC_title':sc_title},
	    dataType: "json",
			beforeSend: function() {
				$('#soundcloudWrapper #sc_user_playlists').hide();
				$('#soundcloudWrapper #sc_search').hide();
				$('#responselist').html('Loading...');
			},
			success: function(data) {
				console.log(data)
				$('#soundcloudWrapper #sc_response').html(
					'<div class="playlist_item row" data-id="'+data.data[0].id+'">'+
					'	<div class="col-xs-3">'+
					'		<div class="playlist_artwork">'+
					'			<img src="'+sc_artwork+'" />'+
					'		</div>'+
					'	</div>'+
					'	<div class="col-xs-9">'+
					'		<div class="title">'+sc_title+'</div>'+
					'		<div class="tracks">'+sc_type+'</div>'+
					'	</div>'+
					'</div>'+
					'<div class="collapse playlist_item_more row" id="collapseSCPlaylistsMoreOptions'+sc_id+'">'+
					'	<a class="btn btn-primary pull-right btn-xs" href="'+sc_permalink_url+'">More info</a>'+
					'</div>'
				);
				$('#eventform #soundcloud_id').val(data.data[0].id);
		  },
			error: function(data) {
				console.log(data);
				$('#soundcloudWrapper #sc_response').html('error: '+data.responseJSON.errors[0]);
				$('#soundcloudWrapper #sc_user_playlists').show();
				$('#soundcloudWrapper #sc_search').show();
			}
		
		});
		return false;
	});
	
	// Search handler
	$('body').on('submit', '#sc_search', function(e) {
		e.preventDefault();
    var form = $(this);
    var button = $(':submit', form);
		
		if(DEBUG) console.log("Submitted form: " + form.attr("name"));
		$('#soundcloudWrapper #sc_response').html('')
		
    //button.button('loading');
		button.prop('disabled', true);

    $.post(form.attr('action'), form.serialize(), function (response) {
			
      form.find('.error').remove();
      form.find('.has-error').removeClass('has-error');

      if (response.error && response.error.length) {
        // Display errors
        for (var name in response.form) {
          if (response.form.hasOwnProperty(name)) {
            form.find('[name=' + name + ']').focus().parent().addClass('has-error')
              .find('input')
              .before('<small class="error text-danger">' + response.form[name] + '</small>');
          }
        }
      } else {
        // Success
        button.replaceWith('<div class="alert alert-success">' + response.confirm + '</div>');
				
				$('#soundcloudWrapper #sc_response').html(
					'<BR />'+
					'<label>Tracks:</label>'
				);
				if(response.data.length < 1) {
					response.data[0] = new Array();
					response.data[0]['artwork_url'] = 'http://i1.sndcdn.com/artworks-000008530585-sdj0kk-large.jpg';
					response.data[0]['title'] = 'No tracks found.';
					response.data[0]['id'] = '';
					response.data[0]['permalink_url'] = '';
					response.data[0]['event_id'] = '';
					response.data[0]['member_id'] = '';
					response.data[0]['user'] = new Array();
					response.data[0]['user']['username'] = '';
				}
				$.each(response.data, function(index, value) {
					if(value.artwork_url == null) {
						value.artwork_url = 'http://i1.sndcdn.com/artworks-000008530585-sdj0kk-large.jpg';
					}
					value.artist = value.user.username;
					value.event_id = form.data('event-id');
					value.member_id = form.data('member-id');
					$('#soundcloudWrapper #sc_response').append(
						' <div class="playlist_item row" data-id="'+value.id+'" data-permalink_url="'+value.permalink_url+'">'+
						'		<div class="col-xs-3">'+
						'			<div class="playlist_artwork">'+
						'				<img src="'+value.artwork_url+'" />'+
						'			</div>'+
						'		</div>'+
						'		<div class="col-xs-9">'+
						'			<div class="title">'+value.title+'</div>'+
						'			<div class="tracks">'+value.artist+'</div>'+
						'		</div>'+
						'	</div>'
					);
					if(value.id != '') {
						alert('hoi')
						$('#soundcloudWrapper #sc_response').append(
							'	<div class="playlist_item_more no-bg row" id="collapseSCPlaylistsMoreOptions'+value.id+'">'+
							'		<a class="btn btn-primary pull-right btn-xs use" data-id="'+value.id+'" data-artwork="'+value.artwork_url+'" data-title="'+value.title+'" data-type="tracks" data-member-id="'+value.member_id+'" data-event-id="'+value.event_id+'" data-permalink-url="'+value.permalink_url+'" href="#">Use</a><a class="btn btn-primary pull-right btn-xs" href="'+value.permalink_url+'">More info</a>'+
							'	</div>'
						);
					}
				});
				
        if (form.data('success')) {
          setTimeout(function () {
						if(form.data('success').indexOf('.') > -1) {
							window.location = form.data('success');
						} else {
							if(DEBUG) console.log('Invalid redirect url!');
						}
          }, 1000);
        }
      }
      // Re-Enables the button
      //button.button('reset');
			button.prop('disabled', false);
    }, 'json');

    return false;
	});
});