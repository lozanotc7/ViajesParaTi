CREATE DATABASE `app`;

CREATE TABLE app.tipo
(
    id   INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(20)        NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci`
  ENGINE = InnoDB;


CREATE TABLE app.proveedor
(
    id        INT AUTO_INCREMENT NOT NULL,
    tipo_id   INT                NOT NULL,
    name      VARCHAR(255)       NOT NULL,
    email     VARCHAR(255)       NOT NULL,
    phone     VARCHAR(15)        NOT NULL,
    is_active TINYINT(1)         NOT NULL,
    created   DATETIME           NOT NULL,
    updated   DATETIME           NOT NULL,
    INDEX IDX_16C068CEA9276E6C (tipo_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci`
  ENGINE = InnoDB;


ALTER TABLE app.proveedor
    ADD CONSTRAINT FK_16C068CEA9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo (id);