<?php

return array(
    
    // Titles
    'titles'    => array(
        'database_setting'              => 'Настройки базы данных',
        'authentication_setting'        => 'Настройки проверки подлинности',
        'create_account'                => 'Создание учетной записи администратора',
        'application_information'       => 'Сведения о приложении'
    ),
    
    // Labels    
    'labels'    => array(
        'database'                      => 'База данных',
        'database_type'                 => 'Тип базы данных',
        'database_host'                 => 'Хост базы данных',
        'database_username'             => 'Пользователь',
        'database_password'             => 'Пароль',
        'database_connection'           => 'Подключение',
        'database_connection_success'   => 'Выполненно',
        'database_connection_fail'      => 'Ошибка',
        
        'auth_driver'                   => 'Драйвер',
        'auth_table'                    => 'Таблица',
        'auth_model'                    => 'Модель',
        'auth_username'                 => 'Логин',
        'auth_password'                 => 'Пароль',
        'auth_email'                    => 'Email',
        'auth_fullname'                 => 'Имя',
        
        'app_site_name'                 => 'Название сайта',
        'app_site_email'                => 'Email для связи',
    ),
    
    // Tabs
    'tabs'      => array(
        'database'                      => '1. Проверка конфигурации базы данных',
        'account'                       => '2. Создание учетной записи администратора',
        'done'                          => '3. Завершение установки',
    ),
    
    // Errors
    'errors'    => array(
        'auth_table'                    => 'Имя таблицы должно быть `users`',
        'auth_model'                    => 'Имя модели должно быть `Hybrid\Model\User`'
    ),
    
    // Messages
    'messages'  => array(),
    
    // Hints
    'hints'     => array(
        'auth'                          => 'Пожайлуста убедитесь в правильности конфигурации: application/config/auth.php'
    ),
    
    // Emails
    'emails'    => array(),
);