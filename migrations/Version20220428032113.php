<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428032113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE personne');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08165C6DE3B4');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08165C6DE3B4 FOREIGN KEY (idPersonne) REFERENCES user (id)');
        $this->addSql('ALTER TABLE competance DROP FOREIGN KEY fk_competance_idPersonne');
        $this->addSql('ALTER TABLE competance ADD CONSTRAINT FK_1BB6FF285C6DE3B4 FOREIGN KEY (idPersonne) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demandestage DROP FOREIGN KEY FK_F8FC91A75C6DE3B4');
        $this->addSql('ALTER TABLE demandestage DROP FOREIGN KEY FK_F8FC91A7D5B8D074');
        $this->addSql('ALTER TABLE demandestage ADD CONSTRAINT FK_F8FC91A7FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demandestage ADD CONSTRAINT FK_F8FC91A7D5B8D074 FOREIGN KEY (idStage) REFERENCES stage (idStage)');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY entretien_ibfk_1');
        $this->addSql('ALTER TABLE entretien CHANGE idUser idUser INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DAFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY formation_ibfk_2');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY formation_ibfk_1');
        $this->addSql('ALTER TABLE formation CHANGE description description VARCHAR(1000) NOT NULL, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL, CHANGE domaine domaine VARCHAR(255) NOT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation DROP INDEX idUser, ADD INDEX fk_personneReservation (idUser)');
        $this->addSql('ALTER TABLE reservation CHANGE nom nom VARCHAR(1000) NOT NULL, CHANGE dateReservation dateReservation DATE DEFAULT NULL, CHANGE idFormation idFormation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937515C6DE3B4');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C93695C6DE3B4');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personne (idPersonne INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, tel INT NOT NULL, cin INT NOT NULL, email VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, datenaissance DATE NOT NULL, role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idFaculte INT DEFAULT NULL, pdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idSociete INT DEFAULT NULL, INDEX fk_societePersonne (idSociete), INDEX fk_facultePersonne (idFaculte), PRIMARY KEY(idPersonne)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF132E57FE FOREIGN KEY (idFaculte) REFERENCES faculte (idFaculte)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF9DC564F FOREIGN KEY (idSociete) REFERENCES societe (idSociete)');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08165C6DE3B4');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08165C6DE3B4 FOREIGN KEY (idPersonne) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competance DROP FOREIGN KEY FK_1BB6FF285C6DE3B4');
        $this->addSql('ALTER TABLE competance ADD CONSTRAINT fk_competance_idPersonne FOREIGN KEY (idPersonne) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demandestage DROP FOREIGN KEY FK_F8FC91A7FE6E88D7');
        $this->addSql('ALTER TABLE demandestage DROP FOREIGN KEY FK_F8FC91A7D5B8D074');
        $this->addSql('ALTER TABLE demandestage ADD CONSTRAINT FK_F8FC91A75C6DE3B4 FOREIGN KEY (idUser) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demandestage ADD CONSTRAINT FK_F8FC91A7D5B8D074 FOREIGN KEY (idStage) REFERENCES stage (idStage) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DAFE6E88D7');
        $this->addSql('ALTER TABLE entretien CHANGE idUser idUser INT NOT NULL');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT entretien_ibfk_1 FOREIGN KEY (idUser) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation CHANGE description description VARCHAR(30) NOT NULL, CHANGE titre titre VARCHAR(30) NOT NULL, CHANGE type type VARCHAR(30) NOT NULL, CHANGE domaine domaine VARCHAR(30) NOT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP INDEX fk_personneReservation, ADD UNIQUE INDEX idUser (idUser)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FE6E88D7');
        $this->addSql('ALTER TABLE reservation CHANGE nom nom VARCHAR(30) NOT NULL, CHANGE dateReservation dateReservation DATE NOT NULL, CHANGE idFormation idFormation INT NOT NULL');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751FE6E88D7');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937515C6DE3B4 FOREIGN KEY (idUser) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369FE6E88D7');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C93695C6DE3B4 FOREIGN KEY (idUser) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
