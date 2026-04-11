<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <title>Liên hệ - CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <div class="max-w-2xl mx-auto py-20 px-6">
        <h2 class="text-3xl font-bold text-blue-800 mb-6">Gửi liên hệ cho chúng tôi</h2>
        
        <form id="contactForm" action="process-contact.php" method="POST" onsubmit="return validateForm()" class="bg-white p-8 rounded-3xl shadow-lg">
            <div class="mb-4">
                <label class="block mb-2 font-bold">Họ và tên</label>
                <input type="text" id="fullname" name="customer_name" class="w-full p-3 border rounded-xl" placeholder="Nguyễn Văn A">
                <p id="error-name" class="text-red-500 text-sm hidden">Vui lòng nhập họ tên ít nhất 3 ký tự.</p>
            </div>
            
            <div class="mb-4">
                <label class="block mb-2 font-bold">Email</label>
                <input type="email" id="email" name="customer_email" class="w-full p-3 border rounded-xl" placeholder="email@vi du.com">
                <p id="error-email" class="text-red-500 text-sm hidden">Email không hợp lệ.</p>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold">Lời nhắn</label>
                <textarea id="message" name="message" rows="4" class="w-full p-3 border rounded-xl"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold hover:bg-blue-700 transition">Gửi tin nhắn</button>
        </form>
    </div>

    <script>
    function validateForm() {
        let isValid = true;
        const name = document.getElementById('fullname').value;
        const email = document.getElementById('email').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(name.length < 3) {
            document.getElementById('error-name').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('error-name').classList.add('hidden');
        }

        if(!emailRegex.test(email)) {
            document.getElementById('error-email').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('error-email').classList.add('hidden');
        }

        return isValid; // Chỉ submit nếu tất cả hợp lệ [cite: 63]
    }
    </script>
</body>
</html>