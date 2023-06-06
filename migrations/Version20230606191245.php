<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606191245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE behavior_scenario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(25) NOT NULL, name VARCHAR(255) NOT NULL, content CLOB NOT NULL --(DC2Type:json)
        , owner_step_id INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE chat_event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, behavior_scenario INTEGER NOT NULL, action_before CLOB DEFAULT NULL --(DC2Type:json)
        , action_after CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE chat_session (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chat_id INTEGER NOT NULL, channel VARCHAR(20) NOT NULL, chat_event INTEGER DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE behavior_scenario');
        $this->addSql('DROP TABLE chat_event');
        $this->addSql('DROP TABLE chat_session');
    }
}
