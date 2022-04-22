<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406231559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY fk_livreBiblio');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY fk_facultePersonne');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY fk_livre');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY fk_personneAdresse');
        $this->addSql('ALTER TABLE competance DROP FOREIGN KEY fk_competencePersonne');
        $this->addSql('ALTER TABLE demandestage DROP FOREIGN KEY fk_demandePersonne');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY fk_personneExperience');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY fk_personne');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY fk_personneReservation');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY fk_scorePersonne');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY fk_stagePersonne');
        $this->addSql('ALTER TABLE proposition DROP FOREIGN KEY fk_propositionQuestion');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY fk_question1');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY fk_question3');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY fk_question5');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY fk_question2');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY fk_question4');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY fk_scoreQuiz');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY fk_societePersonne');
        $this->addSql('ALTER TABLE demandestage DROP FOREIGN KEY fk_demandeStage');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY fk_entretienStage');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE bibliotheque');
        $this->addSql('DROP TABLE competance');
        $this->addSql('DROP TABLE demandestage');
        $this->addSql('DROP TABLE entretien');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE faculte');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE proposition');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE societe');
        $this->addSql('DROP TABLE stage');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (idAdresse INT AUTO_INCREMENT NOT NULL, rue INT NOT NULL, ville VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, codePostal INT NOT NULL, idPersonne INT NOT NULL, INDEX fk_personneAdresse (idPersonne), PRIMARY KEY(idAdresse)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bibliotheque (intC INT AUTO_INCREMENT NOT NULL, nomC VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, descriptionC VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, domaineC VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(intC)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE competance (idCompetance INT AUTO_INCREMENT NOT NULL, nomCompetance VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, niveau VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, verifie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idPersonne INT NOT NULL, INDEX fk_competencePersonne (idPersonne), PRIMARY KEY(idCompetance)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE demandestage (idDemande INT AUTO_INCREMENT NOT NULL, etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idStage INT NOT NULL, idPersonne INT NOT NULL, INDEX fk_demandePersonne (idPersonne), INDEX fk_demandeStage (idStage), PRIMARY KEY(idDemande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE entretien (idEntretien INT AUTO_INCREMENT NOT NULL, dateEntretien DATE NOT NULL, idStage INT NOT NULL, heureEntretien VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, lienEntretien VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_entretienStage (idStage), PRIMARY KEY(idEntretien)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE experience (idExperience INT AUTO_INCREMENT NOT NULL, poste VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, societe VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, competanMiseEnOuvre VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateDebut DATE NOT NULL, dateFin DATE NOT NULL, idPersonne INT NOT NULL, INDEX fk_personneExperience (idPersonne), PRIMARY KEY(idExperience)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE faculte (idFaculte INT AUTO_INCREMENT NOT NULL, nomFaculte VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, acronyme VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(idFaculte)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE formation (idFormation INT AUTO_INCREMENT NOT NULL, description VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, titre VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, domaine VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prix DOUBLE PRECISION NOT NULL, dateDebut DATE NOT NULL, dateFin DATE NOT NULL, idPersonne INT NOT NULL, INDEX fk_personne (idPersonne), PRIMARY KEY(idFormation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE images (idImage INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(idImage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livre (idL INT AUTO_INCREMENT NOT NULL, titreL VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, auteurL VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, descriptionL VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, imageString VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, pdfivre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, intC INT NOT NULL, INDEX fk_livreBiblio (intC), PRIMARY KEY(idL)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE personne (idPersonne INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, tel INT NOT NULL, cin INT NOT NULL, email VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, datenaissance DATE NOT NULL, role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idFaculte INT DEFAULT NULL, pdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idSociete INT DEFAULT NULL, INDEX fk_societePersonne (idSociete), INDEX fk_facultePersonne (idFaculte), PRIMARY KEY(idPersonne)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE proposition (idProposition INT AUTO_INCREMENT NOT NULL, idQuestion INT NOT NULL, proposition VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_propositionQuestion (idQuestion), PRIMARY KEY(idProposition)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE question (idQuestion INT AUTO_INCREMENT NOT NULL, enonce VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, domaine VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, reponseCorrecte VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(idQuestion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz (idQuiz INT AUTO_INCREMENT NOT NULL, domaine VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateCreation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, idQuestion1 INT NOT NULL, idQuestion2 INT NOT NULL, idQuestion3 INT NOT NULL, idQuestion4 INT NOT NULL, idQuestion5 INT NOT NULL, INDEX fk_question4 (idQuestion4), INDEX fk_question1 (idQuestion1), INDEX fk_question5 (idQuestion5), INDEX fk_question2 (idQuestion2), INDEX fk_question3 (idQuestion3), PRIMARY KEY(idQuiz)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rate (idr INT AUTO_INCREMENT NOT NULL, rate DOUBLE PRECISION NOT NULL, idL INT NOT NULL, INDEX fk_livre (idL), PRIMARY KEY(idr)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation (idReservation INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateReservation DATE NOT NULL, idFormation INT NOT NULL, idPersonne INT NOT NULL, INDEX fk_formation (idFormation), INDEX fk_personneReservation (idPersonne), PRIMARY KEY(idReservation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE score (idScore INT AUTO_INCREMENT NOT NULL, score INT NOT NULL, idQuiz INT NOT NULL, idPersonne INT NOT NULL, INDEX fk_scorePersonne (idPersonne), INDEX fk_scoreQuiz (idQuiz), PRIMARY KEY(idScore)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE societe (idSociete INT AUTO_INCREMENT NOT NULL, nomSociete VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(idSociete)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE stage (idStage INT AUTO_INCREMENT NOT NULL, duree INT NOT NULL, type VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, domaine VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, sujet VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateDebut VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateFin VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idPersonne INT NOT NULL, INDEX fk_stagePersonne (idPersonne), PRIMARY KEY(idStage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT fk_personneAdresse FOREIGN KEY (idPersonne) REFERENCES personne (idPersonne) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competance ADD CONSTRAINT fk_competencePersonne FOREIGN KEY (idPersonne) REFERENCES personne (idPersonne) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demandestage ADD CONSTRAINT fk_demandePersonne FOREIGN KEY (idPersonne) REFERENCES personne (idPersonne) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demandestage ADD CONSTRAINT fk_demandeStage FOREIGN KEY (idStage) REFERENCES stage (idStage) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT fk_entretienStage FOREIGN KEY (idStage) REFERENCES stage (idStage) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT fk_personneExperience FOREIGN KEY (idPersonne) REFERENCES personne (idPersonne) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT fk_personne FOREIGN KEY (idPersonne) REFERENCES personne (idPersonne) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT fk_livreBiblio FOREIGN KEY (intC) REFERENCES bibliotheque (intC) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT fk_facultePersonne FOREIGN KEY (idFaculte) REFERENCES faculte (idFaculte) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT fk_societePersonne FOREIGN KEY (idSociete) REFERENCES societe (idSociete) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT fk_propositionQuestion FOREIGN KEY (idQuestion) REFERENCES question (idQuestion) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT fk_question1 FOREIGN KEY (idQuestion1) REFERENCES question (idQuestion) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT fk_question3 FOREIGN KEY (idQuestion3) REFERENCES question (idQuestion) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT fk_question5 FOREIGN KEY (idQuestion5) REFERENCES question (idQuestion) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT fk_question2 FOREIGN KEY (idQuestion2) REFERENCES question (idQuestion) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT fk_question4 FOREIGN KEY (idQuestion4) REFERENCES question (idQuestion) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT fk_livre FOREIGN KEY (idL) REFERENCES livre (idL)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT fk_personneReservation FOREIGN KEY (idPersonne) REFERENCES personne (idPersonne) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT fk_scorePersonne FOREIGN KEY (idPersonne) REFERENCES personne (idPersonne) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT fk_scoreQuiz FOREIGN KEY (idQuiz) REFERENCES quiz (idQuiz) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT fk_stagePersonne FOREIGN KEY (idPersonne) REFERENCES personne (idPersonne) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE user');
    }
}
