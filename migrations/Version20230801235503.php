<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801235503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_category_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, project INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE product_category_entity_product_entity (product_category_entity_id INTEGER NOT NULL, product_entity_id INTEGER NOT NULL, PRIMARY KEY(product_category_entity_id, product_entity_id), CONSTRAINT FK_E661AE7EB4932A11 FOREIGN KEY (product_category_entity_id) REFERENCES product_category_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E661AE7EEF85CBD0 FOREIGN KEY (product_entity_id) REFERENCES product_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E661AE7EB4932A11 ON product_category_entity_product_entity (product_category_entity_id)');
        $this->addSql('CREATE INDEX IDX_E661AE7EEF85CBD0 ON product_category_entity_product_entity (product_entity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product_category_entity');
        $this->addSql('DROP TABLE product_category_entity_product_entity');
    }
}
