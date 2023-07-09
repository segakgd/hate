<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230709200834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contacts_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) DEFAULT NULL, phone VARCHAR(25) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL)');
        $this->addSql('CREATE TABLE deal_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contacts_id INTEGER DEFAULT NULL, fields_id INTEGER DEFAULT NULL, orders_id INTEGER DEFAULT NULL, CONSTRAINT FK_1A6FC7E4719FB48E FOREIGN KEY (contacts_id) REFERENCES contacts_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1A6FC7E42C5439AE FOREIGN KEY (fields_id) REFERENCES field_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1A6FC7E4CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES order_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1A6FC7E4719FB48E ON deal_entity (contacts_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1A6FC7E42C5439AE ON deal_entity (fields_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1A6FC7E4CFFE9AD6 ON deal_entity (orders_id)');
        $this->addSql('CREATE TABLE field_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, fields_entity_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, CONSTRAINT FK_246CC86A4DB7A8E8 FOREIGN KEY (fields_entity_id) REFERENCES fields_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_246CC86A4DB7A8E8 ON field_entity (fields_entity_id)');
        $this->addSql('CREATE TABLE fields_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE order_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, products CLOB DEFAULT NULL --(DC2Type:json)
        , shipping CLOB DEFAULT NULL --(DC2Type:json)
        , promotions CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE product_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, price CLOB NOT NULL --(DC2Type:json)
        )');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contacts_entity');
        $this->addSql('DROP TABLE deal_entity');
        $this->addSql('DROP TABLE field_entity');
        $this->addSql('DROP TABLE fields_entity');
        $this->addSql('DROP TABLE order_entity');
        $this->addSql('DROP TABLE product_entity');
    }
}
