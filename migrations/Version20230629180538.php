<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629180538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__behavior_scenario AS SELECT id, type, name, content, owner_step_id, action_after FROM behavior_scenario');
        $this->addSql('DROP TABLE behavior_scenario');
        $this->addSql('CREATE TABLE behavior_scenario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(25) NOT NULL, name VARCHAR(255) NOT NULL, content CLOB NOT NULL --(DC2Type:json)
        , owner_step_id INTEGER DEFAULT NULL, action_after CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO behavior_scenario (id, type, name, content, owner_step_id, action_after) SELECT id, type, name, content, owner_step_id, action_after FROM __temp__behavior_scenario');
        $this->addSql('DROP TABLE __temp__behavior_scenario');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__behavior_scenario AS SELECT id, type, name, content, owner_step_id, action_after FROM behavior_scenario');
        $this->addSql('DROP TABLE behavior_scenario');
        $this->addSql('CREATE TABLE behavior_scenario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(25) NOT NULL, name VARCHAR(255) NOT NULL, content CLOB NOT NULL --(DC2Type:json)
        , owner_step_id INTEGER DEFAULT NULL, action_after CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO behavior_scenario (id, type, name, content, owner_step_id, action_after) SELECT id, type, name, content, owner_step_id, action_after FROM __temp__behavior_scenario');
        $this->addSql('DROP TABLE __temp__behavior_scenario');
    }
}
