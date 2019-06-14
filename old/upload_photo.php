<?php
//header('/Hakaton_2019');
//    move_uploaded_file($_FILES['photo']['name'], '/photo'.$_FILES['photo']['name']);
//    echo 'Ответ от сервера: '.$_FILES['photo']['name']; //обращаемся к photo, из выбранных нами файлов, и возвращаем name данного файла (сервер должен вернуть имя выбранного нами файла)
//header('location: /photo');
//if(empty($_FILES)) {}
//else {
//    move_uploaded_file($_FILES['photo']['name'], '/photo'.$_FILES['photo']['name']);
    echo 'Ответ от сервера: '.$_FILES['photo']['name'];
//}
?>