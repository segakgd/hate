<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230730202417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_entity ADD COLUMN project INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_entity AS SELECT id, name, image, price FROM product_entity');
        $this->addSql('DROP TABLE product_entity');
        $this->addSql('CREATE TABLE product_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, price CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO product_entity (id, name, image, price) SELECT id, name, image, price FROM __temp__product_entity');
        $this->addSql('DROP TABLE __temp__product_entity');
    }
}
