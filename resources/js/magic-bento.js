import { gsap } from 'gsap';

const DEFAULT_PARTICLE_COUNT = 12;
const DEFAULT_SPOTLIGHT_RADIUS = 300;
const DEFAULT_GLOW_COLOR = '132, 0, 255';
const MOBILE_BREAKPOINT = 768;

const createParticleElement = (x, y, color = DEFAULT_GLOW_COLOR) => {
  const el = document.createElement('div');
  el.className = 'particle';
  el.style.cssText = `
    position: absolute;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: rgba(${color}, 1);
    box-shadow: 0 0 6px rgba(${color}, 0.6);
    pointer-events: none;
    z-index: 100;
    left: ${x}px;
    top: ${y}px;
  `;
  return el;
};

const calculateSpotlightValues = radius => ({
  proximity: radius * 0.5,
  fadeDistance: radius * 0.75
});

const updateCardGlowProperties = (card, mouseX, mouseY, glow, radius) => {
  const rect = card.getBoundingClientRect();
  const relativeX = ((mouseX - rect.left) / rect.width) * 100;
  const relativeY = ((mouseY - rect.top) / rect.height) * 100;
  card.style.setProperty('--glow-x', `${relativeX}%`);
  card.style.setProperty('--glow-y', `${relativeY}%`);
  card.style.setProperty('--glow-intensity', glow.toString());
  card.style.setProperty('--glow-radius', `${radius}px`);
};

const isMobile = () => window.innerWidth <= MOBILE_BREAKPOINT;

class ParticleCard {
  constructor(element, options = {}) {
    this.element = element;
    this.options = {
      particleCount: options.particleCount || DEFAULT_PARTICLE_COUNT,
      glowColor: options.glowColor || DEFAULT_GLOW_COLOR,
      enableTilt: options.enableTilt !== false,
      clickEffect: options.clickEffect !== false,
      enableMagnetism: options.enableMagnetism !== false,
      disableAnimations: options.disableAnimations || isMobile()
    };
    
    this.particles = [];
    this.timeouts = [];
    this.isHovered = false;
    this.memoizedParticles = [];
    this.particlesInitialized = false;
    this.magnetismAnimation = null;
    
    this.init();
  }

  initializeParticles() {
    if (this.particlesInitialized || !this.element) return;
    const { width, height } = this.element.getBoundingClientRect();
    this.memoizedParticles = Array.from({ length: this.options.particleCount }, () =>
      createParticleElement(Math.random() * width, Math.random() * height, this.options.glowColor)
    );
    this.particlesInitialized = true;
  }

  clearAllParticles() {
    this.timeouts.forEach(clearTimeout);
    this.timeouts = [];
    this.magnetismAnimation?.kill();
    this.particles.forEach(particle => {
      gsap.to(particle, {
        scale: 0,
        opacity: 0,
        duration: 0.3,
        ease: 'back.in(1.7)',
        onComplete: () => {
          particle.parentNode?.removeChild(particle);
        }
      });
    });
    this.particles = [];
  }

  animateParticles() {
    if (!this.element || !this.isHovered) return;
    if (!this.particlesInitialized) {
      this.initializeParticles();
    }
    this.memoizedParticles.forEach((particle, index) => {
      const timeoutId = setTimeout(() => {
        if (!this.isHovered || !this.element) return;
        const clone = particle.cloneNode(true);
        this.element.appendChild(clone);
        this.particles.push(clone);
        gsap.fromTo(clone, { scale: 0, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.3, ease: 'back.out(1.7)' });
        gsap.to(clone, {
          x: (Math.random() - 0.5) * 100,
          y: (Math.random() - 0.5) * 100,
          rotation: Math.random() * 360,
          duration: 2 + Math.random() * 2,
          ease: 'none',
          repeat: -1,
          yoyo: true
        });
        gsap.to(clone, {
          opacity: 0.3,
          duration: 1.5,
          ease: 'power2.inOut',
          repeat: -1,
          yoyo: true
        });
      }, index * 100);
      this.timeouts.push(timeoutId);
    });
  }

  init() {
    if (this.options.disableAnimations || !this.element) return;
    
    this.element.style.position = 'relative';
    this.element.style.overflow = 'hidden';
    
    const handleMouseEnter = () => {
      this.isHovered = true;
      this.animateParticles();
      if (this.options.enableTilt) {
        gsap.to(this.element, {
          rotateX: 5,
          rotateY: 5,
          duration: 0.3,
          ease: 'power2.out',
          transformPerspective: 1000
        });
      }
    };

    const handleMouseLeave = () => {
      this.isHovered = false;
      this.clearAllParticles();
      if (this.options.enableTilt) {
        gsap.to(this.element, {
          rotateX: 0,
          rotateY: 0,
          duration: 0.3,
          ease: 'power2.out'
        });
      }
      if (this.options.enableMagnetism) {
        gsap.to(this.element, {
          x: 0,
          y: 0,
          duration: 0.3,
          ease: 'power2.out'
        });
      }
    };

    const handleMouseMove = (e) => {
      if (!this.options.enableTilt && !this.options.enableMagnetism) return;
      const rect = this.element.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;

      if (this.options.enableTilt) {
        const rotateX = ((y - centerY) / centerY) * -10;
        const rotateY = ((x - centerX) / centerX) * 10;
        gsap.to(this.element, {
          rotateX,
          rotateY,
          duration: 0.1,
          ease: 'power2.out',
          transformPerspective: 1000
        });
      }

      if (this.options.enableMagnetism) {
        const magnetX = (x - centerX) * 0.05;
        const magnetY = (y - centerY) * 0.05;
        this.magnetismAnimation = gsap.to(this.element, {
          x: magnetX,
          y: magnetY,
          duration: 0.3,
          ease: 'power2.out'
        });
      }
    };

    const handleClick = (e) => {
      if (!this.options.clickEffect) return;
      const rect = this.element.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const maxDistance = Math.max(
        Math.hypot(x, y),
        Math.hypot(x - rect.width, y),
        Math.hypot(x, y - rect.height),
        Math.hypot(x - rect.width, y - rect.height)
      );
      const ripple = document.createElement('div');
      ripple.style.cssText = `
        position: absolute;
        width: ${maxDistance * 2}px;
        height: ${maxDistance * 2}px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(${this.options.glowColor}, 0.4) 0%, rgba(${this.options.glowColor}, 0.2) 30%, transparent 70%);
        left: ${x - maxDistance}px;
        top: ${y - maxDistance}px;
        pointer-events: none;
        z-index: 1000;
      `;
      this.element.appendChild(ripple);
      gsap.fromTo(
        ripple,
        { scale: 0, opacity: 1 },
        {
          scale: 1,
          opacity: 0,
          duration: 0.8,
          ease: 'power2.out',
          onComplete: () => ripple.remove()
        }
      );
    };

    this.element.addEventListener('mouseenter', handleMouseEnter);
    this.element.addEventListener('mouseleave', handleMouseLeave);
    this.element.addEventListener('mousemove', handleMouseMove);
    this.element.addEventListener('click', handleClick);
  }

  destroy() {
    this.isHovered = false;
    this.clearAllParticles();
  }
}

class GlobalSpotlight {
  constructor(gridElement, options = {}) {
    this.gridElement = gridElement;
    this.options = {
      enabled: options.enabled !== false,
      spotlightRadius: options.spotlightRadius || DEFAULT_SPOTLIGHT_RADIUS,
      glowColor: options.glowColor || DEFAULT_GLOW_COLOR,
      disableAnimations: options.disableAnimations || isMobile()
    };
    this.spotlight = null;
    this.isInsideSection = false;
    
    if (this.options.enabled && !this.options.disableAnimations) {
      this.init();
    }
  }

  init() {
    const spotlight = document.createElement('div');
    spotlight.className = 'global-spotlight';
    spotlight.style.cssText = `
      position: fixed;
      width: ${this.options.spotlightRadius * 2.5}px;
      height: ${this.options.spotlightRadius * 2.5}px;
      border-radius: 50%;
      pointer-events: none;
      background: radial-gradient(circle,
        rgba(${this.options.glowColor}, 0.4) 0%,
        rgba(${this.options.glowColor}, 0.25) 20%,
        rgba(${this.options.glowColor}, 0.15) 35%,
        rgba(${this.options.glowColor}, 0.08) 50%,
        rgba(${this.options.glowColor}, 0.04) 65%,
        transparent 80%
      );
      z-index: 200;
      opacity: 0;
      transform: translate(-50%, -50%);
      mix-blend-mode: screen;
      will-change: transform, opacity;
    `;
    document.body.appendChild(spotlight);
    this.spotlight = spotlight;

    const handleMouseMove = (e) => {
      if (!this.spotlight || !this.gridElement) return;
      const section = this.gridElement.closest('.bento-section') || this.gridElement;
      const rect = section?.getBoundingClientRect();
      const mouseInside =
        rect && e.clientX >= rect.left && e.clientX <= rect.right && e.clientY >= rect.top && e.clientY <= rect.bottom;
      this.isInsideSection = mouseInside || false;
      const cards = this.gridElement.querySelectorAll('.magic-bento-card');

      if (!mouseInside) {
        gsap.to(this.spotlight, {
          opacity: 0,
          duration: 0.3,
          ease: 'power2.out'
        });
        cards.forEach(card => {
          card.style.setProperty('--glow-intensity', '0');
        });
        return;
      }

      const { proximity, fadeDistance } = calculateSpotlightValues(this.options.spotlightRadius);
      let minDistance = Infinity;
      cards.forEach(card => {
        const cardRect = card.getBoundingClientRect();
        const cardCenterX = cardRect.left + cardRect.width / 2;
        const cardCenterY = cardRect.top + cardRect.height / 2;
        const distance = Math.hypot(e.clientX - cardCenterX, e.clientY - cardCenterY);
        minDistance = Math.min(minDistance, distance);
        
        let glowIntensity = 0;
        if (distance <= proximity) {
          glowIntensity = 1;
        } else if (distance <= fadeDistance) {
          glowIntensity = Math.max(0, (fadeDistance - distance) / (fadeDistance - proximity));
        }
        
        const relativeX = e.clientX - cardRect.left;
        const relativeY = e.clientY - cardRect.top;
        updateCardGlowProperties(card, relativeX, relativeY, glowIntensity, this.options.spotlightRadius);
      });

      this.spotlight.style.left = `${e.clientX}px`;
      this.spotlight.style.top = `${e.clientY}px`;

      const targetOpacity =
        minDistance <= proximity
          ? 1.0
          : minDistance <= fadeDistance
            ? ((fadeDistance - minDistance) / (fadeDistance - proximity)) * 1.0
            : 0;

      gsap.to(this.spotlight, {
        opacity: targetOpacity,
        duration: targetOpacity > 0 ? 0.1 : 0.3,
        ease: 'power2.out'
      });
    };

    const handleMouseLeave = () => {
      this.isInsideSection = false;
      this.gridElement?.querySelectorAll('.magic-bento-card').forEach(card => {
        card.style.setProperty('--glow-intensity', '0');
      });
      if (this.spotlight) {
        gsap.to(this.spotlight, {
          opacity: 0,
          duration: 0.3,
          ease: 'power2.out'
        });
      }
    };

    document.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseleave', handleMouseLeave);
    
    this.handleMouseMove = handleMouseMove;
    this.handleMouseLeave = handleMouseLeave;
  }

  destroy() {
    if (this.handleMouseMove) {
      document.removeEventListener('mousemove', this.handleMouseMove);
    }
    if (this.handleMouseLeave) {
      document.removeEventListener('mouseleave', this.handleMouseLeave);
    }
    this.spotlight?.parentNode?.removeChild(this.spotlight);
  }
}

export function initMagicBento(containerSelector, options = {}) {
  const container = typeof containerSelector === 'string' 
    ? document.querySelector(containerSelector) 
    : containerSelector;
  
  if (!container) return null;

  const config = {
    textAutoHide: options.textAutoHide !== false,
    enableStars: options.enableStars !== false,
    enableSpotlight: options.enableSpotlight !== false,
    enableBorderGlow: options.enableBorderGlow !== false,
    enableTilt: options.enableTilt !== false,
    enableMagnetism: options.enableMagnetism !== false,
    clickEffect: options.clickEffect !== false,
    spotlightRadius: options.spotlightRadius || DEFAULT_SPOTLIGHT_RADIUS,
    particleCount: options.particleCount || DEFAULT_PARTICLE_COUNT,
    glowColor: options.glowColor || DEFAULT_GLOW_COLOR,
    disableAnimations: options.disableAnimations || isMobile()
  };

  container.classList.add('bento-section', 'card-grid');

  const cards = container.querySelectorAll('.magic-bento-card');
  const cardInstances = [];
  
  cards.forEach((card, index) => {
    if (config.textAutoHide) {
      card.classList.add('magic-bento-card--text-autohide');
    }
    if (config.enableBorderGlow) {
      card.classList.add('magic-bento-card--border-glow');
    }
    
    card.style.setProperty('--glow-color', config.glowColor);
    
    if (config.enableStars) {
      const particleCard = new ParticleCard(card, {
        particleCount: config.particleCount,
        glowColor: config.glowColor,
        enableTilt: config.enableTilt,
        clickEffect: config.clickEffect,
        enableMagnetism: config.enableMagnetism,
        disableAnimations: config.disableAnimations
      });
      cardInstances.push(particleCard);
    } else {
      if (!config.disableAnimations) {
        const handleMouseMove = (e) => {
          const rect = card.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          const centerX = rect.width / 2;
          const centerY = rect.height / 2;

          if (config.enableTilt) {
            const rotateX = ((y - centerY) / centerY) * -10;
            const rotateY = ((x - centerX) / centerX) * 10;
            gsap.to(card, {
              rotateX,
              rotateY,
              duration: 0.1,
              ease: 'power2.out',
              transformPerspective: 1000
            });
          }

          if (config.enableMagnetism) {
            const magnetX = (x - centerX) * 0.05;
            const magnetY = (y - centerY) * 0.05;
            gsap.to(card, {
              x: magnetX,
              y: magnetY,
              duration: 0.3,
              ease: 'power2.out'
            });
          }
        };

        const handleMouseLeave = () => {
          if (config.enableTilt) {
            gsap.to(card, {
              rotateX: 0,
              rotateY: 0,
              duration: 0.3,
              ease: 'power2.out'
            });
          }
          if (config.enableMagnetism) {
            gsap.to(card, {
              x: 0,
              y: 0,
              duration: 0.3,
              ease: 'power2.out'
            });
          }
        };

        const handleClick = (e) => {
          if (!config.clickEffect) return;
          const rect = card.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          const maxDistance = Math.max(
            Math.hypot(x, y),
            Math.hypot(x - rect.width, y),
            Math.hypot(x, y - rect.height),
            Math.hypot(x - rect.width, y - rect.height)
          );
          const ripple = document.createElement('div');
          ripple.style.cssText = `
            position: absolute;
            width: ${maxDistance * 2}px;
            height: ${maxDistance * 2}px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(${config.glowColor}, 0.4) 0%, rgba(${config.glowColor}, 0.2) 30%, transparent 70%);
            left: ${x - maxDistance}px;
            top: ${y - maxDistance}px;
            pointer-events: none;
            z-index: 1000;
          `;
          card.appendChild(ripple);
          gsap.fromTo(
            ripple,
            { scale: 0, opacity: 1 },
            {
              scale: 1,
              opacity: 0,
              duration: 0.8,
              ease: 'power2.out',
              onComplete: () => ripple.remove()
            }
          );
        };

        card.addEventListener('mousemove', handleMouseMove);
        card.addEventListener('mouseleave', handleMouseLeave);
        card.addEventListener('click', handleClick);
      }
    }
  });

  let spotlight = null;
  if (config.enableSpotlight) {
    spotlight = new GlobalSpotlight(container, {
      enabled: config.enableSpotlight,
      spotlightRadius: config.spotlightRadius,
      glowColor: config.glowColor,
      disableAnimations: config.disableAnimations
    });
  }

  return {
    destroy: () => {
      cardInstances.forEach(instance => instance.destroy());
      spotlight?.destroy();
    }
  };
}

export default initMagicBento;

