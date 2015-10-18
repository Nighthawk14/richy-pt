(function()
{
	tinymce.create('tinymce.plugins.owtiny_bootstrap',
	{
		init : function(ed, url)
		{
			ed.addCommand('bootstrap_shortcode_generator', function()
			{
				tb_show("Bootstrap Shortcodes", url + '/../bootstrap-shortcodes.php?&width=630&height=600');
			});
			
			// Add button
			ed.addButton('ow_generate_bootstrap', {    title : 'Bootstrap Shortcodes', cmd : 'bootstrap_shortcode_generator', image : url + '/../images/bootstrap-icon.png' });
		},
		createControl : function(n, cm)
		{
			return null;
		},
		getInfo : function()
		{
			return {
				longname : 'ow TinyMCE',
				author : 'owTheme',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	tinymce.PluginManager.add('ow_bootstrap_button', tinymce.plugins.owtiny_bootstrap);
})();