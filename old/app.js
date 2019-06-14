const input = document.querySelector('input[type=file]');

input.addEventListener('change', function (ev) { //сработало событие Change и мы получили список всех файлов
    //
    const files = ev.target.files; //массив files, список файлов, которые мы можем выбрать для передачи на сервер

    // console.log(files);
    const file = files[0]; //массив в котором будем хранить только первый его элемент (т.е. один файл)

    const formData = new FormData();

    formData.append('photo', file);

    const request = new XMLHttpRequest();

    request.addEventListener('load', function () { //событие сработает, когда мы получим ответ от сервера
        console.log(request.responseText);
    });

    request.open('POST', '/upload_photo.php');
    request.send(formData);

    // fetch('upload_photo.php', {body: formData, method: 'POST'})
    //     .then(
    //         function (data) { //сработает, если вернется успех
    //             // console.log(data.text());
    //             return data.text();
    //         },
    //         function (data) { //сработает, если не вернется успех
    //
    //         }
    //     )
    //     .then(function (data) { //сработает, если вернется успех
    //         // console.log(data);
    //     }, function (data) { //сработает, если не вернется успех
    //
    //     })
});