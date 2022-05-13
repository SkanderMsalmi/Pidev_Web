<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420151701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, expired_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', token VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B9983CE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password ADD CONSTRAINT FK_B9983CE5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE competance CHANGE verifie verifie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DAFE6E88D7');
        $this->addSql('DROP INDEX fk_2b58d6dafe6e88d7 ON entretien');
        $this->addSql('CREATE INDEX idUser ON entretien (idUser)');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DAFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('DROP INDEX email ON user');
        $this->addSql('ALTER TABLE user CHANGE datenaissance datenaissance DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reset_password');
        $this->addSql('ALTER TABLE competance CHANGE verifie verifie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entretien DROP FOREIGN KEY FK_2B58D6DAFE6E88D7');
        $this->addSql('DROP INDEX iduser ON entretien');
        $this->addSql('CREATE INDEX FK_2B58D6DAFE6E88D7 ON entretien (idUser)');
        $this->addSql('ALTER TABLE entretien ADD CONSTRAINT FK_2B58D6DAFE6E88D7 FOREIGN KEY (idUser) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE datenaissance datenaissance DATE NOT NULL');
        $this->addSql('CREATE INDEX email ON user (email)');
    }
}
