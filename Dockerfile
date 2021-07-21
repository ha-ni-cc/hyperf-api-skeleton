# Default Dockerfile
#
# @link     https://www.hyperf.io
# @document https://doc.hyperf.io
# @contact  group@hyperf.io
# @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE

FROM hyperf/hyperf:7.4-alpine-v3.11-swoole-v4.5.11
LABEL maintainer="Hyperf Developers <group@hyperf.io>" version="1.0" license="MIT" app.name="Hyperf"

##
# ---------- env settings ----------
##
# --build-arg timezone=Asia/Shanghai
ARG timezone
ARG port

ENV TIMEZONE=${timezone:-"Asia/Shanghai"} \
    ENV_FILE=test

# update
RUN set -ex \
#    && apk update \
    # install composer
#    && cd /tmp \
#    && wget https://mirrors.aliyun.com/composer/composer.phar \
#    && chmod u+x composer.phar \
#    && mv composer.phar /usr/local/bin/composer \
    # show php version and extensions
    && php -v \
    && php -m \
    && php --ri swoole \
    #  ---------- some config ----------
    && cd /etc/php7 \
    # - config PHP
    && { \
        echo "upload_max_filesize=100M"; \
        echo "post_max_size=108M"; \
        echo "memory_limit=1024M"; \
        echo "date.timezone=${TIMEZONE}"; \
    } | tee conf.d/99_overrides.ini \
    # - config timezone
    && ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    # ---------- clear works ----------
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man \
    && echo -e "\033[42;37m Build Completed :).\033[0m\n"

WORKDIR /opt/www

COPY . /opt/www

RUN rm -rf runtime && rm -rf public && rm -f .env

RUN php bin/hyperf.php

RUN rm -rf .git && rm -rf .idea && rm -f .DS_Store && rm -f .gitignore && rm -f docker.sh && rm -f watch.sh

EXPOSE ${port}

ENTRYPOINT ["bash", "entrypoint.sh"]