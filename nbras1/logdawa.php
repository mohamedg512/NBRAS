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

// التحقق من البيانات المدخلة
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // استعلام للتحقق من البريد الإلكتروني وكلمة المرور
    $sql = "SELECT * FROM users_with_country WHERE email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // التحقق من تطابق كلمة المرور المدخلة مع كلمة المرور المشفرة المخزنة
        if (password_verify($password, $row['password'])) {
            // كلمة المرور صحيحة، إعادة التوجيه إلى الصفحة الرئيسية
            header("Location: ../index.html");
            exit();  // تأكد من التوقف هنا بعد التوجيه
        } else {
            echo "كلمة المرور غير صحيحة.";
        }
    } else {
        echo "البريد الإلكتروني غير مسجل.";
    }
}

// إغلاق الاتصال
$conn->close();
?>
