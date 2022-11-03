const video = document.querySelectorAll('.videos');
const success = document.querySelector('.success');
const error = document.querySelector('.error');

function getMessage(message) {
    setTimeout(function () {
        message.remove();
    }, 5000)
}

getMessage(success);
getMessage(error);

for (let i = 0; i < video.length; i++) {
    video[i].addEventListener("mouseenter", function () {
        video[i].play();
    })
    console.log(video[i]);
    video[i].addEventListener("mouseout", function () {
        video[i].pause();
    })
}
