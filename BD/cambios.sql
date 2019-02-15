--2019-02-14 01:23
ALTER TABLE `cp_plan_estudios`
CHANGE COLUMN `perfil_egreso` `perfil_profesional`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `plan_estudio`;
ALTER TABLE `cp_plan_estudios`
MODIFY COLUMN `plan_estudio`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `carrera_id`;
