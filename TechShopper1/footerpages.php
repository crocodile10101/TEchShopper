
<footer class="bg-dark text-white py-4">
    
<div class="container mt-5 p-5" style="background-color: #f8f9fa; border-radius: 10px;">
    <div class="row">
        <div class="col-md-6">
            <h3 style="color: black !important;">Поможем решить все вопросы</h3>
            <p style="color: black !important;">Если вы хотите узнать больше о TechShopper или не знаете, какой курс выбрать, оставьте заявку — и мы свяжемся с вами.</p>
        </div>
        <div class="col-md-6">
            <form action="submit_contact.php" method="POST">
                <div class="form-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Имя" required>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select name="country_code" class="form-control" style="max-width: 80px;">
                                <option value="ru">🇷🇺 +7</option>
                                <option value="ua">🇺🇦 +380</option>
                                <!-- Добавьте другие страны по необходимости -->
                            </select>
                        </div>
                        <input type="tel" name="phone" class="form-control" placeholder="Телефон" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Электронная почта" required>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Отправить</button>
                </div>
                <p style="font-size: 12px; color: black;">
                    Нажимая на кнопку, я соглашаюсь на <a href="#" style="color: darkblue !important;">обработку персональных данных</a> и с <a href="#" style="color: darkblue !important;">правилами пользования платформой</a>.
                </p>
            </form>
        </div>
    </div>
</div>


      <div class="container">
          <div class="row">
              <!-- Первый столбец: информация о компании -->
              <div class="col-md-4">
                  <h5>О компании</h5>
                  <p>TechShopper — это платформа для обучения и вдохновения, помогающая вам погружаться в мир технологий и IT.</p>
                  <p>Мы предлагаем курсы, которые помогут вам стать профессионалом в различных IT-областях.</p>
              </div>
              <!-- Второй столбец: полезные ссылки -->
              <div class="col-md-4">
                  <h5>Полезные ссылки</h5>
                  <ul class="list-unstyled">
                      <li><a href="#" class="text-white">Наши курсы</a></li>
                      <li><a href="#" class="text-white">Медиа материалы</a></li>
                      <li><a href="#" class="text-white">Для детей</a></li>
                      <li><a href="#" class="text-white">Свяжитесь с нами</a></li>
                  </ul>
              </div>
              <!-- Третий столбец: контактная информация -->
              <div class="col-md-4">
                  <h5>Контакты</h5>
                  <p>Адрес: ул. IT, 123, Москва</p>
                  <p>Телефон: +7 123 456 7890</p>
                  <p>Email: info@techshopper.ru</p>
              </div>
          </div>
      </div>
  </footer>