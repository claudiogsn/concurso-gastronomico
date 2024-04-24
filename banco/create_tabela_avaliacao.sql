CREATE TABLE `tabela_avaliacao` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`restaurante` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`cupom_fiscal` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`nome` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`cpf` VARCHAR(14) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`telefone` VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`avaliacao` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`atendimento` INT(11) NULL DEFAULT NULL,
	`qualidade` INT(11) NULL DEFAULT NULL,
	`apresentacao` INT(11) NULL DEFAULT NULL,
	`media_geral` FLOAT NULL DEFAULT NULL,
	`ip_request` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=14
;
