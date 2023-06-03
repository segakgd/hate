<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230603224447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__step AS SELECT id, type, name, owner_step_id, content FROM step');
        $this->addSql('DROP TABLE step');
        $this->addSql('CREATE TABLE step (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(25) NOT NULL, name VARCHAR(255) NOT NULL, owner_step_id INTEGER DEFAULT NULL, content CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO step (id, type, name, owner_step_id, content) SELECT id, type, name, owner_step_id, content FROM __temp__step');
        $this->addSql('DROP TABLE __temp__step');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__step AS SELECT id, type, name, owner_step_id, content FROM step');
        $this->addSql('DROP TABLE step');
        $this->addSql('CREATE TABLE step (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(25) NOT NULL, name VARCHAR(255) NOT NULL, owner_step_id INTEGER NOT NULL, content CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO step (id, type, name, owner_step_id, content) SELECT id, type, name, owner_step_id, content FROM __temp__step');
        $this->addSql('DROP TABLE __temp__step');
    }
}
