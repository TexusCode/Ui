console.log('hello');

// Получаем текст кнопки
let $a = document.querySelector('button').textContent;
console.log($a);

// Задержка 5 секунд (асинхронно)
setTimeout(() => {
    // Меняем текст кнопки
    document.querySelector('button').textContent = document.querySelector('button').name;

    // Получаем новый текст кнопки
    let $b = document.querySelector('button').textContent;
    console.log($b);
}, 5000);