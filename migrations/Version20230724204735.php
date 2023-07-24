<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230724204735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_project_entity (user_id INTEGER NOT NULL, project_entity_id INTEGER NOT NULL, PRIMARY KEY(user_id, project_entity_id), CONSTRAINT FK_7209707BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7209707B9019388A FOREIGN KEY (project_entity_id) REFERENCES project_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_7209707BA76ED395 ON user_project_entity (user_id)');
        $this->addSql('CREATE INDEX IDX_7209707B9019388A ON user_project_entity (project_entity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_project_entity');
    }
}
