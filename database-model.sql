-- Deletar a tabela products caso exista
DROP TABLE IF EXISTS `smart_mvc`.`products`;

-- Criar a tabela products
CREATE TABLE IF NOT EXISTS `smart_mvc`.`products` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(190) NOT NULL,
	`value` DOUBLE(10,2) NOT NULL,
	`quantity` INT UNSIGNED NOT NULL,
	`description` TEXT NULL,
	PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- Inserir dados na tabela products
INSERT INTO `smart_mvc`.`products` (`id`, `name`, `value`, `quantity`, `description`) VALUES
(NULL, "Blusa Rosa", 10.99, 10, NULL),
(NULL, "Blusa Azul Bebê", 18.43, 40, NULL),
(NULL, "Blusa Amarela", 27.78, 20, NULL);
