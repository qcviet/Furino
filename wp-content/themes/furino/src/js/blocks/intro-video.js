import {
	delegate,
	addClass,
	removeClass,
	appendHtml,
	getNoScriptContent,
	loadNoscriptContent
} from 'lib/dom'

const initIntroVideo = (el) => {
	const playButton = el.querySelector('.intro-video__link');
	const videoPlayer = el.querySelector('.intro-video__player');
	const background = el.querySelector('.intro-video__background');

	if (!playButton || !videoPlayer) {
		console.error('Required elements not found');
		return;
	}
	videoPlayer.style.visibility = 'hidden';
	videoPlayer.style.opacity = '0';
	videoPlayer.style.transition = 'opacity 0.3s ease';

	const showVideo = () => {
		videoPlayer.style.visibility = 'visible';
		videoPlayer.style.opacity = '1';
		videoPlayer.style.display = 'block';
		if (background) background.style.opacity = '0';
		playButton.style.opacity = '0';
		playButton.style.visibility = 'hidden';
	};

	const hideVideo = () => {
		videoPlayer.style.opacity = '0';
		videoPlayer.style.visibility = 'hidden';
		setTimeout(() => {
			videoPlayer.style.display = 'none';
		}, 300);
		if (background) background.style.opacity = '1';
		playButton.style.opacity = '1';
		playButton.style.visibility = 'visible';
	};

	const handleVideo = async () => {
		try {
			videoPlayer.muted = false;
			videoPlayer.controls = true;
			videoPlayer.currentTime = 0;
			await videoPlayer.load();

			try {
				showVideo();
				await videoPlayer.play();
			} catch (playError) {
				console.warn('Unmuted playback failed, trying muted:', playError);
				videoPlayer.muted = true;
				try {
					await videoPlayer.play();
				} catch (mutedPlayError) {
					console.error('Failed to play video even when muted:', mutedPlayError);
					hideVideo();
					throw new Error('Video playback failed');
				}
			}
		} catch (error) {
			console.error('Video handler error:', error);
			hideVideo();
		}
	};

	playButton.addEventListener('click', async (e) => {
		e.preventDefault();
		await handleVideo();
	});

	videoPlayer.addEventListener('ended', hideVideo);
	videoPlayer.addEventListener('error', (e) => {
		console.error('Video error:', videoPlayer.error);
		hideVideo();
	});

	[background, playButton].forEach(el => {
		if (el) {
			el.style.transition = 'opacity 0.3s ease';
			el.style.opacity = '1';
		}
	});
};

export default initIntroVideo;
