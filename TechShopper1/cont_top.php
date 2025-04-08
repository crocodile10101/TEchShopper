  
   <!-- КОНТАКТЫ -->
<!-- Иконка контактов -->
<div class="contact-icon" id="contactIcon">
  ☎️
</div>

<!-- Модальное окно с контактной информацией -->
<div class="contact-modal" id="contactModal">
  <div class="contact-modal-header">
      <h5>Наши контакты</h5>
      <button class="close-btn" id="closeModal">&times;</button>
  </div>
  <hr>
  <a href="https://t.me/techshopper_bot" target="_blank" style="color: black !important;">📱 Telegram</a>
  <a href="https://wa.me/yourwhatsapp" target="_blank" style="color: black !important;">📞 WhatsApp</a>
  <a href="https://vk.com/yourvk" target="_blank" style="color: black !important;">🖥️ ВКонтакте</a>
  <a href="https://youtube.com/youryoutube" target="_blank" style="color: black !important;">🎥 YouTube</a>
  <a href="mailto:youremail@example.com" style="color: black !important;">📧 Email</a>
</div>

<!-- Кнопка "Наверх" -->
<div class="back-to-top" id="backToTop">
  ↑
</div>

<script>
  const contactIcon = document.getElementById('contactIcon');
  const contactModal = document.getElementById('contactModal');
  const closeModal = document.getElementById('closeModal');
  const backToTop = document.getElementById('backToTop');

  // Показывать окно контактов при клике на иконку
  contactIcon.addEventListener('click', function() {
      contactModal.style.display = 'block';
  });

  // Закрыть окно контактов
  closeModal.addEventListener('click', function() {
      contactModal.style.display = 'none';
  });

  // Закрыть окно при клике вне его
  window.addEventListener('click', function(event) {
      if (event.target === contactModal) {
          contactModal.style.display = 'none';
      }
  });

  // Показать кнопку "Наверх" при прокрутке страницы вниз
  window.onscroll = function() {
      if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
          backToTop.style.display = "flex";
      } else {
          backToTop.style.display = "none";
      }
  };

  // Прокрутка наверх при нажатии на кнопку "Наверх"
  backToTop.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
  });
</script>
   <!-- КОНТАКТЫ -->