<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231210160121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE color ADD array_articles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE color ADD CONSTRAINT FK_665648E9DCD10AD9 FOREIGN KEY (array_articles_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_665648E9DCD10AD9 ON color (array_articles_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE color DROP FOREIGN KEY FK_665648E9DCD10AD9');
        $this->addSql('DROP INDEX IDX_665648E9DCD10AD9 ON color');
        $this->addSql('ALTER TABLE color DROP array_articles_id');
    }
}
