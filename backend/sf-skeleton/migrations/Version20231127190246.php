<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127190246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_sizes (article_id INT NOT NULL, sizes_id INT NOT NULL, INDEX IDX_C129F5787294869C (article_id), INDEX IDX_C129F578423285E6 (sizes_id), PRIMARY KEY(article_id, sizes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sizes (id INT AUTO_INCREMENT NOT NULL, size_value_eu DOUBLE PRECISION NOT NULL, size_value_uk DOUBLE PRECISION NOT NULL, size_value_us DOUBLE PRECISION NOT NULL, size_gender VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_sizes ADD CONSTRAINT FK_C129F5787294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_sizes ADD CONSTRAINT FK_C129F578423285E6 FOREIGN KEY (sizes_id) REFERENCES sizes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_sizes DROP FOREIGN KEY FK_C129F5787294869C');
        $this->addSql('ALTER TABLE article_sizes DROP FOREIGN KEY FK_C129F578423285E6');
        $this->addSql('DROP TABLE article_sizes');
        $this->addSql('DROP TABLE sizes');
    }
}
