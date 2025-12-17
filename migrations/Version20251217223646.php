<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251217223646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lien (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE lien_motcle (lien_id INTEGER NOT NULL, motcle_id INTEGER NOT NULL, PRIMARY KEY (lien_id, motcle_id), CONSTRAINT FK_EFE77A43EDAAC352 FOREIGN KEY (lien_id) REFERENCES lien (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_EFE77A431D93C8D9 FOREIGN KEY (motcle_id) REFERENCES motcle (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EFE77A43EDAAC352 ON lien_motcle (lien_id)');
        $this->addSql('CREATE INDEX IDX_EFE77A431D93C8D9 ON lien_motcle (motcle_id)');
        $this->addSql('CREATE TABLE liens (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_url VARCHAR(255) NOT NULL, lien_titre VARCHAR(255) NOT NULL, lien_desc CLOB NOT NULL)');
        $this->addSql('CREATE TABLE motcle (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON user (username)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lien');
        $this->addSql('DROP TABLE lien_motcle');
        $this->addSql('DROP TABLE liens');
        $this->addSql('DROP TABLE motcle');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
