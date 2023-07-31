<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230731220331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shipping_entity ADD COLUMN price CLOB DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__shipping_entity AS SELECT id, title, type, project FROM shipping_entity');
        $this->addSql('DROP TABLE shipping_entity');
        $this->addSql('CREATE TABLE shipping_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(100) NOT NULL, type VARCHAR(20) NOT NULL, project INTEGER NOT NULL)');
        $this->addSql('INSERT INTO shipping_entity (id, title, type, project) SELECT id, title, type, project FROM __temp__shipping_entity');
        $this->addSql('DROP TABLE __temp__shipping_entity');
    }
}
