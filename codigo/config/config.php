<?php

// Arquivo de configuração com as constantes do sistema

define('ARQUIVO_JSON', __DIR__ . '/../data/itens.json');
define('ARQUIVO_USUARIOS', __DIR__ . '/../data/usuarios.json');
define('DIARIA_FILME', 20.00);
define('DIARIA_SERIE', 5.00);
define('DIARIA_NOVELA', 2.00);
define('DIARIA_DESENHO', 5.00);

// Definições de caminhos
define('UPLOAD_DIR', __DIR__ . '/../img/uploads/');

// Configurações de upload
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);