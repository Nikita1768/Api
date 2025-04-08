FROM php:8.2.3-fpm

# Объявляем переменные
ARG user
ARG uid

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    default-mysql-server \
    default-mysql-client \
    build-essential \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libonig-dev \
    libxml2-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    libpq-dev \
    zlib1g-dev \
    libzip-dev \
    libz-dev \
    libwebp-dev \
    sudo

# Очистка кэша
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Устанавливаем PHP расширения
RUN docker-php-ext-install intl pdo pdo_mysql mbstring exif pcntl bcmath zip gettext

# Получаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Добавляем отладочную информацию для переменных окружения
RUN echo "UID: ${uid}" && echo "USER: ${user}"

# Добавляем пользователя для Laravel приложения (с проверкой)
RUN if ! getent group ${user}; then groupadd -g ${uid} ${user}; fi && \
    if ! id -u ${user} > /dev/null 2>&1; then useradd -u ${uid} -ms /bin/bash -g ${user} ${user}; fi

# Копируем содержимое проекта в контейнер
COPY . /var/www

# Устанавливаем права на файлы
COPY --chown=${uid}:${user} . /var/www

# Меняем пользователя
USER ${user}

# Открываем порт 9000 для php-fpm
EXPOSE 9000
CMD ["php-fpm"]
