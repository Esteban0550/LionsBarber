import './bootstrap';

import Alpine from 'alpinejs';
import '../css/magic-bento.css';
import { initMagicBento } from './magic-bento';

window.Alpine = Alpine;
window.initMagicBento = initMagicBento;

Alpine.start();
