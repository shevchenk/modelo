--2019-03-10 12:55
CREATE TABLE `am_locales_ambientes` (
`id`  int NOT NULL AUTO_INCREMENT ,
`ambiente`  varchar(100) NOT NULL DEFAULT '' ,
`tipo_ambiente`  int NOT NULL DEFAULT 1 COMMENT '1: Aula | 2: Laboratorio | 3:Libre' ,
`pabellon_id`  int NOT NULL DEFAULT 1 ,
`piso`  int NOT NULL DEFAULT 1 ,
`aforo`  int NOT NULL DEFAULT 0 ,
`estado`  int(1) NOT NULL DEFAULT 1 ,
`created_at`  datetime NOT NULL ,
`updated_at`  datetime NULL ,
`persona_id_created_at`  int NOT NULL ,
`persona_id_updated_at`  int NULL ,
PRIMARY KEY (`id`)
)
;

CREATE TABLE `am_locales_pabellones` (
`id`  int NOT NULL AUTO_INCREMENT ,
`local_id`  int NOT NULL ,
`pabellon`  varchar(150) NOT NULL ,
`estado`  int(1) NOT NULL DEFAULT 1 ,
`created_at`  datetime NOT NULL ,
`updated_at`  datetime NULL ,
`persona_id_created_at`  int NOT NULL ,
`persona_id_updated_at`  int NULL ,
PRIMARY KEY (`id`),
CONSTRAINT `am_local_id` FOREIGN KEY (`local_id`) REFERENCES `am_locales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)
;

ALTER TABLE `am_locales_ambientes`
MODIFY COLUMN `pabellon_id`  int(11) NOT NULL DEFAULT 1 AFTER `id`,
ADD COLUMN `local_id`  int NULL AFTER `id`;

ALTER TABLE `am_locales_ambientes` ADD CONSTRAINT `amla_local_id` FOREIGN KEY (`local_id`) REFERENCES `am_locales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `am_locales_ambientes` ADD CONSTRAINT `amla_pabellon_id` FOREIGN KEY (`pabellon_id`) REFERENCES `am_locales_pabellones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


