<?php
ob_start();
session_start();

$current_url = "http" . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 's' : '') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parsed_url = parse_url($current_url);
$domain = $parsed_url['host'];

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['db_host'])) {
    $_SESSION['db_info'] = $_POST;
    header('Location: step2.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <title>MC云 - 安装向导</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
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

        /* 按钮过渡效果也调整得更平滑 */
        .transition-all {
            transition: all 0.4s ease-in-out;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <div class="flex min-h-screen flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md animate-fade-in">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">安装向导</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                第一步：配置数据库信息
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md animate-fade-in animate-delay-100">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form method="POST" action="" class="space-y-6">
                    <div>
                        <label for="db_host" class="block text-sm font-medium text-gray-700">数据库主机</label>
                        <div class="mt-1">
                            <input type="text" id="db_host" name="db_host" value="127.0.0.1" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="db_user" class="block text-sm font-medium text-gray-700">数据库用户名</label>
                        <div class="mt-1">
                            <input type="text" id="db_user" name="db_user" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="db_pass" class="block text-sm font-medium text-gray-700">数据库密码</label>
                        <div class="mt-1">
                            <input type="password" id="db_pass" name="db_pass" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="db_name" class="block text-sm font-medium text-gray-700">数据库名称</label>
                        <div class="mt-1">
                            <input type="text" id="db_name" name="db_name" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="user_domain" class="block text-sm font-medium text-gray-700">站点域名</label>
                        <div class="mt-1">
                            <input type="text" id="user_domain" name="user_domain"
                                value="https://<?php echo $domain; ?>" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            下一步
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
ob_end_flush();
?>