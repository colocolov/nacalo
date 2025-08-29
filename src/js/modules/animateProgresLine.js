class SectionsContainerAnimation {
            constructor(container) {
                this.container = container;
                this.sections = container.querySelectorAll('.line-progress__item');
                this.animated = false;
                
                this.init();
            }
            
            init() {
                this.setupObserver();
            }
            
            setupObserver() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !this.animated) {
                            this.animateSections();
                            this.animated = true;
                        }
                    });
                }, { threshold: 0.3 });
                
                observer.observe(this.container);
            }
            
            animateSections() {
                console.log(this.sections);
                this.sections.forEach(section => {
                    const delay = parseInt(section.dataset.delay) || 0;
                    setTimeout(() => {
                        section.classList.add('visible');
                    }, delay);
                });
            }
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            const processSectionsContainer = document.querySelector('.line-progress');
            
            if (!processSectionsContainer) {
                console.log('No .line-progress container found - script stopped');
                return;
            }
            
            const initAnimation = () => {
                if (window.innerWidth <= 767.98) {
                    // На мобильных устройствах анимируем сразу все секции
                    const sections = processSectionsContainer.querySelectorAll('.line-progress__item');
                    sections.forEach(section => {
                        section.classList.add('visible');
                    });
                    return;
                }
                
                // На десктопах используем анимацию при скролле
                new SectionsContainerAnimation(processSectionsContainer);
            };
            
            initAnimation();
            window.addEventListener('resize', initAnimation);
        });