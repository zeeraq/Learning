/*
	Combine a list of images into a video montage.
	Using: fluent-ffmpeg
	images need to be named according to ffmpeg convention
	Image names- images/image-00.jpg, images/image-01.jpg and so on..
	Commandline arguments- length in seconds and fps(less than 1 ideally)
*/

/* Require fluent-ffmpeg module */
var ffmpeg = require('fluent-ffmpeg');
/*add images as input in the ffmpeg constructor */
var proc = ffmpeg('./images/image-%2d.jpg');
proc.loop(process.argv[2]);
proc.fps(process.argv[3]);
/* add audio */
proc.input('./images/audio.mp3');
proc.save('images/video.avi');