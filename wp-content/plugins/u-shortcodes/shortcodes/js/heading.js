// JavaScript Document
(function() {
    tinymce.PluginManager.add('shortcode_heading', function(editor, url) {
		editor.addButton('shortcode_heading', {
			text: '',
			tooltip: 'Heading',
			icon: 'icon-heading',
			id: 'heading_shortcode',
			onclick: function() {
				// Open window
				editor.windowManager.open({
					title: 'Heading',
					body: [
						{type: 'textbox', name: 'text', label: 'Heading Text'},
						{type: 'textbox', name: 'links', label: 'Heading Link (Optional)'},
						{type: 'listbox', 
							name: 'css_animation', 
							label: 'CSS Animation', 
							'values': [
								{text: 'No', value: ''},
								{text: 'Top to bottom', value: 'top-to-bottom'},
								{text: 'Bottom to top', value: 'bottom-to-top'},
								{text: 'Left to right', value: 'left-to-right'},
								{text: 'Right to left', value: 'right-to-left'},
								{text: 'Appear from center', value: 'appear'}
							]
						},
						{type: 'textbox', name: 'animation_delay', label: 'Animation Delay'},
					],
					onsubmit: function(e) {
						var uID =  Math.floor((Math.random()*100)+1);
						// Insert content when the window form is submitted
						editor.insertContent('[u_heading ID="heading_'+uID+'" url="'+e.data.links+'" css_animation="'+e.data.css_animation+'" animation_delay="'+e.data.animation_delay+'"]'+e.data.text+'[/u_heading]<br class="nc"/>');
					}
				});
			}
		});
	});
})();
