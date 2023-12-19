<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219005325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_pictures DROP FOREIGN KEY FK_DA94DBAB7294869C');
        $this->addSql('DROP TABLE article_pictures');
        $this->addSql('ALTER TABLE article_picture ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3E7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_FB090B3E7294869C ON article_picture (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_pictures (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, INDEX IDX_DA94DBAB7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article_pictures ADD CONSTRAINT FK_DA94DBAB7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_picture DROP FOREIGN KEY FK_FB090B3E7294869C');
        $this->addSql('DROP INDEX IDX_FB090B3E7294869C ON article_picture');
        $this->addSql('ALTER TABLE article_picture DROP article_id');
    }
}
