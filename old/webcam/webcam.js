var video = document.getElementById('video');



//получение доступа к камере
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.srcObject = stream;
        video.play();
    });
}


//для получения снимка
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');


//сфотографировать 1
document.getElementById("photo").addEventListener("click", function() {
    context.drawImage(video, 0, 0, 256, 192); //расположение снимка в окне браузера (1 и 2), размер выводимого изображения (3 и 4)
});

// //сфотографировать 2
// document.getElementById("photo").addEventListener("click", function() {
//     context.drawImage(video, 0, 0, 320, 240); //расположение снимка в окне браузера (1 и 2), размер выводимого изображения (3 и 4)
// });

