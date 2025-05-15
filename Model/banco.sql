CREATE SCHEMA IF NOT EXISTS `projeto_final` DEFAULT CHARACTER SET latin1;
USE `projeto_final`;

-- Table `projeto_final`.`usuario`
CREATE TABLE IF NOT EXISTS `projeto_final`.`usuario` (
  `idusuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NULL DEFAULT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `dataNascimento` DATE NULL DEFAULT NULL,
  `email` VARCHAR(150) NULL DEFAULT NULL,
  `senha` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- Table `projeto_final`.`formacaoAcademica`
CREATE TABLE IF NOT EXISTS `projeto_final`.`formacaoAcademica` (
  `idformacaoAcademica` INT(11) NOT NULL AUTO_INCREMENT,
  `idusuario` INT(11) NOT NULL,
  `inicio` DATE NOT NULL,
  `fim` DATE NULL DEFAULT NULL,
  `descricao` VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (`idformacaoAcademica`),
  INDEX `IDUSUARIO_idx` (`idusuario` ASC),
  CONSTRAINT `IDUSUARIO`
    FOREIGN KEY (`idusuario`)
    REFERENCES `projeto_final`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
