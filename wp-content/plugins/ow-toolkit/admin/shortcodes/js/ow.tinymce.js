(function()
{
	tinymce.create('tinymce.plugins.owtiny',
	{
		init : function(ed, url)
		{
			ed.addCommand('shortcodeGenerator', function()
			{
				tb_show("Ulysses Shortcodes", url + '/../ow-shortcodes.php?&width=630&height=600');
			});
			
			// Add button
			ed.addButton('owscgenerator', {    title : 'Ulysses Shortcodes', cmd : 'shortcodeGenerator', image : url + '/../images/ow-shortcode.png' });
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
	tinymce.PluginManager.add('ow_buttons', tinymce.plugins.owtiny);
})();