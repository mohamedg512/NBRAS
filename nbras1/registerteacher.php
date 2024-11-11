<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root"; // الافتراضي في XAMPP
$password = ""; // الافتراضي في XAMPP
$dbname = "datateacher"; // اسم قاعدة البيانات

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
    $confirm_password = $_POST['confirm-password'];

    // التحقق من تطابق كلمة المرور
    if ($password != $confirm_password) {
        echo "كلمة المرور غير متطابقة!";
    } else {
        // تشفير كلمة المرور
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // معالجة الملف
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_error = $file['error'];
            $file_size = $file['size'];

            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // التحقق من امتداد الملف (PDF أو Word فقط)
            if ($file_ext == 'pdf' || $file_ext == 'doc' || $file_ext == 'docx') {
                // تحديد المجلد الذي سيتم رفع الملفات فيه
                $upload_dir = 'uploads/';
                $file_new_name = uniqid('', true) . '.' . $file_ext;
                $file_destination = $upload_dir . $file_new_name;

                // نقل الملف إلى المجلد المحدد
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    // إدخال البيانات في قاعدة البيانات
                    $sql = "INSERT INTO users_with_file (email, phone, password, file_path) VALUES ('$email', '$phone', '$hashed_password', '$file_destination')";

                    if ($conn->query($sql) === TRUE) {
                        echo "تم التسجيل بنجاح!";
                    } else {
                        echo "خطأ في التسجيل: " . $conn->error;
                    }
                } else {
                    echo "حدث خطأ أثناء رفع الملف.";
                }
            } else {
                echo "الملف يجب أن يكون بتنسيق PDF أو Word فقط.";
            }
        } else {
            echo "يرجى تحميل ملف.";
        }
    }
}

// إغلاق الاتصال
$conn->close();
?>
