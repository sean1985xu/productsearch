(function($)
{
	$.Redactor.prototype.joomag = function()
	{
		return {
			reUrlJoomag: /https?:\/\/(www\.)?joomag.com\/(\d+)($|\/)/,
			getTemplate: function()
			{
				return String()
				+ '<section id="redactor-modal-joomag-insert">'
					+ '<label>JOOMAG E-BOOK URL:</label>'
					+ '<textarea id="redactor-insert-joomag-area" style="height: 80px;"></textarea>'
					+ '<p class="text-muted font-medium sm-text" style="margin-top: 5px;">The full url without http:// or https://<br>eg. www.joomag.com/magazine/trends-international-design-awards/M0239672001424134831</p>'
				+ '</section>';
			},
			init: function()
			{
				var button = this.button.addAfter('video', 'joomag', 'Insert JOOMAG');
				this.button.addCallback(button, this.joomag.show);
			},
			show: function()
			{
				this.modal.addTemplate('joomag', this.joomag.getTemplate());

				this.modal.load('joomag', 'Insert JOOMAG E-Book', 700);
				this.modal.createCancelButton();

				var button = this.modal.createActionButton(this.lang.get('insert'));
				button.on('click', this.joomag.insert);

				this.selection.save();
				this.modal.show();

				$('#redactor-insert-joomag-area').focus();

			},
			insert: function()
			{
				var data = $('#redactor-insert-joomag-area').val();

				if (!data.match(/<iframe|<joomag/gi))
				{
					data = this.clean.stripTags(data);

					// parse if it is link on youtube & Joomag
					var iframeStart = '<iframe width="100%" height="600px" src="//',
						iframeEnd = '?p=1&e=1&embedInfo=;image,%2F%2Fwww.joomag.com%2Fstatic%2Fflash%2Fgui%2Fthemes%2Fdefault%2Fbg.jpg,fill" frameborder="0"></iframe>';

					data = iframeStart + data + iframeEnd;

				}

				this.selection.restore();
				this.modal.close();

				var current = this.selection.getBlock() || this.selection.getCurrent();

				if (current) $(current).after(data);
				else
				{
					this.insert.html(data);
				}

				this.code.sync();
			}

		};
	};
})(jQuery);