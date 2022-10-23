const success = document.querySelector('.success');
const error = document.querySelector('.error');

function getMessage(message) {
    setTimeout(function () {
        message.remove();
    }, 5000)
}

getMessage(success);
getMessage(error);