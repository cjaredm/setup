//--------------------------------------------------------------
// MENU
//--------------------------------------------------------------

const menuTrigger = document.querySelector('[data-js-menu-trigger]');
const menu = document.querySelector('[data-js-menu]');

function toggleMenu() {
	// Convert attribute to boolean.
	const open = JSON.parse(menuTrigger.getAttribute('aria-expanded'));
	menuTrigger.setAttribute('aria-expanded', !open);
	menu.classList.toggle('is-active');

	// Overlay
	overlay();
}

function overlay() {
	// Create and append.
	const overlay = document.createElement('span');
	overlay.classList.add('navigation__overlay');
	document.querySelector('.navigation').appendChild(overlay);

	// Remove and close menu.
	overlay.addEventListener('click', _ => {
		overlay.remove();
		menuTrigger.setAttribute('aria-expanded', !open);
		menu.classList.remove('is-active');
	});
}

if (menuTrigger && menu) {
	menuTrigger.addEventListener('click', toggleMenu);
}

//-----------------------------------------
// GTranslate
//-----------------------------------------
const translate = document.querySelector('[data-js-translate]');
translate.firstElementChild.classList.add('is-active');

function toggleStyle(event) {
	event.preventDefault();

	const links = [...translate.children];
	links.forEach(link => link.classList.remove('is-active'));
	event.target.classList.add('is-active');
}

translate.addEventListener('click', toggleStyle);
