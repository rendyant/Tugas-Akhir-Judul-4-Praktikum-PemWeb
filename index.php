<?php
session_start();
if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}
function e($v) { 
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); 
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kontak Saya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 p-6">
    
    <div class="max-w-5xl mx-auto">
        
        <!-- Header -->
        <div class="bg-white/60 backdrop-blur-sm rounded-3xl shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">📇 Kontak</h1>
                    <p class="text-gray-600 text-sm mt-1">
                        <?= count($_SESSION['contacts']) ?> kontak tersimpan
                    </p>
                </div>
                <a href="add.php" 
                   class="bg-purple-200 hover:bg-purple-300 text-purple-800 font-medium px-5 py-2.5 rounded-full transition-colors">
                    + Tambah
                </a>
            </div>
        </div>

        <!-- Konten -->
        <?php if (empty($_SESSION['contacts'])): ?>
            <div class="bg-white/60 backdrop-blur-sm rounded-3xl shadow-sm p-12 text-center">
                <div class="text-5xl mb-3">📭</div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Belum ada kontak</h2>
                <p class="text-gray-600 mb-5">Mulai tambahkan kontak pertama Anda</p>
                <a href="add.php" 
                   class="inline-block bg-purple-200 hover:bg-purple-300 text-purple-800 font-medium px-6 py-2.5 rounded-full transition-colors">
                    + Tambah Kontak
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <?php foreach ($_SESSION['contacts'] as $id => $c): ?>
                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl shadow-sm p-5 hover:shadow-md transition-shadow">
                        <div class="mb-4">
                            <h2 class="text-xl font-bold text-gray-800 mb-3"><?= e($c['name']) ?></h2>
                            
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center gap-2 text-gray-700">
                                    <span>📧</span>
                                    <span><?= e($c['email']) ?></span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-700">
                                    <span>📱</span>
                                    <span><?= e($c['phone']) ?></span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-700">
                                    <span>📍</span>
                                    <span><?= e($c['city']) ?></span>
                                </div>
                                <?php if (!empty($c['notes'])): ?>
                                    <div class="pt-2 mt-2 border-t border-gray-200">
                                        <p class="text-gray-600 italic"><?= e($c['notes']) ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="edit.php?id=<?= $id ?>" 
                               class="flex-1 text-center bg-yellow-200 hover:bg-yellow-300 text-yellow-800 font-medium py-2 rounded-full transition-colors text-sm">
                                Edit
                            </a>
                            <form action="delete.php" method="POST" class="flex-1" 
                                  onsubmit="return confirm('Hapus kontak <?= e($c['name']) ?>?')">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <button type="submit" 
                                        class="w-full bg-pink-200 hover:bg-pink-300 text-pink-800 font-medium py-2 rounded-full transition-colors text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">
                💡 Rendy Antono | Contact Management 2025
            </p>
        </div>

    </div>

</body>
</html>