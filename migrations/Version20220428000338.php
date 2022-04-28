<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428000338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (idAdresse INT AUTO_INCREMENT NOT NULL, rue INT NOT NULL, ville VARCHAR(30) NOT NULL, codePostal INT NOT NULL, idPersonne INT DEFAULT NULL, INDEX fk_personneAdresse (idPersonne), PRIMARY KEY(idAdresse)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bibliotheque (intC INT AUTO_INCREMENT NOT NULL, nomC VARCHAR(20) NOT NULL, descriptionC VARCHAR(20) NOT NULL, domaineC VARCHAR(20) NOT NULL, PRIMARY KEY(intC)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competance (idCompetance INT AUTO_INCREMENT NOT NULL, nomCompetance VARCHAR(30) NOT NULL, niveau VARCHAR(255) NOT NULL, verifie VARCHAR(255) NOT NULL, idPersonne INT DEFAULT NULL, INDEX fk_competencePersonne (idPersonne), PRIMARY KEY(idCompetance)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demandestage (idDemande INT AUTO_INCREMENT NOT NULL, etat VARCHAR(255) NOT NULL, idStage INT DEFAULT NULL, idUser INT DEFAULT NULL, INDEX fk_demandeStage (idStage), INDEX fk_demandePersonne (idUser), PRIMARY KEY(idDemande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entretien (idEntretien INT AUTO_INCREMENT NOT NULL, dateEntretien DATE NOT NULL, heureEntretien VARCHAR(30) NOT NULL, lienEntretien VARCHAR(255) NOT NULL, idUser INT DEFAULT NULL, idStage INT DEFAULT NULL, INDEX idUser (idUser), INDEX fk_entretienStage (idStage), PRIMARY KEY(idEntretien)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (idExperience INT AUTO_INCREMENT NOT NULL, poste VARCHAR(30) NOT NULL, societe VARCHAR(30) NOT NULL, competanMiseEnOuvre VARCHAR(30) NOT NULL, dateDebut DATE NOT NULL, dateFin DATE NOT NULL, idUser INT DEFAULT NULL, INDEX fk_personneExperience (idUser), PRIMARY KEY(idExperience)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faculte (idFaculte INT AUTO_INCREMENT NOT NULL, nomFaculte VARCHAR(30) NOT NULL, acronyme VARCHAR(30) NOT NULL, PRIMARY KEY(idFaculte)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (idFormation INT AUTO_INCREMENT NOT NULL, description VARCHAR(30) NOT NULL, titre VARCHAR(30) NOT NULL, type VARCHAR(30) NOT NULL, domaine VARCHAR(30) NOT NULL, prix DOUBLE PRECISION NOT NULL, dateDebut DATE NOT NULL, dateFin DATE NOT NULL, idUser INT DEFAULT NULL, INDEX fk_personne (idUser), PRIMARY KEY(idFormation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (idImage INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, description VARCHAR(200) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(idImage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (idL INT AUTO_INCREMENT NOT NULL, titreL VARCHAR(30) NOT NULL, auteurL VARCHAR(20) NOT NULL, descriptionL VARCHAR(20) NOT NULL, imageString VARCHAR(255) NOT NULL, pdfivre VARCHAR(255) NOT NULL, intC INT DEFAULT NULL, INDEX fk_livreBiblio (intC), PRIMARY KEY(idL)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (idPersonne INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) NOT NULL, password VARCHAR(30) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, tel INT NOT NULL, cin INT NOT NULL, email VARCHAR(50) NOT NULL, datenaissance DATE NOT NULL, role VARCHAR(255) NOT NULL, pdp VARCHAR(255) NOT NULL, idSociete INT DEFAULT NULL, idFaculte INT DEFAULT NULL, INDEX fk_facultePersonne (idFaculte), INDEX fk_societePersonne (idSociete), PRIMARY KEY(idPersonne)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposition (idProposition INT AUTO_INCREMENT NOT NULL, proposition VARCHAR(30) NOT NULL, idQuestion INT DEFAULT NULL, INDEX fk_propositionQuestion (idQuestion), PRIMARY KEY(idProposition)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (idQuestion INT AUTO_INCREMENT NOT NULL, enonce VARCHAR(30) NOT NULL, domaine VARCHAR(30) NOT NULL, reponseCorrecte VARCHAR(30) NOT NULL, PRIMARY KEY(idQuestion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (idQuiz INT AUTO_INCREMENT NOT NULL, domaine VARCHAR(30) NOT NULL, dateCreation DATETIME DEFAULT \'current_timestamp()\' NOT NULL, idQuestion1 INT DEFAULT NULL, idQuestion4 INT DEFAULT NULL, idQuestion3 INT DEFAULT NULL, idQuestion2 INT DEFAULT NULL, idQuestion5 INT DEFAULT NULL, INDEX fk_question5 (idQuestion5), INDEX fk_question2 (idQuestion2), INDEX fk_question3 (idQuestion3), INDEX fk_question4 (idQuestion4), INDEX fk_question1 (idQuestion1), PRIMARY KEY(idQuiz)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (idr INT AUTO_INCREMENT NOT NULL, rate DOUBLE PRECISION NOT NULL, idL INT DEFAULT NULL, INDEX fk_livre (idL), PRIMARY KEY(idr)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rememberme_token (series CHAR(88) NOT NULL, value VARCHAR(88) NOT NULL, lastUsed DATETIME NOT NULL, class VARCHAR(100) NOT NULL, username VARCHAR(200) NOT NULL, PRIMARY KEY(series)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (idReservation INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, dateReservation DATE NOT NULL, idFormation INT DEFAULT NULL, idUser INT DEFAULT NULL, INDEX fk_personneReservation (idUser), INDEX fk_formation (idFormation), PRIMARY KEY(idReservation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (idScore INT AUTO_INCREMENT NOT NULL, score INT NOT NULL, idQuiz INT DEFAULT NULL, idUser INT DEFAULT NULL, INDEX fk_scoreQuiz (idQuiz), INDEX fk_scorePersonne (idUser), PRIMARY KEY(idScore)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe (idSociete INT AUTO_INCREMENT NOT NULL, nomSociete VARCHAR(30) NOT NULL, PRIMARY KEY(idSociete)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stage (idStage INT AUTO_INCREMENT NOT NULL, duree INT NOT NULL, type VARCHAR(255) NOT NULL, domaine VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, dateDebut DATE NOT NULL, dateFin DATE NOT NULL, idUser INT DEFAULT NULL, INDEX fk_stagePersonne (idUser), PRIMARY KEY(idStage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel INT NOT NULL, cin INT NOT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, pdp VARCHAR(255) DEFAULT \'NULL\', datenaissance DATE NOT NULL, profil VARCHAR(255) NOT NULL, infos VARCHAR(255) DEFAULT \'NULL\', note INT DEFAULT NULL, idSociete INT DEFAULT NULL, idFaculte INT DEFAULT NULL, INDEX IDX_8D93D649132E57FE (idFaculte), INDEX IDX_8D93D6499DC564F (idSociete), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08165C6DE3B4 FOREIGN KEY (idPersonne) REFERENCES user (id)');
        $this->addSql('ALTER TABLE competance ADD CONSTRAINT FK_1BB6FF285C6DE3B4 FOREIGN KEY (idPersonne) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demandestage ADD CONSTRAINT FK_F8FC91A7D5B8D074 FOREIGN KEY (idStage) REFERENCES stage (idStage)');
        $this->addSql('ALTER TABLE demandestage ADD CONSTRAINT FK_F8FC91A7FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DAFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DAD5B8D074 FOREIGN KEY (idStage) REFERENCES stage (idStage)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9981A52D67 FOREIGN KEY (intC) REFERENCES bibliotheque (intC)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF9DC564F FOREIGN KEY (idSociete) REFERENCES societe (idSociete)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF132E57FE FOREIGN KEY (idFaculte) REFERENCES faculte (idFaculte)');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353E5546315 FOREIGN KEY (idQuestion) REFERENCES question (idQuestion)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92EEE45F3F FOREIGN KEY (idQuestion1) REFERENCES question (idQuestion)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA929E8EABB0 FOREIGN KEY (idQuestion4) REFERENCES question (idQuestion)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92EA3E13 FOREIGN KEY (idQuestion3) REFERENCES question (idQuestion)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA9277ED0E85 FOREIGN KEY (idQuestion2) REFERENCES question (idQuestion)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92E9899B26 FOREIGN KEY (idQuestion5) REFERENCES question (idQuestion)');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39C6BC8AA5 FOREIGN KEY (idL) REFERENCES livre (idL)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955BCAA0AE9 FOREIGN KEY (idFormation) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751D7EFA40C FOREIGN KEY (idQuiz) REFERENCES quiz (idQuiz)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499DC564F FOREIGN KEY (idSociete) REFERENCES societe (idSociete)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649132E57FE FOREIGN KEY (idFaculte) REFERENCES faculte (idFaculte)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9981A52D67');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF132E57FE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649132E57FE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955BCAA0AE9');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39C6BC8AA5');
        $this->addSql('ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC353E5546315');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92EEE45F3F');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA929E8EABB0');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92EA3E13');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA9277ED0E85');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92E9899B26');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751D7EFA40C');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF9DC564F');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499DC564F');
        $this->addSql('ALTER TABLE demandestage DROP FOREIGN KEY FK_F8FC91A7D5B8D074');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DAD5B8D074');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08165C6DE3B4');
        $this->addSql('ALTER TABLE competance DROP FOREIGN KEY FK_1BB6FF285C6DE3B4');
        $this->addSql('ALTER TABLE demandestage DROP FOREIGN KEY FK_F8FC91A7FE6E88D7');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DAFE6E88D7');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103FE6E88D7');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFFE6E88D7');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FE6E88D7');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751FE6E88D7');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369FE6E88D7');
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
        $this->addSql('DROP TABLE rememberme_token');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE societe');
        $this->addSql('DROP TABLE stage');
        $this->addSql('DROP TABLE user');
    }
}
