// Добавляем обработчик события, который выполнится после загрузки DOM
document.addEventListener('DOMContentLoaded', function() {
    // Отправляем запрос к PHP-скрипту для получения списка товаров
    fetch('get_products.php')
        .then(response => response.json()) // Преобразуем ответ в JSON
        .then(data => {
            const productSelect = document.getElementById('product_name'); // Получаем элемент select
            data.forEach(product => {
                const option = document.createElement('option'); // Создаем элемент option
                option.value = product.name; // Устанавливаем значение option
                option.textContent = product.name; // Устанавливаем текст option
                productSelect.appendChild(option); // Добавляем option в select
            });
        })
        .catch(error => console.error('Error:', error)); // Выводим ошибку в консоль, если запрос не удался
});

// Функция для отправки данных формы
function sendPurchase(event) {
    event.preventDefault(); // Предотвращаем стандартное поведение формы (перезагрузку страницы)
    let formData = new FormData(document.querySelector('form')); // Создаем объект FormData из данных формы

    // Отправляем POST-запрос с данными формы
    fetch('purchase.php', {
        method: 'POST', // Указываем метод отправки данных
        body: formData // Указываем данные для отправки
    })
        .then(response => response.text()) // Преобразуем ответ в текст
        .then(data => {
            document.getElementById('result').innerText = data; // Отображаем результат операции в элементе с id "result"
            document.querySelector('form').reset(); // Очищаем форму после отправки данных
        })
        .catch(error => console.error('Error:', error)); // Выводим ошибку в консоль, если запрос не удался
}
