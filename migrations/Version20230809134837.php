<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809134837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_variant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, image CLOB DEFAULT NULL --(DC2Type:json)
        , price CLOB NOT NULL --(DC2Type:json)
        , count INTEGER NOT NULL, promotion_distributed BOOLEAN NOT NULL, percent_discount INTEGER DEFAULT NULL, active BOOLEAN NOT NULL, active_from DATETIME DEFAULT NULL, active_to DATETIME DEFAULT NULL, crated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart AS SELECT id, total_amount, visitor_id, status, created_at, products FROM cart');
        $this->addSql('DROP TABLE cart');
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, total_amount INTEGER NOT NULL, visitor_id INTEGER DEFAULT NULL, status VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , products CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO cart (id, total_amount, visitor_id, status, created_at, products) SELECT id, total_amount, visitor_id, status, created_at, products FROM __temp__cart');
        $this->addSql('DROP TABLE __temp__cart');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_entity AS SELECT id, project FROM product_entity');
        $this->addSql('DROP TABLE product_entity');
        $this->addSql('CREATE TABLE product_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project INTEGER NOT NULL)');
        $this->addSql('INSERT INTO product_entity (id, project) SELECT id, project FROM __temp__product_entity');
        $this->addSql('DROP TABLE __temp__product_entity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product_variant');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart AS SELECT id, total_amount, visitor_id, status, created_at, products FROM cart');
        $this->addSql('DROP TABLE cart');
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, total_amount INTEGER NOT NULL, visitor_id INTEGER DEFAULT NULL, status VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , products CLOB NOT NULL)');
        $this->addSql('INSERT INTO cart (id, total_amount, visitor_id, status, created_at, products) SELECT id, total_amount, visitor_id, status, created_at, products FROM __temp__cart');
        $this->addSql('DROP TABLE __temp__cart');
        $this->addSql('ALTER TABLE product_entity ADD COLUMN name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE product_entity ADD COLUMN image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product_entity ADD COLUMN price CLOB NOT NULL');
    }
}
