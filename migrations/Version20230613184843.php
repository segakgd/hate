<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613184843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chat_event ADD COLUMN status VARCHAR(15) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__chat_event AS SELECT id, type, behavior_scenario, action_before, action_after FROM chat_event');
        $this->addSql('DROP TABLE chat_event');
        $this->addSql('CREATE TABLE chat_event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, behavior_scenario INTEGER NOT NULL, action_before CLOB DEFAULT NULL --(DC2Type:json)
        , action_after CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO chat_event (id, type, behavior_scenario, action_before, action_after) SELECT id, type, behavior_scenario, action_before, action_after FROM __temp__chat_event');
        $this->addSql('DROP TABLE __temp__chat_event');
    }
}
