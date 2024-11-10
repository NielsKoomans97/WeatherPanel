export class RadarAnimator {
    isPlaying = true;
    frames = [];
    currentIndex = 0;

    constructor(radarElement) {
        this.frames = radarElement.querySelectorAll('.frame');

        const radarControls = radarElement.querySelector('.radar-controls');
        const pauseButton = radarElement.querySelector('.stop-animation');
        const icon = pauseButton.querySelector('i');

        const frameSlider = radarControls.querySelector('.frame-slider');
        if (frameSlider != null) {
            console.log('slider');

            frameSlider.addEventListener('input', () => {
                this.isPlaying = false;
                icon.classList.replace('bi-pause', 'bi-play');

                this.frames.forEach(frame => {
                    frame.classList.replace('active', 'hidden');
                });

                const currentFrame = this.frames[frameSlider.value];

                if (currentFrame != null) {
                    this.frames[frameSlider.value].classList.replace('hidden', 'active');
                }

                this.currentIndex = frameSlider.value;
            });
        }


        setInterval(() => {
            pauseButton.addEventListener('click', () => {
                if (this.isPlaying == false) {
                    this.isPlaying = true;
                    icon.classList.replace('bi-play', 'bi-pause');
                }
                else {
                    this.isPlaying = false;
                    icon.classList.replace('bi-pause', 'bi-play');
                }
            });

            if (this.isPlaying == true) {
                this.frames.forEach(frame => {
                    frame.classList.replace('active', 'hidden');
                });

                const currentFrame = this.frames[this.currentIndex];

                if (currentFrame != null) {
                    currentFrame.classList.replace('hidden', 'active');
                }

                if (this.currentIndex == (this.frames.length - 1)) {
                    this.currentIndex = 0;
                }
                else {
                    this.currentIndex++;
                }

                if (frameSlider != null) {
                    frameSlider.value = this.currentIndex;
                }
            }

        }, 300);
    }

    Start() {
        this.isPlaying = true;
    }

    Stop() {
        this.isPlaying = false;
    }
}