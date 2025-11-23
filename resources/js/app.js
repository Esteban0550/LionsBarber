import './bootstrap';

import Alpine from 'alpinejs';
import '../css/magic-bento.css';
import { initMagicBento } from './magic-bento';
import ScrollStack from './scroll-stack.js';

window.Alpine = Alpine;
window.initMagicBento = initMagicBento;
window.ScrollStack = ScrollStack;

Alpine.start();
