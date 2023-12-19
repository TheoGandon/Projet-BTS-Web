<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219004910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_pictures (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, INDEX IDX_DA94DBAB7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_pictures ADD CONSTRAINT FK_DA94DBAB7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_article_picture DROP FOREIGN KEY FK_18CC3BA0D29C6C3E');
        $this->addSql('ALTER TABLE article_article_picture DROP FOREIGN KEY FK_18CC3BA07294869C');
        $this->addSql('DROP TABLE article_article_picture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_article_picture (article_id INT NOT NULL, article_picture_id INT NOT NULL, INDEX IDX_18CC3BA07294869C (article_id), INDEX IDX_18CC3BA0D29C6C3E (article_picture_id), PRIMARY KEY(article_id, article_picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article_article_picture ADD CONSTRAINT FK_18CC3BA0D29C6C3E FOREIGN KEY (article_picture_id) REFERENCES article_picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_article_picture ADD CONSTRAINT FK_18CC3BA07294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_pictures DROP FOREIGN KEY FK_DA94DBAB7294869C');
        $this->addSql('DROP TABLE article_pictures');
    }
}
