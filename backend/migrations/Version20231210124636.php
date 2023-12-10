<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231210124636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles_sizes (articles_id INT NOT NULL, sizes_id INT NOT NULL, INDEX IDX_5E7CAF9D1EBAF6CC (articles_id), INDEX IDX_5E7CAF9D423285E6 (sizes_id), PRIMARY KEY(articles_id, sizes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles_sizes ADD CONSTRAINT FK_5E7CAF9D1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_sizes ADD CONSTRAINT FK_5E7CAF9D423285E6 FOREIGN KEY (sizes_id) REFERENCES sizes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_sizes DROP FOREIGN KEY FK_5E7CAF9D1EBAF6CC');
        $this->addSql('ALTER TABLE articles_sizes DROP FOREIGN KEY FK_5E7CAF9D423285E6');
        $this->addSql('DROP TABLE articles_sizes');
    }
}
