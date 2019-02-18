--2019-02-14 01:23
ALTER TABLE `cp_plan_estudios`
CHANGE COLUMN `perfil_egreso` `perfil_profesional`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `plan_estudio`;
ALTER TABLE `cp_plan_estudios`
MODIFY COLUMN `plan_estudio`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `carrera_id`;

--2019-02-15 11:55
ALTER TABLE `cm_carreras`
ADD COLUMN `codigo`  varchar(20) NULL DEFAULT '' AFTER `carrera`;

--2019-02-16 03:59
ALTER TABLE `cp_plan_estudios`
ADD COLUMN `regimen_estudio`  int NULL DEFAULT 6 AFTER `fecha_resolucion`,
ADD COLUMN `regimen_otro`  varchar(150) NULL DEFAULT '' AFTER `regimen_estudio`,
ADD COLUMN `periodo_academico`  int NULL DEFAULT 2 AFTER `regimen_otro`,
ADD COLUMN `duracion`  int NULL DEFAULT 5 AFTER `periodo_academico`,
ADD COLUMN `credito_teoria`  int NULL DEFAULT 16 AFTER `duracion`,
ADD COLUMN `credito_practica`  int NULL DEFAULT 32 AFTER `credito_teoria`;

--2019-02-16 14:32
ALTER TABLE `cp_plan_estudios_detalles`
MODIFY COLUMN `ciclo_id`  int(11) NOT NULL AFTER `plan_estudio_id`,
CHANGE COLUMN `pre_requisitos` `requisitos`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'Requisitos para llevar el curso' AFTER `curso_id`,
CHANGE COLUMN `creditos` `tipo_estudio`  int(11) NOT NULL DEFAULT 1 COMMENT '1: General | 2: Específico | 3: Especialidad' AFTER `requisitos`,
CHANGE COLUMN `hora_teoria` `tipo_curso`  int(11) NOT NULL DEFAULT 1 COMMENT '1: Obligatorio | 0: Electivo' AFTER `tipo_estudio`,
CHANGE COLUMN `hora_practica` `hora_teoria_presencial`  int(11) NOT NULL DEFAULT 0 AFTER `tipo_curso`,
CHANGE COLUMN `hora_laboratorio` `hora_teoria_virtual`  int(11) NOT NULL DEFAULT 0 AFTER `hora_teoria_presencial`,
CHANGE COLUMN `total_horas` `hora_teoria_total`  int(11) NOT NULL DEFAULT 0 AFTER `hora_teoria_virtual`,
CHANGE COLUMN `total_presencial` `hora_practica_presencial`  int(11) NOT NULL DEFAULT 0 AFTER `hora_teoria_total`,
CHANGE COLUMN `total_virtual` `hora_practica_virtual`  int(11) NOT NULL DEFAULT 0 AFTER `hora_practica_presencial`,
CHANGE COLUMN `electivo` `hora_practica_total`  int(11) NOT NULL DEFAULT 0 AFTER `hora_practica_virtual`,
ADD COLUMN `hora_total`  int NULL DEFAULT 0 AFTER `hora_practica_total`,
ADD COLUMN `credito_teoria_presencial`  int NULL DEFAULT 0 AFTER `hora_total`,
ADD COLUMN `credito_teoria_virtual`  int NULL DEFAULT 0 AFTER `credito_teoria_presencial`,
ADD COLUMN `credito_teoria_total`  int NULL DEFAULT 0 AFTER `credito_teoria_virtual`,
ADD COLUMN `credito_practica_presencial`  int NULL DEFAULT 0 AFTER `credito_teoria_total`,
ADD COLUMN `credito_practica_virtual`  int NULL DEFAULT 0 AFTER `credito_practica_presencial`,
ADD COLUMN `credito_practica_total`  int NULL DEFAULT 0 AFTER `credito_practica_virtual`,
ADD COLUMN `credito_total`  int NULL DEFAULT 0 AFTER `credito_practica_total`;

--2019-02-16 15:43
ALTER TABLE `cp_plan_estudios_detalles`
MODIFY COLUMN `credito_teoria_presencial`  decimal(10,2) NULL DEFAULT 0 AFTER `hora_total`,
MODIFY COLUMN `credito_teoria_virtual`  decimal(10,2) NULL DEFAULT 0 AFTER `credito_teoria_presencial`,
MODIFY COLUMN `credito_teoria_total`  decimal(10,2) NULL DEFAULT 0 AFTER `credito_teoria_virtual`,
MODIFY COLUMN `credito_practica_presencial`  decimal(10,2) NULL DEFAULT 0 AFTER `credito_teoria_total`,
MODIFY COLUMN `credito_practica_virtual`  decimal(10,2) NULL DEFAULT 0 AFTER `credito_practica_presencial`,
MODIFY COLUMN `credito_practica_total`  decimal(10,2) NULL DEFAULT 0 AFTER `credito_practica_virtual`,
MODIFY COLUMN `credito_total`  decimal(10,2) NULL DEFAULT 0 AFTER `credito_practica_total`;

--2019-02-16 15:44
ALTER TABLE `cp_plan_estudios_detalles`
MODIFY COLUMN `hora_total`  int(11) NOT NULL DEFAULT 0 AFTER `hora_practica_total`,
MODIFY COLUMN `credito_teoria_presencial`  decimal(10,2) NOT NULL DEFAULT 0.00 AFTER `hora_total`,
MODIFY COLUMN `credito_teoria_virtual`  decimal(10,2) NOT NULL DEFAULT 0.00 AFTER `credito_teoria_presencial`,
MODIFY COLUMN `credito_teoria_total`  decimal(10,2) NOT NULL DEFAULT 0.00 AFTER `credito_teoria_virtual`,
MODIFY COLUMN `credito_practica_presencial`  decimal(10,2) NOT NULL DEFAULT 0.00 AFTER `credito_teoria_total`,
MODIFY COLUMN `credito_practica_virtual`  decimal(10,2) NOT NULL DEFAULT 0.00 AFTER `credito_practica_presencial`,
MODIFY COLUMN `credito_practica_total`  decimal(10,2) NOT NULL DEFAULT 0.00 AFTER `credito_practica_virtual`,
MODIFY COLUMN `credito_total`  decimal(10,2) NOT NULL DEFAULT 0.00 AFTER `credito_practica_total`;
