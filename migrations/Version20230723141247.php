<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230723141247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__field_entity AS SELECT id, deal_entity_id, name, value FROM field_entity');
        $this->addSql('DROP TABLE field_entity');
        $this->addSql('CREATE TABLE field_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, deal_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, CONSTRAINT FK_246CC86AF60E2305 FOREIGN KEY (deal_id) REFERENCES deal_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO field_entity (id, deal_id, name, value) SELECT id, deal_entity_id, name, value FROM __temp__field_entity');
        $this->addSql('DROP TABLE __temp__field_entity');
        $this->addSql('CREATE INDEX IDX_246CC86AF60E2305 ON field_entity (deal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__field_entity AS SELECT id, deal_id, name, value FROM field_entity');
        $this->addSql('DROP TABLE field_entity');
        $this->addSql('CREATE TABLE field_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, deal_entity_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, CONSTRAINT FK_246CC86A911C8016 FOREIGN KEY (deal_entity_id) REFERENCES deal_entity (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO field_entity (id, deal_entity_id, name, value) SELECT id, deal_id, name, value FROM __temp__field_entity');
        $this->addSql('DROP TABLE __temp__field_entity');
        $this->addSql('CREATE INDEX IDX_246CC86A911C8016 ON field_entity (deal_entity_id)');
    }
}
