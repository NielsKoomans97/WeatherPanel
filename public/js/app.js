import { RadarAnimator } from '/js/modules/RadarAnimator.js';
import { MenuOpener } from '/js/modules/MenuOpener.js';

new MenuOpener(document.querySelector('#menu-button'), document.querySelector('nav'));

const radars = document.querySelectorAll('.radar');
radars.forEach(radar => {
    let animator = new RadarAnimator(radar);
});