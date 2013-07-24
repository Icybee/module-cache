window.addEvent('domready', function() {

	var block = document.body.getElement('.block--cache--manage')
	, popover = null
	, popoverTrigger = null

	function getCacheName(el)
	{
		return el.getParent('tr').get('data-entry-key')
	}

	function updateStat(el)
	{
		new Request.API({

			url: 'cache/' + getCacheName(el) + '/stat',

			onSuccess: function(response)
			{
				el.getParent('tr')[(response.count ? 'remove' : 'add') + 'Class']('empty')
				el.innerHTML = response.rc
			}

		}).get()
	}

	block.addEvents({

		'click:relay(td.cell--is-active input)': function(ev, el) {

			new Request.API({

				url: 'cache/' + el.name + '/' + (el.checked ? 'enable' : 'disable')

			}).send()
		},

		'click:relay(button[name="clear"])': function(ev, el) {

			var req = new Request.API({

				url: 'cache/' + getCacheName(el) + '/clear',

				onSuccess: function(response)
				{
					var row = el.getParent('tr')
					, target = row.getElement('td.cell--usage')

					row[(response.rc[0] ? 'remove' : 'add') + 'Class']('empty')
					target.innerHTML = response.rc[1]
				}
			})

			req.send()
		},

		'click:relay(td.cell--configuration .spinner)': function(ev, el) {

			var cacheId = getCacheName(el)

			if (popover)
			{
				if (popoverTrigger == cacheId) return

				popover.hide()

				delete popover

				popover = null
			}

			popoverTrigger = cacheId

			new Request.API
			({
				url: 'cache/' + cacheId + '/editor',
				onSuccess: function(response)
				{
					popover = new Brickrouge.Popover(Elements.from(response.rc).shift(), {

						anchor: el,
						placement: 'above',
						onAction: function(ev)
						{
							if (ev.action == 'cancel')
							{
								popover.hide()
								popover = null
							}
							else if (ev.action == 'ok')
							{
								var form = popover.element.getElement('form')

								popover.hide()
								popover = null

								new Request.API({

									url: 'cache/' + cacheId + '/config',

									onSuccess: function(response)
									{
										el.innerHTML = response.rc
									}

								}).post(form)
							}
						}
					})

					document.body.appendChild(popover.element)

					popover.show()
				}
			}).get()
		}
	})

	Brickrouge.updateDocument()
})