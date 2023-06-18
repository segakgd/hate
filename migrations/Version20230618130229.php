<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230618130229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE behavior_scenario ADD COLUMN action_after CLOB DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__behavior_scenario AS SELECT id, type, name, content, owner_step_id FROM behavior_scenario');
        $this->addSql('DROP TABLE behavior_scenario');
        $this->addSql('CREATE TABLE behavior_scenario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(25) NOT NULL, name VARCHAR(255) NOT NULL, content CLOB NOT NULL --(DC2Type:json)
        , owner_step_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO behavior_scenario (id, type, name, content, owner_step_id) SELECT id, type, name, content, owner_step_id FROM __temp__behavior_scenario');
        $this->addSql('DROP TABLE __temp__behavior_scenario');
    }
}
