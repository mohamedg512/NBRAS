<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root"; // الافتراضي في XAMPP
$password = ""; // الافتراضي في XAMPP
$dbname = "datadawa"; // اسم قاعدة البيانات

$conn = new mysqli($servername, $username, $password, $dbname);

// تحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// الحصول على البيانات من النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $phone = $_POST['phone']; // الحصول على رقم الهاتف من النموذج
    $password = $_POST['password'];
    $country = $_POST['country']; // حقل الدولة
    $confirm_password = $_POST['confirm-password'];

    // التحقق من تطابق كلمة المرور
    if ($password != $confirm_password) {
        echo "كلمة المرور غير متطابقة!";
    } else {
        // تشفير كلمة المرور
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // إدخال البيانات في قاعدة البيانات
        $sql = "INSERT INTO users_with_country (email, phone, password, country) VALUES ('$email', '$phone', '$hashed_password', '$country')";

        if ($conn->query($sql) === TRUE) {
            echo "تم التسجيل بنجاح!";
        } else {
            echo "خطأ في التسجيل: " . $conn->error;
        }
    }
}

// إغلاق الاتصال
$conn->close();
?>
