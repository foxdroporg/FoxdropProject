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
  if(channelInput.value === '') {
    // Display video (either default or earlier inserted video)
    return input;
  }
  else {
    // Example: https://youtu.be/roywYSEPSvc --> roywYSEPSvc
    input = input.replace('https://youtu.be/', '');

    var videoForm = new FormData();

    videoForm.set("userid", U_ID);
    videoForm.set("embededlink", input);

    fetch("includes/video.inc.php", {
      method: 'POST',
      body: videoForm
    }).then(function (response) {
      return response.json();
    })
    .then(function(profilevideo) {
      console.log(profilevideo)

      var embededlink = '';
      profilevideo.forEach(function(video) {
        embededlink += video[2];
      })
      input = embededlink;

    }).catch(function(error) {
      console.error(error);
    });

    return input;
  }
}
// Output video to check if it works. Add this after input to get autoplay on desktops: ?autoplay=1
function outPutVideo(input) {
  if(channelInput.value !== '') {
    output = `
            <br><div class="col s3">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/${input}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
          `;
    videoContainer.innerHTML = output;
    console.log(input);
  }
}
