export class MenuOpener {
    constructor(menuButton, menu) {
        menuButton.addEventListener('click', () => {
            if (menu.getAttribute('data-state') == 'collapsed') {
                menu.setAttribute('data-state', 'expanded');
                menuButton.setAttribute('data-menu', 'opened');
            }
            else {
                menu.setAttribute('data-state', 'collapsed');
                menuButton.setAttribute('data-menu', 'closed');
            }
        });
    }
}