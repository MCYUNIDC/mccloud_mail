<?php
session_start();
$message = $_SESSION['message'] ?? '无状态信息';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <title>安装程序 - 步骤 3</title>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-slide-in {
            opacity: 0;
            animation: slideIn 0.8s ease-out forwards;
        }

        .animate-delay-100 {
            animation-delay: 0.3s;
        }

        .animate-delay-200 {
            animation-delay: 0.6s;
        }

        .animate-delay-300 {
            animation-delay: 0.9s;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <div class="flex min-h-screen flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md animate-fade-in">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">安装向导</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                第三步：安装完成
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md animate-fade-in animate-delay-100">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="text-center">
                    <?php if (strpos($message, '成功') !== false): ?>
                        <div class="mb-6 animate-fade-in animate-delay-200">
                            <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <p class="mt-4 text-lg font-medium text-gray-900"><?php echo $message; ?></p>
                        </div>
                    <?php else: ?>
                        <div class="mb-6 animate-fade-in animate-delay-200">
                            <svg class="mx-auto h-16 w-16 text-red-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <p class="mt-4 text-lg font-medium text-gray-900"><?php echo $message; ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="mt-6 animate-fade-in animate-delay-300">
                        <a href="index.php"
                            class="inline-flex items-center justify-center w-full rounded-md border border-transparent bg-blue-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-400">
                            返回首页
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>