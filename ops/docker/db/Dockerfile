FROM mariadb:10.0

COPY docker-healthcheck /usr/local/bin/

RUN chmod +x /usr/local/bin/docker-healthcheck

HEALTHCHECK --interval=1s --timeout=1s --retries=60 \
    CMD ["/usr/local/bin/docker-healthcheck"]

COPY conf.d/ /etc/mysql/conf.d/