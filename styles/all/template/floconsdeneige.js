// Options
const speed = 0.6; // Speed factor (e.g. 0.1 for very slow, 2 for fast)
const particles = 20; // Number of particles
const particleClassName = 'leflocon'; // CSS class name of particles
const particleDirection = 'down'; // 'up' to go up, 'down' to go down

class ParticleAnimation {
	constructor() {
		this.swide = 0;
		this.shigh = 0;
		this.particlesData = [];
		this.particlesElements = [];
		this.container = null;
		this.init();
	}

	/**
	 * Initializes the particle animation.
	 */
	init() {
		// Do not start the animation based on user preferences (Accessibility)
		const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		if (prefersReducedMotion) {
			return;
		}

		// Otherwise, let's go
		this.container = document.createElement("div");
		this.container.style.position = "absolute";
		document.body.appendChild(this.container);
		this.updateScroll();
		this.updateSize();

		for (let i = 0; i < particles; i++) {
			const x = Math.random() * (this.swide - 40) + 20;
			const y = Math.random() * this.shigh;
			const amplitude = Math.random() * 20;
			const speedY = (0.75 + 1.25 * Math.random()) * speed;
			const phase = 0;

			this.particlesData.push({ x, y, amplitude, speedY, phase });

			const element = document.createElement("span");
			element.className = particleClassName;
			element.style.zIndex = i;
			element.style.top = y + "px";
			element.style.left = x + "px";
			this.particlesElements.push(element);
			this.container.appendChild(element);
		}

		this.animate();
	}

	/**
	 * Updates the window size.
	 */
	updateSize() {
		this.swide = window.innerWidth;
		this.shigh = window.innerHeight;
	}

	/**
	 * Updates the container position during scrolling.
	 */
	updateScroll() {
		const sdown = window.pageYOffset;
		const sleft = window.pageXOffset;
		this.container.style.top = sdown + "px";
		this.container.style.left = sleft + "px";
	}

	/**
	 * Resets a particle off-screen.
	 */
	resetParticle(particle, direction) {
		particle.x = Math.random() * (this.swide - 40) + 20;
		if (direction === 'up') {
			particle.y = this.shigh;
		} else if (direction === 'down') {
			particle.y = 0;
		}
		particle.speedY = (0.75 + 1.25 * Math.random()) * speed;
	}

	/**
	 * Animates the particles.
	 */
	animate = () => {
		this.updateParticles();
		requestAnimationFrame(this.animate);
	}

	/**
	 * Updates the positions of the particles.
	 */
	updateParticles() {
		for (let i = 0; i < particles; i++) {
			const particle = this.particlesData[i];
			const element = this.particlesElements[i];

			if (particleDirection === 'up') {
				particle.y -= particle.speedY;
				if (particle.y < 30) {
					this.resetParticle(particle, 'up');
				}
			} else if (particleDirection === 'down') {
				particle.y += particle.speedY;
				if (particle.y > this.shigh) {
					this.resetParticle(particle, 'down');
				}
			}

			particle.phase += (0.02 + Math.random() / 10) * speed;
			element.style.top = particle.y + "px";
			element.style.left = (particle.x + particle.amplitude * Math.sin(particle.phase)) + "px";
		}
	}
}

// Event handling
window.onresize = () => particleAnimation.updateSize();
window.onscroll = () => particleAnimation.updateScroll();

// Initialization
let particleAnimation;
window.addEventListener('load', () => {
	particleAnimation = new ParticleAnimation();
});
