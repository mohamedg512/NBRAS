
  function toggleMenu() {
    const nav = document.querySelector('.main-nav');
    nav.classList.toggle('active');

    // إذا تم فتح القائمة، أضف مستمع للنقر في أي مكان على الصفحة
    if (nav.classList.contains('active')) {
      document.addEventListener('click', closeMenuOnClickOutside);
    } else {
      document.removeEventListener('click', closeMenuOnClickOutside);
    }
  }

  function closeMenuOnClickOutside(event) {
    const nav = document.querySelector('.main-nav');
    const hamburger = document.querySelector('.hamburger');

    // التحقق إذا كان الضغط خارج القائمة وأيقونة الهامبرغر
    if (!nav.contains(event.target) && !hamburger.contains(event.target)) {
      nav.classList.remove('active');
      document.removeEventListener('click', closeMenuOnClickOutside); // إزالة المستمع
    }
  }

