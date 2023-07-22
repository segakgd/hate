<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230722204310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deal_entity ADD COLUMN project INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__deal_entity AS SELECT id, contacts_id, fields_id, orders_id FROM deal_entity');
        $this->addSql('DROP TABLE deal_entity');
        $this->addSql('CREATE TABLE deal_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contacts_id INTEGER DEFAULT NULL, fields_id INTEGER DEFAULT NULL, orders_id INTEGER DEFAULT NULL, CONSTRAINT FK_1A6FC7E4719FB48E FOREIGN KEY (contacts_id) REFERENCES contacts_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1A6FC7E42C5439AE FOREIGN KEY (fields_id) REFERENCES field_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1A6FC7E4CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES order_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO deal_entity (id, contacts_id, fields_id, orders_id) SELECT id, contacts_id, fields_id, orders_id FROM __temp__deal_entity');
        $this->addSql('DROP TABLE __temp__deal_entity');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1A6FC7E4719FB48E ON deal_entity (contacts_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1A6FC7E42C5439AE ON deal_entity (fields_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1A6FC7E4CFFE9AD6 ON deal_entity (orders_id)');
    }
}
