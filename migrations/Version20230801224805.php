<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801224805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotion_entity ADD COLUMN project INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__promotion_entity AS SELECT id, name, price FROM promotion_entity');
        $this->addSql('DROP TABLE promotion_entity');
        $this->addSql('CREATE TABLE promotion_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, price CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO promotion_entity (id, name, price) SELECT id, name, price FROM __temp__promotion_entity');
        $this->addSql('DROP TABLE __temp__promotion_entity');
    }
}
