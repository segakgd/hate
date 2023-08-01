<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801230209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE promotion');
        $this->addSql('ALTER TABLE promotion_entity ADD COLUMN type VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE promotion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(100) NOT NULL COLLATE "BINARY", type VARCHAR(20) NOT NULL COLLATE "BINARY", project INTEGER NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__promotion_entity AS SELECT id, name, price, project FROM promotion_entity');
        $this->addSql('DROP TABLE promotion_entity');
        $this->addSql('CREATE TABLE promotion_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, price CLOB NOT NULL --(DC2Type:json)
        , project INTEGER NOT NULL)');
        $this->addSql('INSERT INTO promotion_entity (id, name, price, project) SELECT id, name, price, project FROM __temp__promotion_entity');
        $this->addSql('DROP TABLE __temp__promotion_entity');
    }
}
