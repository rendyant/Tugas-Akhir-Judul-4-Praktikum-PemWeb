<?php
session_start();
if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}

$name = $email = $phone = $city = $notes = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $city  = trim($_POST['city'] ?? '');
    $notes = trim($_POST['notes'] ?? '');

    if ($name === '' || mb_strlen($name) < 3) {
        $errors[] = "Nama minimal 3 karakter.";
    } elseif (!preg_match('/^[\p{L}\s]+$/u', $name)) {
        $errors[] = "Nama hanya boleh huruf dan spasi.";
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }

    if ($phone === '' || !preg_match('/^[0-9]{10,15}$/', $phone)) {
        $errors[] = "Nomor HP harus 10-15 digit angka.";
    }

    if ($city === '' || mb_strlen($city) < 2) {
        $errors[] = "Kota minimal 2 karakter.";
    }

    if ($notes !== '' && mb_strlen($notes) < 5) {
        $errors[] = "Catatan minimal 5 karakter.";
    }

    if (empty($errors)) {
        $_SESSION['contacts'][] = [
            'name'  => $name,
            'email' => $email,
            'phone' => $phone,
            'city'  => $city,
            'notes' => $notes
        ];
        header("Location: index.php");
        exit;
    }
}

function e($v) { 
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); 
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Tambah Kontak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 p-6">
    
    <div class="max-w-2xl mx-auto">
        
        <!-- Back Button -->
        <div class="mb-5">
            <a href="index.php" 
               class="inline-flex items-center gap-1 text-purple-700 hover:text-purple-900 font-medium text-sm">
                ← Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white/60 backdrop-blur-sm rounded-3xl shadow-sm p-8">
            
            <h1 class="text-2xl font-bold text-gray-800 mb-6">➕ Tambah Kontak</h1>

            <!-- Error Messages -->
            <?php if (!empty($errors)): ?>
                <div class="bg-pink-100/70 border border-pink-200 rounded-2xl p-4 mb-6">
                    <p class="font-semibold text-pink-800 mb-2">⚠️ Perhatikan:</p>
                    <ul class="space-y-1 text-sm text-pink-700">
                        <?php foreach ($errors as $error): ?>
                            <li>• <?= e($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div> 
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" class="space-y-5">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                    <input type="text" 
                           name="name" 
                           value="<?= e($name) ?>"
                           required 
                           minlength="3"
                           placeholder="Nama lengkap"
                           class="w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" 
                           name="email" 
                           value="<?= e($email) ?>"
                           required
                           placeholder="email@contoh.com"
                           class="w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                    <input type="tel" 
                           name="phone" 
                           value="<?= e($phone) ?>"
                           required
                           pattern="[0-9]{10,15}"
                           placeholder="081234567890"
                           class="w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kota</label>
                    <input type="text" 
                           name="city" 
                           value="<?= e($city) ?>"
                           required
                           placeholder="Kota asal"
                           class="w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (opsional)</label>
                    <textarea name="notes" 
                              rows="3"
                              placeholder="Catatan tambahan..."
                              class="w-full px-4 py-3 bg-white/50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-300 transition-all resize-none"><?= e($notes) ?></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" 
                            class="flex-1 bg-purple-200 hover:bg-purple-300 text-purple-800 font-semibold py-3 rounded-full transition-colors">
                        Simpan
                    </button>
                    <a href="index.php" 
                       class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 rounded-full transition-colors">
                        Batal
                    </a>
                </div>

            </form>

        </div>

    </div>

</body>
</html>