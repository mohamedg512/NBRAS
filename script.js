document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault(); // منع الإرسال الافتراضي للنموذج

    // الحصول على القيم من الحقول
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    // دالة التحقق من البريد الإلكتروني
    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // دالة التحقق من كلمة المرور
    function validatePassword(password) {
        return password.length >= 6; // التأكد من أن كلمة المرور تحتوي على 6 أحرف على الأقل
    }

    // التحقق من المدخلات
    let valid = true;

    // تحقق من البريد الإلكتروني
    if (!validateEmail(email)) {
        document.querySelector('.email .error-txt').textContent = 'Please enter a valid email.';
        document.querySelector('.email .error-txt').style.display = 'block';
        valid = false;
    } else {
        document.querySelector('.email .error-txt').style.display = 'none';
    }

    // تحقق من كلمة المرور
    if (!validatePassword(password)) {
        document.querySelector('.password .error-txt').textContent = 'Password must be at least 6 characters long.';
        document.querySelector('.password .error-txt').style.display = 'block';
        valid = false;
    } else {
        document.querySelector('.password .error-txt').style.display = 'none';
    }

    // تحقق من تأكيد كلمة المرور
    if (password !== confirmPassword) {
        document.querySelector('.confirm-password .error-txt').textContent = 'Passwords do not match.';
        document.querySelector('.confirm-password .error-txt').style.display = 'block';
        valid = false;
    } else {
        document.querySelector('.confirm-password .error-txt').style.display = 'none';
    }

    // إذا كانت جميع المدخلات صحيحة، يمكنك تقديم النموذج هنا
    if (valid) {
        alert('Registration successful!'); // هنا يمكنك استبدال التنبيه بإجراء آخر
    }
});
