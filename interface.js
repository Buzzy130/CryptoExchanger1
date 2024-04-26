var id = 57; // Это ваша переменная

// Отправляем данные методом POST
fetch('http://cryptoexchanger/Endpoint.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'id=' + id  // Отправляем данные в виде URL-encoded формы
})
    .then(response => response.text())  // Получаем ответ от сервера
    .then(data => console.log(data))  // Выводим ответ сервера в консоль
    .catch(error => console.error('Ошибка:', error));