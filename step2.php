<?php
session_start();

if (!isset($_SESSION['db_info'])) {
    header('Location: index.php');
    exit();
}
$db_info = $_SESSION['db_info'];
$sql_file_url = "https://mcsqz.stay33.cn/mail/shd_email_templates.sql";
$sql_file_path = __DIR__ . '/shd_email_templates.sql';
$user_domain = $db_info['user_domain'] ?? '';

if (empty($user_domain)) {
    $_SESSION['message'] = '请填写有效的域名';
    header('Location: index.php');
    exit();
}

// 数据库连接
$conn = new mysqli($db_info['db_host'], $db_info['db_user'], $db_info['db_pass'], $db_info['db_name']);
if ($conn->connect_error) {
    $_SESSION['message'] = "连接失败: " . $conn->connect_error;
    header('Location: index.php');
    exit();
}

// 删除旧表
$delete_table_query = "DROP TABLE IF EXISTS shd_email_templates";
if (!$conn->query($delete_table_query)) {
    $_SESSION['message'] = "删除表失败: " . $conn->error;
    $conn->close();
    header('Location: index.php');
    exit();
}

// 下载 SQL 文件
file_put_contents($sql_file_path, fopen($sql_file_url, 'r'));

// 替换 SQL 文件内容
$sql_content = file_get_contents($sql_file_path);
$updated_sql_content = str_replace('mccloud_url', $user_domain, $sql_content);
// 导入 SQL
if ($conn->multi_query($updated_sql_content)) {
    // 确保 SQL 文件导入完成后再删除
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());

    // 删除 SQL 文件
    if (file_exists($sql_file_path)) {
        unlink($sql_file_path); // 删除文件
    }

    $_SESSION['message'] = '数据导入成功，SQL 文件已删除！';
    header('Location: step3.php');
} else {
    $_SESSION['message'] = '数据导入失败: ' . $conn->error;
    // 删除 SQL 文件，即使导入失败
    if (file_exists($sql_file_path)) {
        unlink($sql_file_path);
    }
    header('Location: index.php');
}
$conn->close();
exit();
?>