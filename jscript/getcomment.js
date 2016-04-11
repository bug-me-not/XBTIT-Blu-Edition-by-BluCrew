$(document).ready(function()
		{
			$('a[title*=Comments][rel]').each(function()
			{
				// We make use of the .each() loop to gain access to each element via the "this" keyword...
				$(this).qtip(
				{
					content: {
						// Set the text to an image HTML string with the correct src URL to the loading image you want to use
						text: 'Loading Comments....<img class="throbber" src="images/throbber.gif" width="15px" alt="Loading..." />',
						ajax: {
							url: $(this).attr('rel') // Use the rel attribute of each element for the url to load
						},
						title: {
							text: $(this).attr('title'), // Give the tooltip a title using each elements text
							button: true
						}
					},
					position: {
						at: 'bottom right', // Position the tooltip above the link
						my: 'left top',
						viewport: $(window), // Keep the tooltip on-screen at all times
						effect: false // Disable positioning animation
					},
					show: {
						event: 'hover',
						solo: true // Only show one tooltip at a time
					},
					hide: 'unfocus',
					style: {
						classes: 'ui-tooltip-rounded ui-tooltip-light ui-tooltip-shadow'
					}
				})
			})
		});