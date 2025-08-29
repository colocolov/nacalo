document.addEventListener("DOMContentLoaded", function () {
  // Настройки для наблюдателя
  const options = {
    threshold: 0.2, // Анимация сработает, когда 20% элемента видно
  };

  // Создаем наблюдателя
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      // Если элемент появился в области видимости
      if (entry.isIntersecting) {
        entry.target.classList.add("is-visible");
      } else {
        // Если элемент покинул область видимости,
        // убираем класс, чтобы анимация могла повториться
        entry.target.classList.remove("is-visible");
      }
    });
  }, options);

  // Находим ВСЕ анимируемые блоки и начинаем за ними следить
  const animatedElements = document.querySelectorAll('.head-animate, .animated-block');
  animatedElements.forEach((el) => {
    observer.observe(el);
  });
});