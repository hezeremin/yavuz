<?php

    try {
        $pdo = new PDO(dsn: "sqlite:db/quizapp.db");

        $pdo->setAttribute(attribute: PDO::ATTR_DEFAULT_FETCH_MODE, value: PDO::FETCH_ASSOC);

    } catch (\Throwable $th) {
        echo "Hata " . $th;
    }



?>