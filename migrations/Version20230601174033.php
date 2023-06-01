<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601174033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__action AS SELECT id, chat_id, type, content FROM "action"');
        $this->addSql('DROP TABLE "action"');
        $this->addSql('CREATE TABLE "action" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chat_id INTEGER NOT NULL, type VARCHAR(255) NOT NULL, content CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO "action" (id, chat_id, type, content) SELECT id, chat_id, type, content FROM __temp__action');
        $this->addSql('DROP TABLE __temp__action');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__action AS SELECT id, chat_id, type, content FROM "action"');
        $this->addSql('DROP TABLE "action"');
        $this->addSql('CREATE TABLE "action" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chat_id INTEGER NOT NULL, type VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO "action" (id, chat_id, type, content) SELECT id, chat_id, type, content FROM __temp__action');
        $this->addSql('DROP TABLE __temp__action');
    }
}
