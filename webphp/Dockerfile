FROM php:8.2-apache
LABEL authors="akatsuki"
# Install dependencies
# RUN apt-get update && apt-get install -y \
#     libfreetype6-dev \
#     libjpeg62-turbo-dev \
#     libpng-dev \
#     libwebp-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
#     && docker-php-ext-install -j$(nproc) gd

# Install dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install -j$(nproc) gd zip

RUN apt-get update -y && apt-get install -y sendmail libpng-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql 

# Clean up
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*


# RUN docker-php-ext-install mysql mysqli


RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev 

#RUN docker-php-ext-install mbstring

#RUN docker-php-ext-install zip
RUN apt-get update && apt-get install -y libpng-dev

# RUN docker-php-ext-install gd
#ENTRYPOINT ["top", "-b"]
