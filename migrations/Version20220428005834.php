<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428005834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
        $this->addSql('ALTER TABLE proposition CHANGE proposition proposition VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE enonce enonce VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937515C6DE3B4');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C93695C6DE3B4');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369FE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
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
        $this->addSql('ALTER TABLE proposition CHANGE proposition proposition VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question CHANGE enonce enonce VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751FE6E88D7');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937515C6DE3B4 FOREIGN KEY (idUser) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369FE6E88D7');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C93695C6DE3B4 FOREIGN KEY (idUser) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
