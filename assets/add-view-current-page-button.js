(function(win, doc) {
	'use strict';

	if (
		location.pathname.includes('pages')
		&& document.querySelector('#titlebar-save')
		&& typeof page_route == 'string'
		&& typeof page_lang == 'string'
	) {
		// console.log('lang, page_route :>> ', page_lang, page_route);
		
		// define preview URL and neighbour
		const link = "/" + page_lang + page_route;
		const delete_button = document.querySelector('#titlebar-button-delete');

		// create button
		let button = doc.createElement('a');
		button.href = link;
		button.id = 'titlebar-button-view-current-page';
		button.target = "_blank";
		button.classList.add('button');
		button.innerHTML = '<i class="fa fa-link fa-fw"></i>';

		// insert button
		delete_button.insertAdjacentElement('beforebegin', button);

		// no CSS flex, so we need a space for spacing…
		doc.querySelector('.button-bar').insertBefore(doc.createTextNode(' '), delete_button);
	}

})(window, document);