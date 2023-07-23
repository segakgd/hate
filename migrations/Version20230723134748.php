<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230723134748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE behavior_scenario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(25) NOT NULL, name VARCHAR(255) NOT NULL, content CLOB NOT NULL --(DC2Type:json)
        , owner_step_id INTEGER DEFAULT NULL, action_after CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE chat_event (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL, behavior_scenario INTEGER NOT NULL, action_before CLOB DEFAULT NULL --(DC2Type:json)
        , action_after CLOB DEFAULT NULL --(DC2Type:json)
        , status VARCHAR(15) NOT NULL)');
        $this->addSql('CREATE TABLE chat_session (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chat_id INTEGER NOT NULL, channel VARCHAR(20) NOT NULL, chat_event INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE contacts_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(50) DEFAULT NULL, last_name VARCHAR(50) DEFAULT NULL, phone VARCHAR(25) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL)');
        $this->addSql('CREATE TABLE deal_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contacts_id INTEGER DEFAULT NULL, orders_id INTEGER DEFAULT NULL, project INTEGER NOT NULL, CONSTRAINT FK_1A6FC7E4719FB48E FOREIGN KEY (contacts_id) REFERENCES contacts_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1A6FC7E4CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES order_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1A6FC7E4719FB48E ON deal_entity (contacts_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1A6FC7E4CFFE9AD6 ON deal_entity (orders_id)');
        $this->addSql('CREATE TABLE field_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, deal_entity_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, value VARCHAR(50) NOT NULL, CONSTRAINT FK_246CC86A911C8016 FOREIGN KEY (deal_entity_id) REFERENCES deal_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_246CC86A911C8016 ON field_entity (deal_entity_id)');
        $this->addSql('CREATE TABLE order_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, products CLOB DEFAULT NULL --(DC2Type:json)
        , shipping CLOB DEFAULT NULL --(DC2Type:json)
        , promotions CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE product_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, price CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE "refresh_tokens" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON "refresh_tokens" (refresh_token)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE behavior_scenario');
        $this->addSql('DROP TABLE chat_event');
        $this->addSql('DROP TABLE chat_session');
        $this->addSql('DROP TABLE contacts_entity');
        $this->addSql('DROP TABLE deal_entity');
        $this->addSql('DROP TABLE field_entity');
        $this->addSql('DROP TABLE order_entity');
        $this->addSql('DROP TABLE product_entity');
        $this->addSql('DROP TABLE "refresh_tokens"');
        $this->addSql('DROP TABLE user');
    }
}
