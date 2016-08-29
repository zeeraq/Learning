var videoshow = require('videoshow');
var images = [
	{
		path: 'images/image-00.jpg',
		caption: "image 1"
	},
	{
		path: 'images/image-01.jpg',
		caption: "image 2"
	},
	{
		path: 'images/image-02.jpg',
		caption: "image 3"
	},
	{
		path: 'images/image-03.jpg',
		caption: "image 4"
	},
	{
		path: 'images/image-04.jpg',
		caption: "image 5"
	},
	{
		path: 'images/image-05.jpg',
		caption: "image 6"
	},
	{
		path: 'images/image-06.jpg',
		caption: "image 7"
	}
];

var videoOptions = {
  fps: 25,
  loop: 5, // seconds
  transition: true,
  transitionDuration: 1, // seconds
  videoBitrate: 1024,
  videoCodec: 'libx264',
  size: '640x?',
  audioBitrate: '128k',
  audioChannels: 2,
  format: 'avi',
  useSubRipSubtitles: false, // Use ASS/SSA subtitles instead 
  subtitleStyle: {
    Fontname: 'Verdana',
    Fontsize: '26',
    PrimaryColour: '11861244',
    SecondaryColour: '11861244',
    TertiaryColour: '11861244',
    BackColour: '-2147483640',
    Bold: '2',
    Italic: '0',
    BorderStyle: '2',
    Outline: '2',
    Shadow: '3',
    Alignment: '1', // left, middle, right
    MarginL: '40',
    MarginR: '60',
    MarginV: '40'
  }
}

videoshow(images, videoOptions)
  .audio('images/audio.mp3')
  .save('video1.avi')
  .on('start', function (command) {
    console.log('ffmpeg process started:', command)
  })
  .on('error', function (err, stdout, stderr) {
    console.error('Error:', err);
    console.log('an error happened: ' + err.message, stdout, stderr);
  })
  .on('end', function (output) {
    console.error('Video created in:', output)
  })
