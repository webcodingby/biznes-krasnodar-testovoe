# biznes-krasnodar-testovoe
Необходимо создать приложение ToDo-лист на чистом php/js/mysql/css.
<br>
<ul>
  <li>
  - Заходим на главную страницу, там поле для ввода e-mail пользователя (с
валидацией на правильность e-mail, можно на клиенте, можно на сервере,
лучше и там и там) и кнопка Войти.
  </li>
  <li>- Ввели e-mail, нажали кнопку Войти. Если этот e-mail присутствует в базе,
авторизуем через сессию (просто флаг и id пользователя) и перекидываем
на страницу /tasks (если зайти не авторизовавшись на эту страницу, то
перекидывает на главную для авторизации). Если нет в базе, то создаем
запись и также авторизуем, перекидываем.
  </li>
  <li>
    - На странице /tasks, вверху поле для добавления задачи, выбор даты и
галочка Важное (для выделения задачи каким-либо образом, на усмотрение
исполнителя) и ниже список задач, отсортированный в порядке указанных
дат при создании
  </li>
  <li>
    - Список содержит: Текст, дату, выделение (если важное) и кнопки
Удалить/Отредактировать/Выполнено (с соотв. функционалом)
  </li>
  <li>
    - Проверять при удалении/редактировании владельца
  </li>
  <li>
    - Добавление/Удаление/Редактирование/Выполнено реализовать на ajax.
Перед удалением должен быть запрос подтверждения.
  </li>
  <li>
    - Реализовать пагинацию, по 5 задач на странице
  </li>
  <li>
    - Реализовать страницу администратора со списком пользователей и
соотв-ие им кол-ва задач. Запаролить эту страницу обычной http-basic
авторизацией
  <li>
  </li>
    - Без использования фреймворков, можно использовать отдельные
библиотеки
  </li>
  <li>
  - дизайн на усмотрение исполнителя, можно обычный бутстрап.
  </lk>
