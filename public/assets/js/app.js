const video = document.querySelectorAll('video');

for (let i = 0; i < video.length; i++) {
    video[i].addEventListener("mouseenter", function () {
        video[i].play();
    })
    console.log(video[i]);
    video[i].addEventListener("mouseout", function () {
        video[i].pause();
    })
}
