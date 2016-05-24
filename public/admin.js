Brickrouge.observeRunning(() => {

	const block = document.body.querySelector('.block--cache--manage')

	let popover = null
	let popoverTrigger = null

	/**
	 * @param {Element} el
	 *
	 * @returns {string}
	 */
	function getCacheName(el)
	{
		return el.closest('tr').getAttribute('data-entry-key')
	}

	/**
	 * @param {string} html
	 *
	 * @returns {Element}
	 */
	function createElement(html)
	{
		const proxy = document.createElement('div')

		proxy.innerHTML = html

		return proxy.firstElementChild
	}

	block.addDelegatedEventListener('td.cell--is-active input', 'click', (ev, el) => {

		new Request.API({

			url: `cache/${el.name}/enabled`,
			method: el.checked ? 'PUT' : 'DELETE'

		}).send()

	})

	block.addDelegatedEventListener('button[name="clear"]', 'click', (ev, el) => {

		new Request.API({

			url: 'cache/' + getCacheName(el),
			method: 'DELETE',

			onSuccess: response => {

				const row = el.getParent('tr')
				const target = row.getElement('td.cell--usage')

				row[(response.rc[0] ? 'remove' : 'add') + 'Class']('empty')
				target.innerHTML = response.rc[1]

			}

		}).send()

	})

	block.addDelegatedEventListener('td.cell--configuration .spinner', 'click', (ev, el) => {

		const cacheId = getCacheName(el)

		if (popover)
		{
			if (popoverTrigger == cacheId) return

			popover.hide()
			popover = null
		}

		popoverTrigger = cacheId

		new Request({

			url: `/api/cache/${cacheId}/editor`,

			onSuccess: response => {

				popover = new Brickrouge.Popover(createElement(response), {

					anchor: el,
					placement: 'above'

				})

				popover.observeAction(ev => {

					if (ev.action == 'cancel')
					{
						popover.hide()
						popover = null
					}
					else if (ev.action == 'ok')
					{
						const form = popover.element.querySelector('form')

						popover.hide()
						popover = null

						new Request.API({

							url: 'cache/' + cacheId + '/config',

							onSuccess: response => el.innerHTML = response.rc

						}).post(form)
					}

				})

				document.body.appendChild(popover.element)

				popover.show()
			}
		}).get()
	})

})
