<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730115105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE excuse ADD auteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE excuse ADD CONSTRAINT FK_623AD9F060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_623AD9F060BB6FE6 ON excuse (auteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE excuse DROP FOREIGN KEY FK_623AD9F060BB6FE6');
        $this->addSql('DROP INDEX IDX_623AD9F060BB6FE6 ON excuse');
        $this->addSql('ALTER TABLE excuse DROP auteur_id');
    }
}
