//  GET USER INPUT VIA JAVASCIPT. IMPORTANT FOR FUTURE PROJECTS.
var input;
const channelForm = document.getElementById('channel-form');
const channelInput = document.getElementById('channel-input');
const videoContainer = document.getElementById('video-container');

// Form submit
channelForm.addEventListener('submit', e => {
  e.preventDefault();
  input = channelInput.value;
  input = getInput();
  outPutVideo(input);
});

// Get input
function getInput() {
  // Example: https://youtu.be/roywYSEPSvc --> roywYSEPSvc
  input = input.replace('https://youtu.be/', '');
  return input;
}
// Output video to check if it works. Add this after input to get autoplay on desktops: ?autoplay=1
function outPutVideo(input) {
  output = `
          <br><div class="col s3">
          <iframe width="100%" height="100%" src="https://www.youtube.com/embed/${input}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
        `;
  videoContainer.innerHTML = output;
}
